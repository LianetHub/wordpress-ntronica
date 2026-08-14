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
	<aside class="site-sidebar" aria-label="Primary">
		<nav class="site-sidebar__nav" id="site-sidebar-nav">
			<ul class="site-sidebar__menu">
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'about' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/about/' ) ); ?>"
						data-title="About"
					><span>About</span></a>
				</li>
				<li><a class="site-sidebar__link" href="#" data-title="Technology"><span>Technology</span></a></li>
				<li><a class="site-sidebar__link" href="#" data-title="Products"><span>Products</span></a></li>
				<li><a class="site-sidebar__link" href="#" data-title="News"><span>News</span></a></li>
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'careers' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/careers/' ) ); ?>"
						data-title="Careers"
					><span>Careers</span></a>
				</li>
				<li>
					<a
						class="site-sidebar__link<?php echo is_page( 'contacts' ) ? ' is-active' : ''; ?>"
						href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>"
						data-title="Contacts"
					><span>Contacts</span></a>
				</li>
			</ul>
		</nav>
		<button
			class="site-sidebar__logo"
			type="button"
			aria-expanded="false"
			aria-controls="site-sidebar-nav"
		>
			<span class="screen-reader-text">Menu</span>
			<svg width="234" height="34" viewBox="0 0 234 34" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
				<path d="M0 33.2493V9.06909H15.096C20.9021 9.06909 24.156 13.0043 24.156 17.4964V33.2493H18.12V15.1111H6.03598V33.2493H0ZM35.478 15.1111V27.1952H47.55V15.1111H35.478ZM58.872 24.8219V0H64.9079V9.06909H78.4919V15.1111H64.9079V27.1952H78.4919V33.2372H67.9199C62.15 33.2372 58.8599 29.3504 58.8599 24.8098L58.872 24.8219ZM102.648 15.1111H89.0639V33.2493H83.028V17.3754C83.028 12.8105 86.6931 9.06909 92.463 9.06909H102.648V15.1111ZM116.958 8.30627C109.906 8.30627 104.16 14.0456 104.16 21.1168C104.16 28.188 109.894 34 116.958 34C124.022 34 129.828 28.2607 129.828 21.1168C129.828 13.9729 124.058 8.30627 116.958 8.30627ZM110.958 15.1111H123.03V27.1952H110.958V15.1111ZM134.352 33.2493V9.06909H149.484C155.254 9.06909 158.508 12.9558 158.508 17.4964V33.2493H152.472V15.1111H140.4V33.2493H134.364H134.352ZM181.914 9.06909H162.294V15.1111H175.878V33.2493H181.914V9.06909ZM175.878 0V6.04202H181.914V0H175.878ZM186.45 21.1168C186.45 14.6631 191.204 9.06909 198.413 9.06909H206.832V15.0748H193.248V27.2073H206.832V33.2493H198.413C191.204 33.2493 186.45 27.6189 186.45 21.1289V21.1168ZM234 9.05698V33.2493H218.904C214.114 33.2493 209.844 30.2222 209.844 25.6937C209.844 21.1652 212.263 18.4046 215.88 17.6417V27.1952H227.952V15.1111H215.88V9.06909H234V9.05698Z" fill="currentColor"/>
			</svg>
		</button>
	</aside>
	<div class="site-body">
		<main class="main<?php echo is_front_page() ? ' main--home' : ( is_page( 'about' ) ? ' main--about' : ( is_page( 'careers' ) ? ' main--careers' : ( is_page( 'contacts' ) ? ' main--contacts' : ( is_404() ? ' main--error' : '' ) ) ) ); ?>">
