<?php

/**
 * Front page template — powered by ACF
 *
 * @package ntronica
 */

get_header();

$ntronica_hero_tagline = get_field('hero_tagline');
$ntronica_hero_image   = get_field('hero_image');

$ntronica_fp_hero_args = array(
    'title'   => '',
    'tagline' => is_string($ntronica_hero_tagline) ? $ntronica_hero_tagline : '',
    'image'   => is_string($ntronica_hero_image) && '' !== $ntronica_hero_image
        ? $ntronica_hero_image
        : IMG_PATH . '/home/hero.webp',
    'nav'     => ntronica_get_page_section_nav('front_page'),
);
?>
<?php
get_template_part(
    'components/templates-parts/section',
    'page-hero',
    $ntronica_fp_hero_args
);
?>
<?php get_template_part('components/templates-parts/section', 'home-overview'); ?>
<?php get_template_part('components/templates-parts/section', 'products'); ?>
<?php get_template_part('components/templates-parts/section', 'progress-slider'); ?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
