<?php
/**
 * Section: Products
 *
 * @package ntronica
 */

$ntronica_img = IMG_PATH . '/home/';

$products = array(
	array(
		'title' => __( 'Thin films equipment', 'ntronica' ),
		'img'   => $ntronica_img . 'product-thin-films.jpg',
	),
	array(
		'title' => __( 'Wet process equipment', 'ntronica' ),
		'img'   => $ntronica_img . 'product-wet-process.jpg',
	),
	array(
		'title' => __( 'Process control', 'ntronica' ),
		'img'   => $ntronica_img . 'product-process-control.jpg',
	),
);
?>
<section class="section-products content-rail" id="products">
	<div class="content-rail__inner">
		<h2 class="section-title section-products__title"><?php esc_html_e( 'Products', 'ntronica' ); ?></h2>
		<p class="section-lead section-products__lead">
			<?php esc_html_e( 'We design and manufacture semiconductor manufacturing tools suitable for both R&D labs and mass production at various scales. Our equipment is available in stand-alone and cluster configurations.', 'ntronica' ); ?>
		</p>

		<div class="row section-products__grid">
			<?php foreach ( $products as $product ) : ?>
				<div class="col-12 col-md-4">
					<article class="product-card">
						<div class="product-card__media">
							<img
								class="product-card__img"
								src="<?php echo esc_url( $product['img'] ); ?>"
								alt="<?php echo esc_attr( $product['title'] ); ?>"
								width="622"
								height="414"
								loading="lazy"
							>
						</div>
						<h3 class="product-card__title"><?php echo esc_html( $product['title'] ); ?></h3>
					</article>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="section-products__more">
			<a class="link-more" href="#">
				<span><?php esc_html_e( 'LEARN MORE', 'ntronica' ); ?></span>
				<span class="link-more__arrow" aria-hidden="true">→</span>
			</a>
		</div>
	</div>
</section>
