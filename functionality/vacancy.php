<?php

/**
 * Vacancy custom post type.
 *
 * Single URLs: /careers/{slug}/. The /careers/ page stays the hub.
 *
 * @package ntronica
 */

/**
 * Register the vacancy post type.
 */
function ntronica_register_vacancy_post_type()
{
	register_post_type(
		'vacancy',
		array(
			'labels'        => array(
				'name'               => 'Vacancies',
				'singular_name'      => 'Vacancy',
				'add_new'            => 'Add new',
				'add_new_item'       => 'Add vacancy',
				'edit_item'          => 'Edit vacancy',
				'new_item'           => 'New vacancy',
				'view_item'          => 'View vacancy',
				'search_items'       => 'Search vacancies',
				'not_found'          => 'No vacancies found',
				'not_found_in_trash' => 'No vacancies found in Trash',
				'menu_name'          => 'Vacancies',
			),
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => false,
			'menu_icon'     => 'dashicons-id',
			'menu_position' => 6,
			'rewrite'       => array(
				'slug'       => 'careers',
				'with_front' => false,
			),
			'supports'      => array('title'),
		)
	);

	add_rewrite_rule('^careers/([^/]+)/?$', 'index.php?vacancy=$matches[1]', 'top');
}
add_action('init', 'ntronica_register_vacancy_post_type');

/**
 * Flush rewrites once so /careers/{slug}/ resolves.
 */
function ntronica_maybe_flush_vacancy_rewrites()
{
	if ('2' === get_option('ntronica_vacancy_rewrite_version')) {
		return;
	}

	flush_rewrite_rules(false);
	update_option('ntronica_vacancy_rewrite_version', '2', false);
}
add_action('init', 'ntronica_maybe_flush_vacancy_rewrites', 99);
