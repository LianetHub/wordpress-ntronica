<?php

/**
 * Front page template 
 *
 * @package ntronica
 */

get_header();

// Temporary mock content — real WP posts wiring comes later.
$ntronica_news_items = array_fill(
	0,
	4,
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor',
		'url'   => '#',
	)
);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => '',
		'tagline' => 'Technological language of the future',
		'image'   => IMG_PATH . '/home/hero.webp',
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'home-overview'); ?>
<?php get_template_part('components/templates-parts/section', 'products'); ?>
<?php get_template_part('components/templates-parts/section', 'progress-slider'); ?>
<?php
get_template_part(
	'components/templates-parts/section',
	'news',
	array(
		'items' => $ntronica_news_items,
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'vacancies'); ?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
