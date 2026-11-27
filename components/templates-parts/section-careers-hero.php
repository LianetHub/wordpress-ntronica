<?php

/**
 * Careers: Hero
 *
 * @package ntronica
 */

$ntronica_careers_img = IMG_PATH . '/careers/';
?>
<section class="page-hero band-full" aria-label="<?php echo esc_attr(ntronica_ui_text('Careers')); ?>">
	<div class="page-hero__media" aria-hidden="true">
		<img
			class="page-hero__img"
			src="<?php echo esc_url($ntronica_careers_img . 'hero.png'); ?>"
			alt="<?php echo esc_attr(ntronica_ui_text('Engineer in a cleanroom suit operating laboratory equipment')); ?>"
			width="2560"
			height="1100">
	</div>

	<div class="container page-hero__inner">
		<div class="page-hero__top">
			<nav class="page-hero__nav" aria-label="<?php echo esc_attr(ntronica_ui_text('Careers sections')); ?>">
				<a class="page-hero__nav-link" href="#team"><?php echo esc_html(ntronica_ui_text('Our team')); ?></a>
				<a class="page-hero__nav-link" href="#careers"><?php echo esc_html(ntronica_ui_text('Immediate vacancies')); ?></a>
				<a class="page-hero__nav-link" href="#contacts"><?php echo esc_html(ntronica_ui_text('Contact us')); ?></a>
			</nav>
			<a class="page-hero__lang" href="#">ru</a>
		</div>

		<p class="page-hero__tagline page-hero__tagline--dark"><?php echo esc_html(ntronica_ui_text('We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities')); ?></p>

		<h1 class="page-hero__title"><?php echo esc_html(ntronica_ui_text('Careers')); ?></h1>
	</div>
</section>