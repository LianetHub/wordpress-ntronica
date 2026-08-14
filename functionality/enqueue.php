<?php
/**
 * Enqueue styles and scripts
 *
 * @package ntronica
 */

/**
 * Asset version from filemtime when the file exists.
 *
 * @param string $absolute_path Absolute path to the asset file.
 * @return string|int
 */
function ntronica_asset_ver( $absolute_path ) {
	return file_exists( $absolute_path ) ? filemtime( $absolute_path ) : '1.0.0';
}

/**
 * Enqueue theme styles (page-template aware).
 */
function ntronica_enqueue_styles() {
	$page_template = get_page_template_slug();

	$reset_file = STYLES_DIR . '/reset.min.css';
	if ( file_exists( $reset_file ) ) {
		wp_enqueue_style(
			'ntronica-reset',
			STYLES_PATH . '/reset.min.css',
			array(),
			ntronica_asset_ver( $reset_file )
		);
	}

	$style_deps = file_exists( $reset_file ) ? array( 'ntronica-reset' ) : array();

	switch ( $page_template ) {
		default:
			if ( is_front_page() ) {
				$swiper_css = STYLES_DIR . '/libs/swiper-bundle.min.css';
				if ( file_exists( $swiper_css ) ) {
					wp_enqueue_style(
						'swiper',
						STYLES_PATH . '/libs/swiper-bundle.min.css',
						array(),
						ntronica_asset_ver( $swiper_css )
					);
					$style_deps[] = 'swiper';
				}
			}
			break;
	}

	$main_css = STYLES_DIR . '/style.min.css';
	if ( file_exists( $main_css ) ) {
		wp_enqueue_style(
			'ntronica-style',
			STYLES_PATH . '/style.min.css',
			$style_deps,
			ntronica_asset_ver( $main_css )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ntronica_enqueue_styles' );

/**
 * Preload first-paint fonts for PSI.
 *
 * Only Nanotronica_Text Regular/Bold (body, titles, hero). CoFo and unused
 * Title/Reduct faces stay CSS-only so they do not compete with LCP.
 *
 * @param array $preload_resources Preload link descriptors.
 * @return array
 */
function ntronica_preload_fonts( $preload_resources ) {
	$fonts_dir = get_template_directory() . '/assets/fonts/';
	$files     = array(
		'Nanotronica_Text-Regular.woff2',
		'Nanotronica_Text-Bold.woff2',
	);

	foreach ( $files as $file ) {
		if ( ! file_exists( $fonts_dir . $file ) ) {
			continue;
		}

		$preload_resources[] = array(
			'href'        => FONTS_PATH . '/' . $file,
			'as'          => 'font',
			'type'        => 'font/woff2',
			'crossorigin' => 'anonymous',
		);
	}

	return $preload_resources;
}
add_filter( 'wp_preload_resources', 'ntronica_preload_fonts' );

/**
 * Enqueue theme scripts (page-template aware).
 */
function ntronica_enqueue_scripts() {
	$page_template = get_page_template_slug();
	$app_deps      = array( 'jquery' );

	wp_enqueue_script( 'jquery' );

	switch ( $page_template ) {
		default:
			if ( is_front_page() ) {
				$swiper_js = JS_DIR . '/libs/swiper-bundle.min.js';
				if ( file_exists( $swiper_js ) ) {
					wp_enqueue_script(
						'swiper',
						JS_PATH . '/libs/swiper-bundle.min.js',
						array(),
						ntronica_asset_ver( $swiper_js ),
						array(
							'in_footer' => true,
							'strategy'  => 'defer',
						)
					);
					$app_deps[] = 'swiper';
				}
			}
			break;
	}

	$app_js = JS_DIR . '/app.min.js';
	if ( file_exists( $app_js ) ) {
		wp_enqueue_script(
			'ntronica-app',
			JS_PATH . '/app.min.js',
			$app_deps,
			ntronica_asset_ver( $app_js ),
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'ntronica_enqueue_scripts' );

/**
 * Load selected stylesheets asynchronously for guests.
 *
 * @param string $tag    Link tag.
 * @param string $handle Style handle.
 * @param string $src    Stylesheet URL.
 * @return string
 */
function ntronica_make_styles_async( $tag, $handle, $src ) {
	if ( is_admin() || is_user_logged_in() ) {
		return $tag;
	}

	$async_styles = array(
		'swiper',
		'fancybox',
		'intlTelInput',
		'calendly',
	);

	if ( in_array( $handle, $async_styles, true ) ) {
		$async_tag  = '<link rel="preload" id="' . esc_attr( $handle ) . '-css-preload" href="' . esc_url( $src ) . '" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
		$async_tag .= '<noscript>' . $tag . '</noscript>';
		return $async_tag;
	}

	return $tag;
}
add_filter( 'style_loader_tag', 'ntronica_make_styles_async', 10, 3 );

/**
 * Defer reCAPTCHA scripts for guests.
 *
 * @param string $tag Script tag.
 * @return string
 */
function ntronica_defer_js( $tag ) {
	if ( is_user_logged_in() ) {
		return $tag;
	}

	if ( false !== strpos( $tag, 'recaptcha/api.js' ) || false !== strpos( $tag, 'recaptcha/index.js' ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'ntronica_defer_js', 11 );
