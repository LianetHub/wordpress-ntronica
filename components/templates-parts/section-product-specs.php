<?php

/**
 * Single product: Machine Characteristics.
 *
 * The "Parameter" column stays put; the product columns are Swiper slides.
 * Mock copy lives in the template. It is not loaded from fields.
 *
 * @package ntronica
 */

$ntronica_spec_rows = array(
	array(
		'label' => 'Photoresist',
		'tall'  => false,
	),
	array(
		'label' => 'Wafer diameter',
		'tall'  => false,
	),
	array(
		'label' => 'Technology',
		'tall'  => false,
	),
	array(
		'label' => 'Selectivity',
		'tall'  => false,
	),
	array(
		'label' => 'Uniformity',
		'tall'  => false,
	),
	array(
		'label' => 'Etch rate',
		'tall'  => false,
	),
	array(
		'label' => 'Loading system',
		'tall'  => true,
	),
	array(
		'label' => 'Footprint',
		'tall'  => false,
	),
);

$ntronica_spec_columns = array(
	array(
		'title'  => 'Plasma 200-01',
		'values' => array(
			'Si, SiO2',
			'Up to 200 mm',
			'ICP RIE',
			'X',
			'± 5,0 %',
			'0,1-1 μm/min',
			'Load lock / cassette-to-cassette / SMIF',
			'Footprint',
		),
	),
	array(
		'title'  => 'Plasma 200-02',
		'values' => array(
			'Material',
			'Up to 200 mm',
			'DRIE (Bosch process)',
			'Z',
			'± 3,5 %',
			'5 μm/min',
			'Load lock / cassette-to-cassette / SMIF',
			'Footprint',
		),
	),
	array(
		'title'  => 'Plasma 200-03',
		'values' => array(
			'a-Si, SiOx, SiNx, Al, polymer',
			'Up to 200 mm',
			'STRIP',
			'Y',
			'-',
			'3 μm/min',
			'Load lock / cassette-to-cassette / SMIF',
			'Footprint',
		),
	),
);
?>
<section class="product-specs">
	<div class="container">
		<h2 class="title product-specs__title">Machine Characteristics</h2>

		<div class="row product-specs__layout">
			<div class="col-5 col-md-4 col-xxl-3 product-specs__labels">
				<p class="product-specs__col-title">Parameter</p>

				<?php foreach ($ntronica_spec_rows as $ntronica_row) : ?>
					<p class="text-block product-specs__cell product-specs__label<?php echo $ntronica_row['tall'] ? ' product-specs__cell--tall' : ''; ?>">
						<?php echo esc_html($ntronica_row['label']); ?>
					</p>
				<?php endforeach; ?>
			</div>

			<div class="col-7 col-md-8 col-xxl-9 product-specs__columns">
				<div class="swiper product-specs__slider">
					<div class="swiper-wrapper">
						<?php foreach ($ntronica_spec_columns as $ntronica_index => $ntronica_column) : ?>
							<?php $ntronica_value_mod = 0 === $ntronica_index ? ' product-specs__value--current' : ''; ?>
							<div class="swiper-slide product-specs__column">
								<p class="product-specs__col-title"><?php echo esc_html($ntronica_column['title']); ?></p>

								<?php foreach ($ntronica_column['values'] as $ntronica_row_index => $ntronica_value) : ?>
									<?php $ntronica_tall = ! empty($ntronica_spec_rows[$ntronica_row_index]['tall']); ?>
									<p class="text-block product-specs__cell product-specs__value<?php echo esc_attr($ntronica_value_mod); ?><?php echo $ntronica_tall ? ' product-specs__cell--tall' : ''; ?>">
										<?php echo esc_html($ntronica_value); ?>
									</p>
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="product-specs__nav">
						<?php ntronica_slider_nav_button('prev', 'Previous machine'); ?>
						<?php ntronica_slider_nav_button('next', 'Next machine'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>