<?php
/**
 * Contacts: Our representative
 *
 * @package ntronica
 */

$ntronica_contacts_img = IMG_PATH . '/contacts/';
?>
<section class="section-contacts-representative" id="our-representative">
	<div class="container">
		<h2 class="section-title section-contacts-representative__title">Our representative</h2>

		<div class="section-contacts-representative__map">
			<img
				class="section-contacts-representative__img"
				src="<?php echo esc_url( $ntronica_contacts_img . 'map.png' ); ?>"
				alt=""
				width="1914"
				height="650"
			>
		</div>
	</div>
</section>
