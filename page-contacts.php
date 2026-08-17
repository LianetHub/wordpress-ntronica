<?php

/**
 * Contacts page template
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
		'title' => 'Contacts',
		'image' => IMG_PATH . '/contacts/hero.png',
		'nav'   => array(
			array(
				'href'  => '#about',
				'label' => 'Company information',
			),
			array(
				'href'  => '#our-representative',
				'label' => 'Our representative',
			),
			array(
				'href'  => '#contacts',
				'label' => 'Contact us',
			),
		),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contacts-representative'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
