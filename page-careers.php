<?php

/**
 * Template Name: Careers page
 *
 * @package ntronica
 */

get_header();
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title' => 'Careers',
		'image' => IMG_PATH . '/careers/hero.webp',
		'tagline' => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'nav'   => ntronica_get_page_section_nav('careers'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'careers-team'); ?>
<?php get_template_part('components/templates-parts/section', 'vacancies'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
