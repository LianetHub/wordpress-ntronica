<?php
/**
 * Careers page template
 *
 * @package ntronica
 */

get_header();
?>

<?php get_template_part( 'components/templates-parts/section', 'careers-hero' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'careers-team' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'vacancies' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'contact' ); ?>

<?php
get_footer();
