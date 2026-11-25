<?php

/**
 * Template Name: Products page
 *
 * @package ntronica
 */

get_header();

$ntronica_hero_title   = get_field('products_hero_title');
$ntronica_hero_tagline = get_field('products_hero_tagline');
$ntronica_hero_image   = get_field('products_hero_image');

$ntronica_hero_title   = is_string($ntronica_hero_title) && '' !== $ntronica_hero_title ? $ntronica_hero_title : '';
$ntronica_hero_tagline = is_string($ntronica_hero_tagline) && '' !== $ntronica_hero_tagline ? $ntronica_hero_tagline : '';
$ntronica_hero_image   = is_string($ntronica_hero_image) && '' !== $ntronica_hero_image ? $ntronica_hero_image : '';

$ntronica_thin_films_title     = get_field('products_thin_films_title');
$ntronica_thin_films_intro_c1  = get_field('products_thin_films_intro_col1');
$ntronica_thin_films_intro_c2  = get_field('products_thin_films_intro_col2');
$ntronica_thin_films_items     = get_field('products_thin_films_items');

$ntronica_thin_films_title    = is_string($ntronica_thin_films_title) && '' !== $ntronica_thin_films_title ? $ntronica_thin_films_title : '';
$ntronica_thin_films_intro_c1 = is_string($ntronica_thin_films_intro_c1) ? $ntronica_thin_films_intro_c1 : '';
$ntronica_thin_films_intro_c2 = is_string($ntronica_thin_films_intro_c2) ? $ntronica_thin_films_intro_c2 : '';
$ntronica_thin_films_items    = is_array($ntronica_thin_films_items) ? $ntronica_thin_films_items : array();

$ntronica_lines = get_field('products_lines');
$ntronica_lines = is_array($ntronica_lines) ? $ntronica_lines : array();
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_hero_title,
		'image'   => $ntronica_hero_image,
		'tagline' => $ntronica_hero_tagline,
		'nav'     => ntronica_get_page_section_nav('products'),
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'products-thin-films',
	array(
		'title'     => $ntronica_thin_films_title,
		'intro_c1'  => $ntronica_thin_films_intro_c1,
		'intro_c2'  => $ntronica_thin_films_intro_c2,
		'items'     => $ntronica_thin_films_items,
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'products-lines',
	array(
		'lines' => $ntronica_lines,
	)
);
?>

<?php
get_footer();
