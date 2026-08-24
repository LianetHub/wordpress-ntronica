<?php

/**
 * Front page template — static Main 2560 layout
 *
 * @package ntronica
 */

get_header();
?>

<?php get_template_part('components/templates-parts/section', 'home-overview'); ?>
<?php get_template_part('components/templates-parts/section', 'products'); ?>
<?php get_template_part('components/templates-parts/section', 'vacancies'); ?>
<?php get_template_part('components/templates-parts/section', 'news'); ?>
<?php get_template_part('components/templates-parts/section', 'info'); ?>
<?php get_template_part('components/templates-parts/section', 'contact'); ?>

<?php
get_footer();
