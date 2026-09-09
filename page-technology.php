<?php

/**
 * Template Name: Technology page
 *
 * @package ntronica
 */

get_header();

// Temporary mock content — real WP posts wiring comes later.
$ntronica_media_items = array_fill(
	0,
	18,
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
		'url'     => '#',
	)
);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => 'Technology',
		'image'   => IMG_PATH . '/technology/hero.webp',
		'tagline' => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'nav'     => ntronica_get_page_section_nav('technology'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'tech-microchips'); ?>
<?php get_template_part('components/templates-parts/section', 'progress-slider'); ?>
<?php
get_template_part(
	'components/templates-parts/section',
	'media-publications',
	array(
		'items' => $ntronica_media_items,
	)
);
?>

<?php
get_footer();
