<?php

/**
 * Header — fixed left sidebar shell
 *
 * @package ntronica
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrapper">
		<?php get_template_part('components/templates-parts/sidebar'); ?>
		<div class="site-body">
			<?php
			if (is_page('about')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'About sections',
						'nav'       => ntronica_get_page_section_nav('about'),
					)
				);
			} elseif (is_page('products')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Products sections',
						'nav'       => ntronica_get_page_section_nav('products'),
					)
				);
			} elseif (is_page('careers')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Careers sections',
						'nav'       => ntronica_get_page_section_nav('careers'),
					)
				);
			} elseif (is_page('contacts')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Contacts sections',
						'nav'       => ntronica_get_page_section_nav('contacts'),
					)
				);
			} elseif (is_home()) {
				$ntronica_blog_id    = (int) get_option('page_for_posts');
				$ntronica_nav_title  = $ntronica_blog_id ? get_the_title($ntronica_blog_id) : 'News';

				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => $ntronica_nav_title . ' sections',
						'nav'       => ntronica_get_page_section_nav('news'),
					)
				);
			} elseif (ntronica_is_utility_page()) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'          => 'breadcrumbs',
						'show_breadcrumbs' => true,
					)
				);
			}

			$ntronica_main_mod = '';
			if (is_front_page()) {
				$ntronica_main_mod = ' main--home';
			} elseif (is_page('about')) {
				$ntronica_main_mod = ' main--about';
			} elseif (is_page('careers')) {
				$ntronica_main_mod = ' main--careers';
			} elseif (is_page('contacts')) {
				$ntronica_main_mod = ' main--contacts';
			} elseif (ntronica_is_utility_page()) {
				$ntronica_main_mod = ' main--utility';
			}
			?>
			<main class="main<?php echo esc_attr($ntronica_main_mod); ?>">