<?php
/**
 * Header — fixed left sidebar shell
 *
 * @package ntronica
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="wrapper">
	<aside class="site-sidebar" aria-label="<?php esc_attr_e( 'Primary', 'ntronica' ); ?>">
		<nav class="site-sidebar__nav">
			<ul class="site-sidebar__menu">
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'about' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/about/' ) ); ?>"
					><?php esc_html_e( 'About', 'ntronica' ); ?></a>
				</li>
				<li><a class="site-sidebar__link" href="#"><?php esc_html_e( 'Technology', 'ntronica' ); ?></a></li>
				<li><a class="site-sidebar__link" href="#"><?php esc_html_e( 'Products', 'ntronica' ); ?></a></li>
				<li><a class="site-sidebar__link" href="#"><?php esc_html_e( 'News', 'ntronica' ); ?></a></li>
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'careers' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/careers/' ) ); ?>"
					><?php esc_html_e( 'Careers', 'ntronica' ); ?></a>
				</li>
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'contacts' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"
					><?php esc_html_e( 'Contacts', 'ntronica' ); ?></a>
				</li>
			</ul>
		</nav>
		<a class="site-sidebar__logo site-sidebar__logo--mark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img
				src="<?php echo esc_url( IMG_PATH . '/home/logo-mark.svg' ); ?>"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
				width="40"
				height="20"
			>
		</a>
		<a class="site-sidebar__logo site-sidebar__logo--full" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<img
				src="<?php echo esc_url( IMG_PATH . '/home/logo-ntronica.svg' ); ?>"
				alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
				width="234"
				height="34"
			>
		</a>
	</aside>
	<div class="site-body">
		<main class="main<?php echo is_front_page() ? ' main--home' : ( is_page( 'about' ) ? ' main--about' : ( is_page( 'careers' ) ? ' main--careers' : ( is_page( 'contacts' ) ? ' main--contacts' : ( is_404() ? ' main--error' : '' ) ) ) ); ?>">
