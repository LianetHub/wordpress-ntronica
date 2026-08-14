<?php
/**
 * About: Hero
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="page-hero band-full" aria-label="About">
	<div class="page-hero__media" aria-hidden="true">
		<img
			class="page-hero__img"
			src="<?php echo esc_url( $ntronica_about_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="container page-hero__inner">
		<div class="page-hero__top">
			<nav class="page-hero__nav" aria-label="About sections">
				<a class="page-hero__nav-link" href="#overview">Company overview</a>
				<a class="page-hero__nav-link" href="#goal">Our goal</a>
				<a class="page-hero__nav-link is-active" href="#about-us">About us</a>
			</nav>
			<a class="page-hero__lang" href="#">ru</a>
		</div>

		<p class="page-hero__tagline">We develop innovative equipment to enable the full cycle of microelectronics production and complex r&amp;d activities</p>

		<h1 class="page-hero__title">About</h1>
	</div>
</section>
