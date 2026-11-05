import crypto from 'crypto';
import fs from 'fs/promises';
import path from 'path';
import { promisify } from 'util';
import gulp from 'gulp';
import globCb from 'glob';
import {
	assetsDeployGlobs,
	createSftpConnection,
	deployGlobs,
	ftpEnv,
	isFtpConfigured,
} from '../config/ftp.js';

const glob = promisify( globCb );

const DEBOUNCE_MS = 400;
const MANIFEST_NAME = '.sftp-deploy-manifest.json';
const HASH_ALGO = 'sha1';

let pendingPaths = new Set();
let debounceTimer = null;
let deployQueue = Promise.resolve();

/** In-memory copy of remote manifest; kept fresh across deploy + watch uploads. */
let manifestCache = null;

function log( message ) {
	console.log( `[SFTP] ${ message }` );
}

function toPosix( filePath ) {
	return filePath.replace( /\\/g, '/' );
}

function remoteFilePath( localPath ) {
	return toPosix( path.posix.join( ftpEnv.FTP_REMOTE_PATH, toPosix( localPath ) ) );
}

function remoteManifestPath() {
	return remoteFilePath( MANIFEST_NAME );
}

function isForceFullDeploy() {
	return (
		process.argv.includes( '--ftp-full' ) ||
		process.env.FTP_FORCE_FULL === '1'
	);
}

function emptyManifest() {
	return { version: 1, files: {} };
}

async function hashFile( localPath ) {
	const data = await fs.readFile( localPath );
	return crypto.createHash( HASH_ALGO ).update( data ).digest( 'hex' );
}

async function buildLocalHashes( localPaths ) {
	const entries = await Promise.all(
		localPaths.map( async ( localPath ) => {
			const hash = await hashFile( localPath );
			return [ toPosix( localPath ), hash ];
		} )
	);
	return Object.fromEntries( entries );
}

async function downloadRemoteManifest( sftp ) {
	const remotePath = remoteManifestPath();

	try {
		const exists = await sftp.exists( remotePath );
		if ( ! exists ) {
			log( 'No remote manifest — full upload' );
			return emptyManifest();
		}

		const buffer = await sftp.get( remotePath );
		const raw = Buffer.isBuffer( buffer )
			? buffer.toString( 'utf8' )
			: String( buffer );
		const parsed = JSON.parse( raw );

		if ( ! parsed || typeof parsed.files !== 'object' ) {
			log( 'Remote manifest invalid — full upload' );
			return emptyManifest();
		}

		log(
			`Remote manifest: ${ Object.keys( parsed.files ).length } file(s)`
		);
		return { version: 1, files: parsed.files };
	} catch ( error ) {
		log( `Manifest download failed (${ error.message }) — full upload` );
		return emptyManifest();
	}
}

async function ensureRemoteDir( sftp, remoteFile ) {
	const remoteDir = path.posix.dirname( remoteFile );
	await sftp.mkdir( remoteDir, true );
}

async function uploadManifest( sftp, manifest ) {
	const remotePath = remoteManifestPath();
	await ensureRemoteDir( sftp, remotePath );
	await sftp.put(
		Buffer.from( JSON.stringify( manifest, null, 2 ), 'utf8' ),
		remotePath
	);
	manifestCache = manifest;
}

function pickChangedPaths( localHashes, remoteManifest, forceFull ) {
	if ( forceFull ) {
		return Object.keys( localHashes );
	}

	const remoteFiles = remoteManifest.files || {};
	return Object.keys( localHashes ).filter(
		( localPath ) => localHashes[ localPath ] !== remoteFiles[ localPath ]
	);
}

function mergeManifest( base, localHashes, uploadedPaths ) {
	const files = { ...( base.files || {} ) };

	for ( const localPath of uploadedPaths ) {
		files[ localPath ] = localHashes[ localPath ];
	}

	return { version: 1, files };
}

