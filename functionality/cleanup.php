<?php

/**
 * Head cleanup and frontend optimizations
 *
 * @package ntronica
 */

// =============================================================================
// HEAD CLEANUP
// =============================================================================

remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

add_filter( 'the_generator', '__return_empty_string' );

// =============================================================================
// DISABLE RSS FEEDS
// =============================================================================

/**
 * Disable feed endpoints.
 */
function ntronica_disable_feeds() {
	wp_die( 'No feed available', '', array( 'response' => 404 ) );
}

add_action( 'do_feed', 'ntronica_disable_feeds', 1 );
add_action( 'do_feed_rdf', 'ntronica_disable_feeds', 1 );
add_action( 'do_feed_rss', 'ntronica_disable_feeds', 1 );
add_action( 'do_feed_rss2', 'ntronica_disable_feeds', 1 );
add_action( 'do_feed_atom', 'ntronica_disable_feeds', 1 );

// =============================================================================
// DASHICONS (front)
// =============================================================================

add_action(
	'wp_enqueue_scripts',
	function () {
		if ( ! is_user_logged_in() ) {
			wp_deregister_style( 'dashicons' );
		}
	}
);

// =============================================================================
// AUTOSIZES INLINE CSS
// =============================================================================

add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );

// =============================================================================
// EMOJI
// =============================================================================

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

add_filter(
	'tiny_mce_plugins',
	function ( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		}

		return array();
	}
);

add_filter(
	'wp_resource_hints',
	function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$urls = array_diff( $urls, array( 'https://s.w.org/images/core/emoji/' ) );
		}

		return $urls;
	},
	10,
	2
);

// =============================================================================
// GUTENBERG BLOCK STYLES (front)
// =============================================================================

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	},
	100
);

// =============================================================================
// EXTRA IMAGE SIZES
// =============================================================================

add_action( 'after_setup_theme', 'ntronica_remove_image_sizes', 999 );

/**
 * Remove unused intermediate image sizes.
 */
function ntronica_remove_image_sizes() {
	remove_image_size( 'medium_large' );
	remove_image_size( '1536x1536' );
	remove_image_size( '2048x2048' );
}

