<?php

/**
 * Contacts: Hero
 *
 * @package ntronica
 */

$ntronica_contacts_img = IMG_PATH . '/contacts/';
?>
<section class="section-contacts-hero band-full" aria-label="<?php echo esc_attr(ntronica_ui_text('Contacts')); ?>">
	<div class="section-contacts-hero__media" aria-hidden="true">
		<img
			class="section-contacts-hero__img"
			src="<?php echo esc_url($ntronica_contacts_img . 'hero.png'); ?>"
			alt="<?php echo esc_attr(ntronica_ui_text('Laboratory technicians working at microscopes in a sterile facility')); ?>"
			width="2560"
			height="1100">
	</div>

	<div class="container section-contacts-hero__inner">
		<div class="section-contacts-hero__top">
			<nav class="section-contacts-hero__nav" aria-label="<?php echo esc_attr(ntronica_ui_text('Contacts sections')); ?>">
				<a class="section-contacts-hero__nav-link" href="#about"><?php echo esc_html(ntronica_ui_text('Company information')); ?></a>
				<a class="section-contacts-hero__nav-link" href="#our-representative"><?php echo esc_html(ntronica_ui_text('Our representative')); ?></a>
				<a class="section-contacts-hero__nav-link" href="#contacts"><?php echo esc_html(ntronica_ui_text('Contact us')); ?></a>
			</nav>
			<a class="section-contacts-hero__lang" href="#">ru</a>
		</div>

		<p class="section-contacts-hero__tagline"><?php echo esc_html(ntronica_ui_text('We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities')); ?></p>

		<h1 class="section-contacts-hero__title"><?php echo esc_html(ntronica_ui_text('Contacts')); ?></h1>
	</div>
</section>