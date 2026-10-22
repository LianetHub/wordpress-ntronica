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
			'supports'      => array('title'),
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

/** Preserve editor-renamed terms while matching the design's default label. */
function ntronica_get_product_category_display_name($term)
{
	return 'Inspection and Analytics' === $term->name ? 'Inspection & Analytics' : $term->name;
}

/** Temporary category copy; product lists remain mock data. */
function ntronica_get_product_category_intro($slug)
{
	$planarization = 'Planarization is critical for multilevel interconnect structures, where uneven surfaces can cause photolithography focus errors and poor step coverage during later depositions. Post-CMP cleaning removes slurry residues and particles, restoring a clean surface for the next manufacturing step.';
	$metrology = 'Metrology, inspection, and analytics comprise the tests used to verify that a wafer meets specifications before the next process step. Metrology measures properties such as film thickness, refractive index, and critical dimensions. Inspection detects defects including particles, scratches, and pattern anomalies.';
	$copy = array(
		'epitaxy' => array(
			'Epitaxy is the process of growing a crystalline layer on a substrate, where the new layer inherits the crystal orientation of the wafer. In GaN MOCVD (Metal-Organic Chemical Vapor Deposition), metalorganic precursors and hydride gases like ammonia react on heated substrate to form thin films of gallium nitride and III-N compounds.',
			'Metalorganic precursors and ammonia react on a heated substrate to form thin films. This process is essential for manufacturing high-frequency and high-power devices, including HEMTs, UHF transistors, LEDs, and laser diodes.',
		),
		'deposition' => array('Deposition refers to the application of thin films of dielectric, semiconductor, or metal materials onto a wafer surface. Techniques such as PECVD, ICP-CVD, and sputtering are commonly used to deposit layers like SiO₂, Si₃N₄, and various metals.'),
		'etching' => array(
			'Etching is the selective removal of material from the wafer surface to transfer patterns defined by lithography. It is broadly classified into wet (chemical) and dry (plasma-based) etching.',
			'Dry etching, including RIE (Reactive Ion Etching) and ICP (Inductively Coupled Plasma), provides directional (anisotropic) profiles essential for fine feature definition.',
		),
		'thermal-processing' => array('Thermal operations use controlled heating to modify material properties without melting the wafer. Rapid Thermal Annealing (RTA) heats the wafer quickly to activate dopants after ion implantation, repair crystal damage, or form silicides and ohmic contacts.'),
		'planarization' => array('Chemical Mechanical Planarization (CMP) is a process that combines chemical etching with mechanical polishing to flatten the wafer surface. It removes topographic variations caused by previous process steps, such as deposition or etching, creating a globally flat surface.', $planarization),
		'metrology' => array($metrology),
		'inspection-and-analytics' => array($metrology, $planarization),
	);
	return $copy[$slug] ?? array();
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

/** Retry on failure; never overwrite terms or an existing product assignment. */
function ntronica_seed_product_categories()
{
	if ('1' === get_option('ntronica_product_categories_version')) {
		return;
	}
	foreach (ntronica_get_product_categories() as $slug => $label) {
		if (! term_exists($slug, 'product_category')) {
			$result = wp_insert_term($label, 'product_category', array('slug' => $slug));
			if (is_wp_error($result)) {
				return;
			}
		}
	}
	$product = get_page_by_path('plasma-200-01', OBJECT, 'product');
	if ($product && ! has_term('', 'product_category', $product)) {
		$result = wp_set_object_terms($product->ID, 'etching', 'product_category');
		if (is_wp_error($result)) {
			return;
		}
	}
	update_option('ntronica_product_categories_version', '1', false);
}
add_action('init', 'ntronica_seed_product_categories', 20);

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
