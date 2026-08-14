<?php
/**
 * Careers: Hero
 *
 * @package ntronica
 */

$ntronica_careers_img = IMG_PATH . '/careers/';
?>
<section class="page-hero band-full" aria-label="<?php esc_attr_e( 'Careers', 'ntronica' ); ?>">
	<div class="page-hero__media" aria-hidden="true">
		<img
			class="page-hero__img"
			src="<?php echo esc_url( $ntronica_careers_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="band-full__inner">
		<div class="content-rail__inner page-hero__inner">
			<div class="page-hero__top">
				<nav class="page-hero__nav" aria-label="<?php esc_attr_e( 'Careers sections', 'ntronica' ); ?>">
					<a class="page-hero__nav-link" href="#team"><?php esc_html_e( 'Our team', 'ntronica' ); ?></a>
					<a class="page-hero__nav-link" href="#careers"><?php esc_html_e( 'Immediate vacancies', 'ntronica' ); ?></a>
					<a class="page-hero__nav-link" href="#contacts"><?php esc_html_e( 'Contact us', 'ntronica' ); ?></a>
				</nav>
				<a class="page-hero__lang" href="#"><?php esc_html_e( 'ru', 'ntronica' ); ?></a>
			</div>

			<p class="page-hero__tagline page-hero__tagline--dark"><?php esc_html_e( 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities', 'ntronica' ); ?></p>

			<h1 class="page-hero__title"><?php esc_html_e( 'Careers', 'ntronica' ); ?></h1>
		</div>
	</div>
</section>
