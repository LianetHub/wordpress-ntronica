<?php

/**
 * Contacts: Our representative
 *
 * @package ntronica
 */

$ntronica_contacts_img = IMG_PATH . '/contacts/';
?>
<section class="contacts-representative" id="our-representative">
	<div class="container">
		<h2 class="section-title contacts-representative__title">Our representative</h2>

		<div class="contacts-representative__map">
			<img
				class="contacts-representative__img"
				src="<?php echo esc_url($ntronica_contacts_img . 'map.png'); ?>"
				alt="Map of N-tronica representative location"
				width="1914"
				height="650"
				loading="lazy">
		</div>
	</div>
</section>