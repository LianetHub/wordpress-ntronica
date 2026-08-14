import fs from 'fs';
import path from 'path';
import through2 from 'through2';
import { createRequire } from 'module';
import ttf2woff from 'ttf2woff';
import ttf2woff2 from 'ttf2woff2';

const require = createRequire( import.meta.url );
const { Font } = require( 'fonteditor-core' );

const fontPlumber = () =>
	app.plugins.plumber(
		app.plugins.notify.onError( {
			title: 'FONTS',
			message: 'Error: <%= error.message %>',
		} )
	);

function countUtf8ReplacementTriplets( buf ) {
	let count = 0;
	for ( let i = 0; i < buf.length - 2; i++ ) {
		if ( buf[ i ] === 0xef && buf[ i + 1 ] === 0xbf && buf[ i + 2 ] === 0xbd ) {
			count += 1;
		}
	}
	return count;
}

function isValidSfntHeader( buf ) {
	if ( ! Buffer.isBuffer( buf ) || buf.length < 12 ) {
		return false;
	}
	const tag = buf.toString( 'ascii', 0, 4 );
	if ( tag !== 'OTTO' && tag !== '\x00\x01\x00\x00' && tag !== 'true' ) {
		return false;
	}
	const numTables = buf.readUInt16BE( 4 );
	if ( numTables < 1 || numTables > 64 || buf.length < 12 + numTables * 16 ) {
		return false;
	}
	for ( let i = 0; i < numTables; i++ ) {
		const o = 12 + i * 16;
		const tableTag = buf.toString( 'ascii', o, o + 4 );
		if ( ! /^[\x20-\x7E]{4}$/.test( tableTag ) ) {
			return false;
		}
	}
	return true;
}

function srcFontsByExt( ...extensions ) {
	const allowed = new Set( extensions.map( ( ext ) => ext.toLowerCase() ) );

	return app.gulp
		.src( `${ app.path.srcFolder }/fonts/*`, { allowEmpty: true, read: false } )
		.pipe(
			through2.obj( function ( file, _, cb ) {
				if ( allowed.has( path.extname( file.path ).toLowerCase() ) ) {
					this.push( file );
				}
				cb();
			} )
		);
}

function convertFont( converter, outputExt ) {
	return through2.obj( function ( file, _, cb ) {
		try {
			const input = fs.readFileSync( file.path );
			const output = converter( input );
			file.contents = Buffer.isBuffer( output ) ? output : Buffer.from( output.buffer );
			file.path = file.path.replace( path.extname( file.path ), outputExt );
			this.push( file );
			cb();
		} catch ( error ) {
			cb( error );
		}
	} );
}

export const otf2ttf = ( done ) => {
	const fontsDir = path.resolve( `${ app.path.srcFolder }/fonts` );
	const diskOtfs = fs.existsSync( fontsDir )
		? fs.readdirSync( fontsDir ).filter( ( f ) => f.toLowerCase().endsWith( '.otf' ) )
		: [];
	const failures = [];

	for ( const basename of diskOtfs ) {
		const filePath = path.join( fontsDir, basename );
		const buf = fs.readFileSync( filePath );
		const replacements = countUtf8ReplacementTriplets( buf );
		const sfntOk = isValidSfntHeader( buf );

		if ( replacements > 0 || ! sfntOk ) {
			failures.push( {
				basename,
				reason:
					replacements > 0
						? `бинарно повреждён (UTF-8 replacement ×${ replacements }). Переложите исходный .otf как binary.`
						: 'невалидный SFNT/OTF заголовок',
			} );
			continue;
		}

		try {
			const font = Font.create( buf, { type: 'otf', hinting: true } );
			const ttfBuf = Buffer.from( font.write( { type: 'ttf', hinting: true } ) );
			const outName = basename.replace( /\.otf$/i, '.ttf' );
			fs.writeFileSync( path.join( fontsDir, outName ), ttfBuf );
		} catch ( error ) {
			failures.push( { basename, reason: error.message } );
		}
	}

	if ( failures.length ) {
		const details = failures.map( ( f ) => `  - ${ f.basename }: ${ f.reason }` ).join( '\n' );
		done(
			new Error(
				`otf2ttf: не удалось сконвертировать ${ failures.length } OTF → TTF.\n${ details }`
			)
		);
		return;
	}

	done();
};

