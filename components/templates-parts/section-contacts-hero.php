<?php
/**
 * Contacts: Hero
 *
 * @package ntronica
 */

$ntronica_contacts_img = IMG_PATH . '/contacts/';
?>
<section class="section-contacts-hero band-full" aria-label="<?php esc_attr_e( 'Contacts', 'ntronica' ); ?>">
	<div class="section-contacts-hero__media" aria-hidden="true">
		<img
			class="section-contacts-hero__img"
			src="<?php echo esc_url( $ntronica_contacts_img . 'hero.png' ); ?>"
			alt=""
			width="2560"
			height="1100"
		>
	</div>

	<div class="band-full__inner">
		<div class="content-rail__inner section-contacts-hero__inner">
			<div class="section-contacts-hero__top">
				<nav class="section-contacts-hero__nav" aria-label="<?php esc_attr_e( 'Contacts sections', 'ntronica' ); ?>">
					<a class="section-contacts-hero__nav-link" href="#about"><?php esc_html_e( 'Company information', 'ntronica' ); ?></a>
					<a class="section-contacts-hero__nav-link" href="#our-representative"><?php esc_html_e( 'Our representative', 'ntronica' ); ?></a>
					<a class="section-contacts-hero__nav-link" href="#contacts"><?php esc_html_e( 'Contact us', 'ntronica' ); ?></a>
				</nav>
				<a class="section-contacts-hero__lang" href="#"><?php esc_html_e( 'ru', 'ntronica' ); ?></a>
			</div>

			<p class="section-contacts-hero__tagline"><?php esc_html_e( 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities', 'ntronica' ); ?></p>

			<h1 class="section-contacts-hero__title"><?php esc_html_e( 'Contacts', 'ntronica' ); ?></h1>
		</div>
	</div>
</section>
