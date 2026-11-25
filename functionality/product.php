<?php

/**
 * Product custom post type.
 *
 * Category and product routes under the /products/ hub.
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
				'slug'       => 'products/%product_category%',
				'with_front' => false,
			),
			'supports'      => array('title', 'thumbnail'),
		)
	);

	register_taxonomy('product_category', array('product'), array(
		'label'             => 'Product categories',
		'public'            => true,
		'hierarchical'      => true,
		'show_in_quick_edit' => false,
		'show_admin_column' => true,
		'meta_box_cb'       => 'ntronica_product_category_meta_box',
		'rewrite'           => array('slug' => 'products', 'with_front' => false),
	));
	add_rewrite_rule('^products/([^/]+)/([^/]+)/?$', 'index.php?product=$matches[2]&product_category=$matches[1]', 'top');
	add_rewrite_rule('^products/([^/]+)/?$', 'index.php?product_category=$matches[1]', 'top');
}
add_action('init', 'ntronica_register_product_post_type');

/** Stable mock category catalogue, shared by links and initial terms. */
function ntronica_get_product_categories()
{
	return array(
		'epitaxy' => 'Epitaxy',
		'deposition' => 'Deposition',
		'etching' => 'Etching',
		'thermal-processing' => 'Thermal Processing',
		'planarization' => 'Planarization',
		'metrology' => 'Metrology',
		'inspection-and-analytics' => 'Inspection and Analytics',
	);
}



function ntronica_get_product_category_slug($name)
{
	$name = strtolower(str_replace('&', 'and', trim($name)));
	foreach (ntronica_get_product_categories() as $slug => $label) {
		if ($name === strtolower($label) || $name === $slug) {
			return $slug;
		}
	}
	return '';
}

function ntronica_get_product_category_url($name)
{
	$slug = ntronica_get_product_category_slug($name);
	$term = $slug ? get_term_by('slug', $slug, 'product_category') : false;
	$url = $term ? get_term_link($term) : false;
	return $url && ! is_wp_error($url) ? $url : home_url('/products/' . $slug . '/');
}



/** A single-select editor avoids ambiguous product URLs. */
function ntronica_product_category_meta_box($post)
{
	$terms = wp_get_object_terms($post->ID, 'product_category');
	$selected = ! is_wp_error($terms) && $terms ? $terms[0]->term_id : 0;
	echo '<input type="hidden" name="tax_input[product_category][]" value="0">';
	wp_dropdown_categories(array(
		'taxonomy' => 'product_category',
		'name' => 'tax_input[product_category][]',
		'selected' => $selected,
		'hide_empty' => false,
		'show_option_none' => 'Select category',
		'option_none_value' => 0,
	));
}

function ntronica_product_permalink($url, $post)
{
	if ('product' !== $post->post_type) {
		return $url;
	}
	$terms = wp_get_object_terms($post->ID, 'product_category', array('orderby' => 'term_id'));
	$slug = ! is_wp_error($terms) && $terms ? $terms[0]->slug : 'uncategorized';
	return str_replace('%product_category%', $slug, $url);
}
add_filter('post_type_link', 'ntronica_product_permalink', 10, 2);

/** Reject alternate category paths, including additional assigned categories. */
function ntronica_validate_product_category_route()
{
	if (! is_singular('product')) {
		return;
	}
	$post = get_queried_object();
	$terms = wp_get_object_terms($post->ID, 'product_category', array('orderby' => 'term_id'));
	if (is_wp_error($terms) || ! $terms || get_query_var('product_category') !== $terms[0]->slug) {
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		nocache_headers();
	}
}
add_action('template_redirect', 'ntronica_validate_product_category_route', 1);

/** Development routes intentionally have no guessed canonical redirects. */
function ntronica_product_canonical_redirect($redirect)
{
	global $wp;
	return isset($wp->request) && preg_match('#^products/[^/]+#', $wp->request) ? false : $redirect;
}
add_filter('redirect_canonical', 'ntronica_product_canonical_redirect');

/**
 * Flush rewrites once after registering category and nested product routes.
 */
function ntronica_maybe_flush_product_rewrites()
{
	if ('2' === get_option('ntronica_product_rewrite_version')) {
		return;
	}

	flush_rewrite_rules(false);
	update_option('ntronica_product_rewrite_version', '2', false);
}
add_action('init', 'ntronica_maybe_flush_product_rewrites', 99);
