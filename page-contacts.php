<?php
/**
 * Contacts page template
 *
 * @package ntronica
 */

get_header();
?>

<?php get_template_part( 'components/templates-parts/section', 'contacts-hero' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'info' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'contacts-representative' ); ?>
<?php get_template_part( 'components/templates-parts/section', 'contact' ); ?>

<?php
get_footer();
