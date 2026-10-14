<?php

/**
 * Single product.
 *
 * @package ntronica
 */

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		get_template_part('components/templates-parts/section', 'product');
	}
}

get_template_part('components/templates-parts/section', 'product-specs');

get_footer();
