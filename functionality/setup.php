<?php
/**
 * Theme setup
 *
 * @package ntronica
 */

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'ntronica', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'ntronica' ),
			)
		);
	}
);

/**
 * Allow SVG uploads.
 *
 * @param array $mimes Mime types.
 * @return array
 */
function ntronica_allow_svg_uploads( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'ntronica_allow_svg_uploads' );
