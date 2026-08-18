<?php

/**
 * Products: Wet process equipment and Process control
 *
 * @package ntronica
 */

$ntronica_products_img = IMG_PATH . '/products/';
?>
<section class="products-lines">
	<div class="container">
		<div class="row products-lines__layout">
			<div class="col-12 col-md-6 products-lines__col" id="wet-process">
				<h2 class="title products-lines__title">Wet process equipment</h2>
				<div class="text-block products-lines__text">
					<p>It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research &amp; development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).</p>
				</div>
				<div class="row products-lines__cards">
					<div class="col-6">
						<article class="product-card">
							<div class="product-card__media">
								<img
									class="product-card__img"
									src="<?php echo esc_url($ntronica_products_img . 'planarization.webp'); ?>"
									alt="Planarization equipment close-up"
									width="461"
									height="307"
									loading="lazy">
							</div>
							<h3 class="product-card__title">Planarization</h3>
						</article>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-6 products-lines__col" id="process-control">
				<h2 class="title products-lines__title">Process control</h2>
				<div class="text-block products-lines__text">
					<p>It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research &amp; development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).</p>
				</div>
				<div class="row products-lines__cards">
					<div class="col-6">
						<article class="product-card">
							<div class="product-card__media">
								<img
									class="product-card__img"
									src="<?php echo esc_url($ntronica_products_img . 'metrology.webp'); ?>"
									alt="Optical sensor used in metrology"
									width="461"
									height="307"
									loading="lazy">
							</div>
							<h3 class="product-card__title">Metrology</h3>
						</article>
					</div>
					<div class="col-6">
						<article class="product-card">
							<div class="product-card__media">
								<img
									class="product-card__img"
									src="<?php echo esc_url($ntronica_products_img . 'inspection.webp'); ?>"
									alt="Inspection and analytics optical equipment"
									width="461"
									height="307"
									loading="lazy">
							</div>
							<h3 class="product-card__title">Inspection &amp; Analytics</h3>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>