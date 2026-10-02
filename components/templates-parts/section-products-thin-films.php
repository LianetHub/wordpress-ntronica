<?php

/**
 * Products: Thin films equipment
 *
 * @package ntronica
 */

$ntronica_products_img = IMG_PATH . '/products/';

$ntronica_thin_films = array(
	array(
		'title' => 'Epitaxy',
		'file'  => 'epitaxy.webp',
		'alt'   => 'Wafer handling assembly for epitaxy tools',
	),
	array(
		'title' => 'Deposition',
		'file'  => 'deposition.webp',
		'alt'   => 'Deposition tool components in a process chamber',
	),
	array(
		'title' => 'Etching',
		'file'  => 'etching.webp',
		'alt'   => 'Blue process chemistry during etching',
	),
	array(
		'title' => 'Thermal processing',
		'file'  => 'thermal.webp',
		'alt'   => 'Wafers in a thermal processing tool',
	),
);
?>
<section class="products-thin-films" id="thin-films">
	<div class="container">
		<h2 class="title products-thin-films__title">Thin films equipment</h2>

		<div class="row products-thin-films__intro">
			<div class="col-12 col-md-6">
				<div class="text-block products-thin-films__text">
					<p>Thin film equipment creates, modifies, or removes ultra-thin material layers essential to semiconductor device performance, enabling precise control of thickness, composition, and uniformity across wafers.</p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="text-block-alternate products-thin-films__text">
					<p>We supply machines compatible with a range of technologies, such as ICP RIE (Inductively Coupled Plasma Reactive Ion Etching), DRIE (Deep Reactive Ion Etching), and GaN MOCVD (Gallium Nitride Metal-Organic Chemical Vapor Deposition). </p>
				</div>
			</div>
		</div>

		<div class="row products-thin-films__grid">
			<?php foreach ($ntronica_thin_films as $ntronica_item) : ?>
				<div class="col-6 col-md-3">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'     => $ntronica_item['title'],
							'image'     => $ntronica_products_img . $ntronica_item['file'],
							'image_alt' => $ntronica_item['alt'],
							'width'     => 461,
							'height'    => 307,
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>