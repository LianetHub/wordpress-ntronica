<?php

/**
 * Template Name: Contacts page
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
		'image' => IMG_PATH . '/contacts/hero.webp',
		'tagline' => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'nav'   => ntronica_get_page_section_nav('contacts'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contacts-representative'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
