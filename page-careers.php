<?php

/**
 * Template Name: Careers page
 *
 * @package ntronica
 */

get_header();

$ntronica_hero_title   = get_field('careers_hero_title');
$ntronica_hero_tagline = get_field('careers_hero_tagline');
$ntronica_hero_image   = get_field('careers_hero_image');

$ntronica_hero_title   = is_string($ntronica_hero_title) && '' !== $ntronica_hero_title ? $ntronica_hero_title : '';
$ntronica_hero_tagline = is_string($ntronica_hero_tagline) && '' !== $ntronica_hero_tagline ? $ntronica_hero_tagline : '';
$ntronica_hero_image   = is_string($ntronica_hero_image) && '' !== $ntronica_hero_image ? $ntronica_hero_image : IMG_PATH . '/careers/hero.webp';
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_hero_title,
		'image'   => $ntronica_hero_image,
		'tagline' => $ntronica_hero_tagline,
		'nav'     => ntronica_get_page_section_nav('careers'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'careers-team'); ?>
<?php get_template_part('components/templates-parts/section', 'vacancies'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
