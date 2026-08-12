<?php
/**
 * About page template
 *
 * @package ntronica
 */

get_header();
?>

<?php get_template_part( 'components/templates-parts/section', 'about-hero' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'about-overview' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'about-goal' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'about-stats' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'about-solutions' ); ?>

<?php
get_footer();
