<?php

/**
 * Template Name: Technology page
 *
 * @package ntronica
 */

get_header();

$ntronica_tech_hero_title   = get_field('tech_hero_title');
$ntronica_tech_hero_tagline = get_field('tech_hero_tagline');
$ntronica_tech_hero_image   = get_field('tech_hero_image');

$ntronica_tech_hero_title   = is_string($ntronica_tech_hero_title) && '' !== $ntronica_tech_hero_title ? $ntronica_tech_hero_title : '';
$ntronica_tech_hero_tagline = is_string($ntronica_tech_hero_tagline) && '' !== $ntronica_tech_hero_tagline ? $ntronica_tech_hero_tagline : '';
$ntronica_tech_hero_image   = is_string($ntronica_tech_hero_image) && '' !== $ntronica_tech_hero_image ? $ntronica_tech_hero_image : IMG_PATH . '/technology/hero.webp';

$ntronica_media_category = get_field('tech_media_category');
$ntronica_media_category = $ntronica_media_category ? (int) $ntronica_media_category : 0;

$ntronica_media_query = null;
if ($ntronica_media_category > 0) {
	$ntronica_media_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => -1,
			'cat'                 => $ntronica_media_category,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
}

$ntronica_media_items = $ntronica_media_query && $ntronica_media_query->have_posts()
	? ntronica_query_to_items($ntronica_media_query, 'media')
	: array();

$ntronica_slider_items = get_field('slider_items');
$ntronica_slider_items = is_array($ntronica_slider_items) ? $ntronica_slider_items : array();
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_tech_hero_title,
		'image'   => $ntronica_tech_hero_image,
		'tagline' => $ntronica_tech_hero_tagline,
		'nav'     => ntronica_get_page_section_nav('technology'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'tech-microchips'); ?>

<?php if (! empty($ntronica_slider_items)) : ?>
<?php get_template_part('components/templates-parts/section', 'progress-slider'); ?>
<?php endif; ?>

<?php if (! empty($ntronica_media_items)) : ?>
<?php
get_template_part(
	'components/templates-parts/section',
	'media-publications',
	array(
		'items' => $ntronica_media_items,
	)
);
?>
<?php endif; ?>

<?php
get_footer();
