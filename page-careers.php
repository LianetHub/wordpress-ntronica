<?php

/**
 * Careers page template
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
		'title'        => 'Careers',
		'image'        => IMG_PATH . '/careers/hero.png',
		'tagline_dark' => true,
		'nav'          => array(
			array(
				'href'  => '#team',
				'label' => 'Our team',
			),
			array(
				'href'  => '#careers',
				'label' => 'Immediate vacancies',
			),
			array(
				'href'  => '#contacts',
				'label' => 'Contact us',
			),
		),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'careers-team'); ?>
<?php get_template_part('components/templates-parts/section', 'vacancies'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
