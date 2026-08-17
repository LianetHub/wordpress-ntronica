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
		'nav'     => array(
			array(
				'href'  => '#thin-films',
				'label' => 'Thin films equipment',
			),
			array(
				'href'  => '#wet-process',
				'label' => 'Wet process equipment',
			),
			array(
				'href'  => '#process-control',
				'label' => 'Process control',
			),
		),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'products-thin-films'); ?>
<?php get_template_part('components/templates-parts/section', 'products-lines'); ?>

<?php
get_footer();
