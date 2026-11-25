<?php

/**
 * Template Name: About page
 *
 * @package ntronica
 */

get_header();

$ntronica_hero_title   = get_field('about_hero_title');
$ntronica_hero_tagline = get_field('about_hero_tagline');
$ntronica_hero_image   = get_field('about_hero_image');

$ntronica_hero_title   = is_string($ntronica_hero_title) && '' !== $ntronica_hero_title ? $ntronica_hero_title : '';
$ntronica_hero_tagline = is_string($ntronica_hero_tagline) && '' !== $ntronica_hero_tagline ? $ntronica_hero_tagline : '';
$ntronica_hero_image   = is_string($ntronica_hero_image) && '' !== $ntronica_hero_image ? $ntronica_hero_image : IMG_PATH . '/about/hero.webp';
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_hero_title,
		'image'   => $ntronica_hero_image,
		'tagline' => $ntronica_hero_tagline,
		'nav'     => ntronica_get_page_section_nav('about'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'about-overview'); ?>
<?php get_template_part('components/templates-parts/section', 'about-goal'); ?>
<?php get_template_part('components/templates-parts/section', 'about-stats'); ?>
<?php get_template_part('components/templates-parts/section', 'about-solutions'); ?>

<?php
get_footer();
