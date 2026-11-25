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
			if (is_front_page()) {
				$sticky_nav = get_field('sticky_nav_front_page', 'option');
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant' => 'nav',
						'nav_label' => 'Front page sections',
						'nav'     => $sticky_nav,
					)
				);
			} elseif (is_page('about')) {
				$sticky_nav = get_field('sticky_nav_about', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('about');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'About sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_page('technology') || is_page_template('page-technology.php')) {
				$sticky_nav = get_field('sticky_nav_technology', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('technology');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Technology sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_page('products')) {
				$sticky_nav = get_field('sticky_nav_products', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('products');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Products sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_page('careers')) {
				$sticky_nav = get_field('sticky_nav_careers', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('careers');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Careers sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_page('contacts')) {
				$sticky_nav = get_field('sticky_nav_contacts', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('contacts');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => 'Contacts sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_home()) {
				$ntronica_blog_id    = (int) get_option('page_for_posts');
				$ntronica_nav_title  = $ntronica_blog_id ? get_the_title($ntronica_blog_id) : 'News';
				$sticky_nav = get_field('sticky_nav_news', 'option');
				if (empty($sticky_nav)) {
					$sticky_nav = ntronica_get_page_section_nav('news');
				}
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant'   => 'nav',
						'nav_label' => $ntronica_nav_title . ' sections',
						'nav'       => $sticky_nav,
					)
				);
			} elseif (is_singular('post')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant' => 'breadcrumbs',
						'theme'   => 'light',
						'crumbs'  => ntronica_get_news_article_crumbs(),
					)
				);
			} elseif (is_singular('vacancy')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant' => 'breadcrumbs',
						'theme'   => 'light',
						'crumbs'  => ntronica_get_vacancy_crumbs(),
					)
				);
			} elseif (is_tax('product_category')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant' => 'breadcrumbs',
						'theme' => 'light',
						'crumbs' => array(
							array('label' => 'Products', 'url' => home_url('/products/')),
							array('label' => get_queried_object()->name, 'url' => ''),
						),
					)
				);
			} elseif (is_singular('product')) {
				get_template_part(
					'components/templates-parts/sticky-navbar',
					null,
					array(
						'variant' => 'breadcrumbs',
						'theme'   => 'light',
						'crumbs'  => ntronica_get_product_crumbs(),
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
