<?php

/**
 * Theme setup
 *
 * @package ntronica
 */

add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain('ntronica', get_template_directory() . '/languages');

		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
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
				'primary' => 'Primary',
			)
		);
	}
);

/**
 * Default news categories for the posts page sections.
 */
function ntronica_news_categories()
{
	return array(
		'events' => 'Events & news',
		'press'  => 'Press releases',
		'media'  => 'Media publications',
	);
}

add_action(
	'init',
	function () {
		foreach (ntronica_news_categories() as $ntronica_slug => $ntronica_name) {
			if (! term_exists($ntronica_slug, 'category')) {
				wp_insert_term(
					$ntronica_name,
					'category',
					array(
						'slug' => $ntronica_slug,
					)
				);
			}
		}
	}
);

add_action(
	'pre_get_posts',
	function ($query) {
		if (is_admin() || ! $query->is_main_query() || ! $query->is_home()) {
			return;
		}

		$query->set('posts_per_page', 1);
		$query->set('no_found_rows', true);
	}
);

/**
 * Allow SVG uploads.
 *
 * @param array $mimes Mime types.
 * @return array
 */
function ntronica_allow_svg_uploads($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'ntronica_allow_svg_uploads');
