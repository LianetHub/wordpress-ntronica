<?php

/**
 * Template Name: Contacts page — powered by ACF
 *
 * @package ntronica
 */

get_header();

$ntronica_hero_title   = get_field('contacts_hero_title');
$ntronica_hero_tagline = get_field('contacts_hero_tagline');
$ntronica_hero_image   = get_field('contacts_hero_image');

$ntronica_hero_title   = is_string($ntronica_hero_title) && '' !== $ntronica_hero_title ? $ntronica_hero_title : 'Contacts';
$ntronica_hero_tagline = is_string($ntronica_hero_tagline) && '' !== $ntronica_hero_tagline ? $ntronica_hero_tagline : 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities';
$ntronica_hero_image   = is_string($ntronica_hero_image) && '' !== $ntronica_hero_image ? $ntronica_hero_image : IMG_PATH . '/contacts/hero.webp';
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_hero_title,
		'image'   => $ntronica_hero_image,
		'tagline' => $ntronica_hero_tagline,
		'nav'     => ntronica_get_page_section_nav('contacts'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contacts-representative'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
