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
				<div class="text-lead products-thin-films__text products-thin-films__text--primary">
					<p>It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research &amp; development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).</p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="products-thin-films__text products-thin-films__text--secondary">
					<p>We supply machines compatible with a range of technologies, such as ICP RIE (Inductively Coupled Plasma Reactive Ion Etching), DRIE (Deep Reactive Ion Etching), and GaN MOCVD (Gallium Nitride Metal-Organic Chemical Vapor Deposition). We offer tools for complex CMP processes across various materials and applications in STI (Shallow Trench Isolation), ILD (Interlayer Dielectric), PMD (Pre-Metal Dielectric), etc.</p>
					<p>In addition, we are developing metrology and inspection tools, and hope to bring them to the market fast. Learn more about our developments in the Technologies section.</p>
				</div>
			</div>
		</div>

		<div class="row products-thin-films__grid">
			<?php foreach ($ntronica_thin_films as $ntronica_item) : ?>
				<div class="col-6 col-md-3">
					<article class="product-card">
						<div class="product-card__media">
							<img
								class="product-card__img"
								src="<?php echo esc_url($ntronica_products_img . $ntronica_item['file']); ?>"
								alt="<?php echo esc_attr($ntronica_item['alt']); ?>"
								width="461"
								height="307"
								loading="lazy">
						</div>
						<h3 class="product-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>