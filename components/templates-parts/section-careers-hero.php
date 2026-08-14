<?php
/**
 * Careers: Hero
 *
 * @package ntronica
 */

$ntronica_careers_img = IMG_PATH . '/careers/';
?>
<section class="page-hero band-full" aria-label="Careers">
	<div class="page-hero__media" aria-hidden="true">
		<img
			class="page-hero__img"
			src="<?php echo esc_url( $ntronica_careers_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="container page-hero__inner">
		<div class="page-hero__top">
			<nav class="page-hero__nav" aria-label="Careers sections">
				<a class="page-hero__nav-link" href="#team">Our team</a>
				<a class="page-hero__nav-link" href="#careers">Immediate vacancies</a>
				<a class="page-hero__nav-link" href="#contacts">Contact us</a>
			</nav>
			<a class="page-hero__lang" href="#">ru</a>
		</div>

		<p class="page-hero__tagline page-hero__tagline--dark">We develop innovative equipment to enable the full cycle of microelectronics production and complex r&amp;d activities</p>

		<h1 class="page-hero__title">Careers</h1>
	</div>
</section>
