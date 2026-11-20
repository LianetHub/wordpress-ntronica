<?php

/**
 * Contacts: Our representative — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title     = get_field('contacts_rep_title');
$ntronica_address   = get_field('contacts_rep_address');
$ntronica_map_zoom  = get_field('contacts_rep_map_zoom');

$ntronica_title    = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : 'Our representative';
$ntronica_address  = is_string($ntronica_address) && '' !== $ntronica_address ? $ntronica_address : '8 Ulsoor Road, Yellapa Chetty Layout, Sivan Chetty Gardens, Ulsoor (Halasuru), Bengaluru, Bengaluru North, Karnataka, 560042, India';
$ntronica_map_zoom = is_numeric($ntronica_map_zoom) ? (int) $ntronica_map_zoom : 16;

$ntronica_map_src = 'https://maps.google.com/maps?q=' . rawurlencode($ntronica_address) . '&z=' . $ntronica_map_zoom . '&output=embed';
?>
<section class="contacts-representative" id="our-representative">
	<div class="container">
		<h2 class="title contacts-representative__title"><?php echo esc_html($ntronica_title); ?></h2>

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
