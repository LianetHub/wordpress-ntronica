<?php

/**
 * Section: Products
 *
 * @package ntronica
 */

$ntronica_img = IMG_PATH . '/home/';

$ntronica_products = array(
	array(
		'title' => 'Thin films equipment',
		'image' => $ntronica_img . 'product-thin-films.jpg',
	),
	array(
		'title' => 'Wet process equipment',
		'image' => $ntronica_img . 'product-wet-process.jpg',
	),
	array(
		'title' => 'Process control',
		'image' => $ntronica_img . 'product-process-control.jpg',
	),
);
?>
<section class="products" id="products">
	<div class="container">
		<h2 class="title products__title">Products</h2>
		<p class="text-block products__lead">
			We design and manufacture semiconductor manufacturing tools suitable for both R&amp;D labs and mass production at various scales. Our equipment is available in stand-alone and cluster configurations.
		</p>

		<div class="row products__grid">
			<?php foreach ($ntronica_products as $ntronica_item) : ?>
				<div class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title' => $ntronica_item['title'],
							'image' => $ntronica_item['image'],
							'width' => 622,
							'height' => 414,
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="products__more">
			<a class="link-more" href="#" data-title="LEARN MORE">
				<span>LEARN MORE</span>
			</a>
		</div>
	</div>
</section>