<?php

/**
 * About: Hero
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section
	class="page-hero band-full"
	style="background-image: url('<?php echo esc_url($ntronica_about_img . 'hero.webp'); ?>');">
	<div class="container page-hero__inner">
		<div class="page-hero__top">
			<nav class="page-hero__nav" aria-label="<?php echo esc_attr(ntronica_ui_text('About sections')); ?>">
				<a class="page-hero__nav-link" href="#overview"><?php echo esc_html(ntronica_ui_text('Company overview')); ?></a>
				<a class="page-hero__nav-link" href="#goal"><?php echo esc_html(ntronica_ui_text('Our goal')); ?></a>
				<a class="page-hero__nav-link" href="#about-us"><?php echo esc_html(ntronica_ui_text('About us')); ?></a>
			</nav>
			<a class="page-hero__lang" href="#">ru</a>
		</div>

		<p class="page-hero__tagline"><?php echo esc_html(ntronica_ui_text('We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities')); ?></p>

		<h1 class="page-hero__title"><?php echo esc_html(ntronica_ui_text('About')); ?></h1>
	</div>
</section>