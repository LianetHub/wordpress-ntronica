<?php

/**
 * Section: Products
 *
 * @package ntronica
 */

$ntronica_img = IMG_PATH . '/home/';

$products = array(
	array(
		'title' => 'Thin films equipment',
		'img'   => $ntronica_img . 'product-thin-films.jpg',
	),
	array(
		'title' => 'Wet process equipment',
		'img'   => $ntronica_img . 'product-wet-process.jpg',
	),
	array(
		'title' => 'Process control',
		'img'   => $ntronica_img . 'product-process-control.jpg',
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
			<?php foreach ($products as $product) : ?>
				<div class="col-12 col-md-4">
					<article class="product-card">
						<div class="product-card__media">
							<img
								class="product-card__img"
								src="<?php echo esc_url($product['img']); ?>"
								alt="<?php echo esc_attr($product['title']); ?>"
								width="622"
								height="414"
								loading="lazy">
						</div>
						<h3 class="product-card__title"><?php echo esc_html($product['title']); ?></h3>
					</article>
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