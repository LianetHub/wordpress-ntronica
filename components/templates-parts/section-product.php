<?php

/**
 * Single product: hero, quick specs, gallery, key features, process description.
 *
 * Mock copy lives in the template. It is not loaded from fields.
 *
 * @package ntronica
 */

$ntronica_product_img = IMG_PATH . '/products/plasma-200-01/';

$ntronica_tagline = 'Equipment for 3d inspection of wires after soldering on the semiconductor crystal before';

$ntronica_intro = 'Our system is designed for plasma-chemical anisotropic selective etching of the wide range of materials (a-Si, SiOx, SiNx, Al, polymer).';

$ntronica_quick_specs = array(
	array(
		'label' => 'Photoresist',
		'value' => 'Si, SiO2',
	),
	array(
		'label' => 'Wafer diameter',
		'value' => 'Up to 200 mm',
	),
	array(
		'label' => 'Technology',
		'value' => 'ICP RIE',
	),
);

$ntronica_gallery = array(
	array(
		'file' => 'front-view.webp',
		'alt'  => 'Plasma 200-01 etching tool, front view with the process chamber open',
	),
	array(
		'file' => 'front-view.webp',
		'alt'  => 'Plasma 200-01 cabinet with the signal tower and operator controls',
	),
	array(
		'file' => 'front-view.webp',
		'alt'  => 'Plasma 200-01 wafer loading shelf next to the process chamber',
	),
);

$ntronica_key_features = array(
	array(
		'Real-time monitoring of high-frequency bias on the electrode/substrate holder',
		'Aspect ratio ≥ 1:10',
		'Etch non-uniformity ≤ ±5% for Ø200 mm wafers',
	),
	array(
		'Detecting electrical shorts between wires',
		'Generating 3D map of soldered wires',
		'Automatic regulation and maintenance of power from 300 to 1000 W',
	),
);

$ntronica_process_text = 'The system is designed for the etching of semiconductor materials and dielectrics, including the formation of smooth trenches for shallow trench isolation (STI) The silicon etching process with smooth sidewalls is achieved by introducing both an etching gas and a polymer-forming gas into the process chamber. This results in simultaneous silicon etching and polymer deposition on the wafer surface. Due to the bias applied to the substrate, etching proceeds preferentially in the vertical direction, enabling anisotropic profile control';

$ntronica_process_stages = array(
	'Break Through (BT) – time-controlled oxide breakthrough in CF4 plasma',
	'Main Etch (ME) – time controlled silicon gate etch in Cl2/HBr/O2/SF6 plasma',
	'Over Etch (OE) – time-controlled polysilicon etch in highly selective Cl2/HBr/O2',
);

$ntronica_micrographs = array(
	array(
		'file' => 'etch-stage-1.webp',
		'alt'  => 'Cross-section micrograph of an etched silicon trench after break through',
	),
	array(
		'file' => 'etch-stage-2.webp',
		'alt'  => 'Cross-section micrograph of a silicon gate profile after main etch',
	),
	array(
		'file' => 'etch-stage-3.webp',
		'alt'  => 'Cross-section micrograph of a polysilicon step after over etch',
	),
	array(
		'file' => 'etch-stage-4.webp',
		'alt'  => 'Cross-section micrograph of a smooth trench sidewall profile',
	),
);
?>
<article class="product">
	<div class="container">
		<div class="row product__hero">
			<div class="col-12 col-md-6">
				<h1 class="product__title"><?php the_title(); ?></h1>
			</div>

			<div class="col-12 col-md-6">
				<p class="subtitle fs-italic product__tagline"><?php echo esc_html($ntronica_tagline); ?></p>
			</div>
		</div>

		<div class="row product__overview">
			<div class="col-12 col-md-6 product__summary">
				<p class="text-block product__intro"><?php echo esc_html($ntronica_intro); ?></p>

				<div class="row product__summary-footer">
					<div class="col-12 col-md-8">
						<dl class="product__specs">
							<?php foreach ($ntronica_quick_specs as $ntronica_spec) : ?>
								<div class="product__spec">
									<dt class="text-block product__spec-label"><?php echo esc_html($ntronica_spec['label']); ?></dt>
									<dd class="text-block product__spec-value"><?php echo esc_html($ntronica_spec['value']); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<a class="btn-box product__contact" href="#contacts">CONTACT US</a>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-6 product__media">
				<div class="swiper product-gallery">
					<div class="swiper-wrapper">
						<?php foreach ($ntronica_gallery as $ntronica_slide) : ?>
							<div class="swiper-slide">
								<img
									class="product-gallery__img"
									src="<?php echo esc_url($ntronica_product_img . $ntronica_slide['file']); ?>"
									alt="<?php echo esc_attr($ntronica_slide['alt']); ?>"
									width="945"
									height="945">
							</div>
						<?php endforeach; ?>
					</div>

					<div class="product-gallery__footer">
						<p class="text-block product-gallery__caption">Front view</p>
						<div class="slider-nav product-gallery__nav">
							<?php ntronica_slider_nav_button('prev', 'Previous view'); ?>
							<p class="text-block slider-nav__fraction" aria-live="polite"></p>
							<?php ntronica_slider_nav_button('next', 'Next view'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="product__features">
			<p class="subtitle fs-italic product__subtitle">Key features:</p>

			<div class="row product__features-grid">
				<?php foreach ($ntronica_key_features as $ntronica_list) : ?>
					<div class="col-12 col-md-6">
						<ul class="feature-list">
							<?php foreach ($ntronica_list as $ntronica_item) : ?>
								<li><?php echo esc_html($ntronica_item); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="row product__process">
			<div class="col-12 col-md-6">
				<h2 class="title product__process-title">Process description</h2>
				<p class="text-block product__process-text"><?php echo esc_html($ntronica_process_text); ?></p>
			</div>

			<div class="col-12 col-md-6">
				<p class="subtitle fs-italic product__subtitle">Results after 3 etching stages:</p>
				<ul class="feature-list">
					<?php foreach ($ntronica_process_stages as $ntronica_stage) : ?>
						<li><?php echo esc_html($ntronica_stage); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="row product__micrographs">
			<?php foreach ($ntronica_micrographs as $ntronica_shot) : ?>
				<div class="col-6 col-md-3">
					<img
						class="product__micrograph"
						src="<?php echo esc_url($ntronica_product_img . $ntronica_shot['file']); ?>"
						alt="<?php echo esc_attr($ntronica_shot['alt']); ?>"
						width="461"
						height="306"
						loading="lazy">
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</article>