async function uploadFiles( localPaths, label ) {
	const sftp = await createSftpConnection();
	if ( ! sftp ) {
		log( 'Credentials not configured, skipping deploy' );
		return;
	}

	const uniquePaths = [ ...new Set( localPaths.map( toPosix ) ) ]
		.filter( Boolean )
		.filter(
			( filePath ) => path.posix.basename( filePath ) !== MANIFEST_NAME
		);

	if ( ! uniquePaths.length ) {
		await sftp.end();
		return;
	}

	if ( label ) {
		log( label );
	}

	try {
		const forceFull = isForceFullDeploy();
		if ( forceFull ) {
			log( 'Force full deploy (--ftp-full / FTP_FORCE_FULL=1)' );
		}

		const localHashes = await buildLocalHashes( uniquePaths );

		if ( ! manifestCache ) {
			manifestCache = forceFull
				? emptyManifest()
				: await downloadRemoteManifest( sftp );
		}

		const toUpload = pickChangedPaths(
			localHashes,
			manifestCache,
			forceFull
		);
		const skipped = uniquePaths.length - toUpload.length;

		if ( skipped > 0 ) {
			log( `Skip unchanged: ${ skipped }` );
		}

		if ( ! toUpload.length ) {
			log( 'Nothing to upload — all files match remote manifest' );
			return;
		}

		log( `Uploading ${ toUpload.length } file(s)...` );

		for ( const localPath of toUpload ) {
			const remotePath = remoteFilePath( localPath );
			await ensureRemoteDir( sftp, remotePath );
			await sftp.fastPut( localPath, remotePath );
			log( `↑ ${ localPath }` );
		}

		const nextManifest = mergeManifest(
			manifestCache,
			localHashes,
			toUpload
		);
		await uploadManifest( sftp, nextManifest );
		log(
			`Manifest updated (${ Object.keys( nextManifest.files ).length } file(s))`
		);
	} finally {
		await sftp.end();
	}
}

async function resolveGlobs( globs ) {
	const patterns = Array.isArray( globs ) ? globs : [ globs ];
	const matches = await Promise.all(
		patterns.map( ( pattern ) =>
			glob( pattern, {
				nodir: true,
				dot: false,
			} )
		)
	);
	return [ ...new Set( matches.flat().map( toPosix ) ) ];
}

const MAX_DEPLOY_ATTEMPTS = 3;

async function deployToSftp( globs, label, attempt = 1 ) {
	if ( ! isFtpConfigured() ) {
		return;
	}

	try {
		const files = await resolveGlobs( globs );
		await uploadFiles( files, attempt === 1 ? label : undefined );
	} catch ( error ) {
		if ( attempt >= MAX_DEPLOY_ATTEMPTS ) {
			throw error;
		}

		log( `Retry ${ attempt }/${ MAX_DEPLOY_ATTEMPTS - 1 }: ${ error.message }` );
		await new Promise( ( resolve ) => setTimeout( resolve, 1500 * attempt ) );
		await deployToSftp( globs, label, attempt + 1 );
	}
}

function reloadBrowserIfActive() {
	if ( app.plugins.browsersync.active ) {
		app.plugins.browsersync.reload();
	}
}

async function uploadPaths( paths ) {
	await uploadFiles( paths );
	reloadBrowserIfActive();
}

function flushPendingUploads() {
	const paths = [ ...pendingPaths ];
	pendingPaths.clear();
	debounceTimer = null;

	if ( ! paths.length ) {
		return Promise.resolve();
	}

	deployQueue = deployQueue.then( () => uploadPaths( paths ) );
	return deployQueue;
}

export function queueFtpDeploy( paths ) {
	if ( ! app.isDev || ! isFtpConfigured() ) {
		return Promise.resolve();
	}

	const normalized = ( Array.isArray( paths ) ? paths : [ paths ] ).map( toPosix );

	normalized.forEach( ( filePath ) => pendingPaths.add( filePath ) );

	if ( debounceTimer ) {
		clearTimeout( debounceTimer );
	}

	return new Promise( ( resolve ) => {
		debounceTimer = setTimeout( () => {
			flushPendingUploads().then( resolve );
		}, DEBOUNCE_MS );
	} );
}

export function ftpDeployAll() {
	if ( ! isFtpConfigured() ) {
		log( 'Credentials not configured, skipping full deploy' );
		return Promise.resolve();
	}

	log( `Full deploy to ${ ftpEnv.FTP_REMOTE_PATH }` );

	return deployToSftp( deployGlobs ).then( () => {
		log( 'Full deploy complete' );
	} );
}

export function ftpDeployAssets() {
	if ( ! isFtpConfigured() ) {
		log( 'Credentials not configured, skipping assets deploy' );
		return Promise.resolve();
	}

	log( `Assets deploy to ${ ftpEnv.FTP_REMOTE_PATH }` );

	return deployToSftp( assetsDeployGlobs ).then( () => {
		log( 'Assets deploy complete' );
	} );
}

export function ftpDeployChanged( filePath ) {
	return queueFtpDeploy( [ filePath ] );
}

export function ftpDeployGlobs( globs, { reload = false } = {} ) {
	if ( ! app.isDev || ! isFtpConfigured() ) {
		return ( done ) => done();
	}

	return () =>
		deployToSftp( globs ).then( () => {
			if ( reload ) {
				reloadBrowserIfActive();
			}
		} );
}

export function withFtpDeploy( task, globs, options = {} ) {
	return gulp.series( task, ftpDeployGlobs( globs, options ) );
}