export const ttfToWoff = () => {
	return srcFontsByExt( '.ttf' )
		.pipe( fontPlumber() )
		.pipe( convertFont( ttf2woff, '.woff' ) )
		.pipe( app.gulp.dest( `${ app.path.build.fonts }` ) );
};

export const ttfToWoff2 = () => {
	return srcFontsByExt( '.ttf' )
		.pipe( fontPlumber() )
		.pipe( convertFont( ttf2woff2, '.woff2' ) )
		.pipe( app.gulp.dest( `${ app.path.build.fonts }` ) );
};

export const copyWoff = () => {
	const fontsDir = `${ app.path.srcFolder }/fonts`;
	return app.gulp
		.src( [ `${ fontsDir }/*.woff`, `${ fontsDir }/*.woff2` ], {
			allowEmpty: true,
			encoding: false,
		} )
		.pipe( app.gulp.dest( `${ app.path.build.fonts }` ) );
};

export const fontsStyle = ( done ) => {
	const fontsFile = `${ app.path.srcFolder }/scss/fonts.scss`;

	// Licensed @font-face (CoFo Robert copyright notices) — never overwrite.
	if ( fs.existsSync( fontsFile ) ) {
		console.log( 'scss/fonts.scss exists — skip autogenerate' );
		done();
		return;
	}

	if ( ! fs.existsSync( app.path.build.fonts ) ) {
		done();
		return;
	}

	const fontsFiles = fs.readdirSync( app.path.build.fonts );
	if ( ! fontsFiles.length ) {
		done();
		return;
	}

	console.log( 'Файл scss/fonts.scss создан' );

	let scss = '';
	let newFileOnly;

	for ( let i = 0; i < fontsFiles.length; i++ ) {
		const ext = fontsFiles[ i ].slice( fontsFiles[ i ].lastIndexOf( '.' ) );
		if ( ext !== '.woff' && ext !== '.woff2' ) {
			continue;
		}

		const fontFileNameWithExtension = fontsFiles[ i ].replace( ext, '' );
		let fontFileName = fontFileNameWithExtension;

		const isVariableFont = fontFileName.toLowerCase().includes( 'variablefont_' );

		if ( isVariableFont ) {
			fontFileName = fontFileName
				.replace( /-VariableFont_wght/i, '' )
				.replace( /-VariableFont_opsz,wght/i, '' );
		}

		if ( newFileOnly !== fontFileName ) {
			let fontName = fontFileName.split( '-' )[ 0 ]
				? fontFileName.split( '-' )[ 0 ]
				: fontFileName;
			let fontWeight = fontFileName.split( '-' )[ 1 ] || '';
			let fontStyle = 'normal';

			if ( ! isVariableFont ) {
				if ( fontWeight.toLowerCase().includes( 'italic' ) ) {
					fontStyle = 'italic';
					fontWeight = fontWeight.replace( /italic/i, '' ).trim();
				}

				switch ( fontWeight.toLowerCase() ) {
					case 'thin':
						fontWeight = 100;
						break;
					case 'extralight':
						fontWeight = 200;
						break;
					case 'light':
						fontWeight = 300;
						break;
					case 'book':
						fontWeight = 450;
						break;
					case 'medium':
						fontWeight = 500;
						break;
					case 'semibold':
					case 'demi':
						fontWeight = 600;
						break;
					case 'bold':
						fontWeight = 700;
						break;
					case 'extrabold':
					case 'heavy':
						fontWeight = 800;
						break;
					case 'black':
						fontWeight = 900;
						break;
					default:
						fontWeight = 400;
						break;
				}
			}

			if ( isVariableFont ) {
				scss += `@font-face {
								font-family: '${ fontName }';
								src: url("../fonts/${ fontFileNameWithExtension }.woff2") format("woff2 supports variations"),
									url("../fonts/${ fontFileNameWithExtension }.woff2") format("woff2-variations"),
									url("../fonts/${ fontFileNameWithExtension }.woff") format("woff");
								font-weight: 100 900;
								font-stretch: 75% 125%;
								font-style: normal;
								font-display: swap;
							}\r\n`;
			} else {
				scss += `@font-face {
								font-family: '${ fontName }';
								font-display: swap;
								src: url("../fonts/${ fontFileNameWithExtension }.woff2") format("woff2"), url("../fonts/${ fontFileNameWithExtension }.woff") format("woff");
								font-weight: ${ fontWeight };
								font-style: ${ fontStyle };
							}\r\n`;
			}

			newFileOnly = fontFileName;
		}
	}

	fs.writeFileSync( fontsFile, scss );
	done();
};
