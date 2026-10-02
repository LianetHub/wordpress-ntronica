<?php

/**
 * Single vacancy.
 *
 * @package ntronica
 */

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		get_template_part('components/templates-parts/section', 'vacancy');
	}
}

get_template_part('components/templates-parts/section', 'contact');

get_footer();
