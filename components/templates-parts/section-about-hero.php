<?php
/**
 * About: Hero
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="page-hero band-full" aria-label="<?php esc_attr_e( 'About', 'ntronica' ); ?>">
	<div class="page-hero__media" aria-hidden="true">
		<img
			class="page-hero__img"
			src="<?php echo esc_url( $ntronica_about_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="band-full__inner">
		<div class="content-rail__inner page-hero__inner">
			<div class="page-hero__top">
				<nav class="page-hero__nav" aria-label="<?php esc_attr_e( 'About sections', 'ntronica' ); ?>">
					<a class="page-hero__nav-link" href="#overview"><?php esc_html_e( 'Company overview', 'ntronica' ); ?></a>
					<a class="page-hero__nav-link" href="#goal"><?php esc_html_e( 'Our goal', 'ntronica' ); ?></a>
					<a class="page-hero__nav-link is-active" href="#about-us"><?php esc_html_e( 'About us', 'ntronica' ); ?></a>
				</nav>
				<a class="page-hero__lang" href="#"><?php esc_html_e( 'ru', 'ntronica' ); ?></a>
			</div>

			<p class="page-hero__tagline"><?php esc_html_e( 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities', 'ntronica' ); ?></p>

			<h1 class="page-hero__title"><?php esc_html_e( 'About', 'ntronica' ); ?></h1>
		</div>
	</div>
</section>
