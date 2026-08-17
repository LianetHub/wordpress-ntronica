<?php

/**
 * Products page template
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
		'title'   => 'Products',
		'image'   => IMG_PATH . '/products/hero.webp',
		'tagline' => 'We develop and manufacture equipment for the critical technological operations required to produce a modern chip',
		'nav'     => ntronica_get_page_section_nav('products'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'products-thin-films'); ?>
<?php get_template_part('components/templates-parts/section', 'products-lines'); ?>

<?php
get_footer();
