<?php

/**
 * About page template
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
		'title' => 'About',
		'image' => IMG_PATH . '/about/hero.webp',
		'tagline' => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'nav'   => ntronica_get_page_section_nav('about'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'about-overview'); ?>
<?php get_template_part('components/templates-parts/section', 'about-goal'); ?>
<?php get_template_part('components/templates-parts/section', 'about-stats'); ?>
<?php get_template_part('components/templates-parts/section', 'about-solutions'); ?>

<?php
get_footer();
