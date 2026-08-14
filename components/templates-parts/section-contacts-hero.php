<?php
/**
 * Contacts: Hero
 *
 * @package ntronica
 */

$ntronica_contacts_img = IMG_PATH . '/contacts/';
?>
<section class="section-contacts-hero band-full" aria-label="Contacts">
	<div class="section-contacts-hero__media" aria-hidden="true">
		<img
			class="section-contacts-hero__img"
			src="<?php echo esc_url( $ntronica_contacts_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="container section-contacts-hero__inner">
		<div class="section-contacts-hero__top">
			<nav class="section-contacts-hero__nav" aria-label="Contacts sections">
				<a class="section-contacts-hero__nav-link" href="#about">Company information</a>
				<a class="section-contacts-hero__nav-link" href="#our-representative">Our representative</a>
				<a class="section-contacts-hero__nav-link" href="#contacts">Contact us</a>
			</nav>
			<a class="section-contacts-hero__lang" href="#">ru</a>
		</div>

		<p class="section-contacts-hero__tagline">We develop innovative equipment to enable the full cycle of microelectronics production and complex r&amp;d activities</p>

		<h1 class="section-contacts-hero__title">Contacts</h1>
	</div>
</section>
