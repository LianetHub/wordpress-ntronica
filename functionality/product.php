<?php

/**
 * Product custom post type.
 *
 * Single URLs: /products/{slug}/. The /products/ page stays the hub.
 *
 * @package ntronica
 */

/**
 * Register the product post type.
 */
function ntronica_register_product_post_type()
{
	register_post_type(
		'product',
		array(
			'labels'        => array(
				'name'               => 'Products',
				'singular_name'      => 'Product',
				'add_new'            => 'Add new',
				'add_new_item'       => 'Add product',
				'edit_item'          => 'Edit product',
				'new_item'           => 'New product',
				'view_item'          => 'View product',
				'search_items'       => 'Search products',
				'not_found'          => 'No products found',
				'not_found_in_trash' => 'No products found in Trash',
				'menu_name'          => 'Products',
			),
			'public'        => true,
			'has_archive'   => false,
			'show_in_rest'  => false,
			'menu_icon'     => 'dashicons-screenoptions',
			'menu_position' => 7,
			'rewrite'       => array(
				'slug'       => 'products',
				'with_front' => false,
			),
			'supports'      => array('title'),
		)
	);

	add_rewrite_rule('^products/([^/]+)/?$', 'index.php?product=$matches[1]', 'top');
}
add_action('init', 'ntronica_register_product_post_type');

/**
 * Flush rewrites once so /products/{slug}/ resolves.
 */
function ntronica_maybe_flush_product_rewrites()
{
	if ('1' === get_option('ntronica_product_rewrite_version')) {
		return;
	}

	flush_rewrite_rules(false);
	update_option('ntronica_product_rewrite_version', '1', false);
}
add_action('init', 'ntronica_maybe_flush_product_rewrites', 99);
