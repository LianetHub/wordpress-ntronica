<?php

/**
 * Contacts: Our representative
 *
 * @package ntronica
 */

$ntronica_map_address = '8 Ulsoor Road, Yellapa Chetty Layout, Sivan Chetty Gardens, Ulsoor (Halasuru), Bengaluru, Bengaluru North, Karnataka, 560042, India';
$ntronica_map_src     = 'https://maps.google.com/maps?q=' . rawurlencode($ntronica_map_address) . '&z=16&output=embed';
?>
<section class="contacts-representative" id="our-representative">
	<div class="container">
		<h2 class="title contacts-representative__title">Our representative</h2>

		<div class="contacts-representative__map">
			<iframe
				class="contacts-representative__iframe"
				src="<?php echo esc_url($ntronica_map_src); ?>"
				title="Map of N-tronica representative location"
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				allowfullscreen></iframe>
		</div>
	</div>
</section>
