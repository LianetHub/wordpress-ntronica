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

$ntronica_spec_columns[] = array(
    'title' => 'Plasma 300-01',
    'values' => array('Si, SiO2, SiNx', 'Up to 300 mm', 'ICP RIE', '100:1', '± 3,0 %', '1–8 μm/min', 'Automatic load lock with dual cassette handling and substrate alignment', '1800 × 2400 mm'),
);
$ntronica_spec_columns[] = array(
    'title' => 'Plasma 300-02',
    'values' => array('Si, compound semiconductors', 'Up to 300 mm', 'Deep reactive ion etching', '150:1', '± 2,5 %', 'Up to 12 μm/min', 'Cassette-to-cassette with optional SMIF interface', '2100 × 2600 mm'),
);
?>
<section class="product-specs">
	<div class="container">
		<h2 class="title product-specs__title">Machine Characteristics</h2>

		<div class="row product-specs__layout">
			<div class="col-5 col-md-4 col-xxl-3 product-specs__labels">
				<p class="product-specs__col-title"><span>Parameter</span></p>

				<?php foreach ($ntronica_spec_rows as $ntronica_row) : ?>
					<p class="text-block product-specs__cell product-specs__label<?php echo $ntronica_row['tall'] ? ' product-specs__cell--tall' : ''; ?>">
						<span><?php echo esc_html($ntronica_row['label']); ?></span>
					</p>
				<?php endforeach; ?>
			</div>

			<div class="col-7 col-md-8 col-xxl-9 product-specs__columns">
				<div class="swiper product-specs__slider">
					<div class="swiper-wrapper">
						<?php foreach ($ntronica_spec_columns as $ntronica_index => $ntronica_column) : ?>
							<div class="swiper-slide product-specs__column">
								<p class="product-specs__col-title"><span><?php echo esc_html($ntronica_column['title']); ?></span></p>

								<?php foreach ($ntronica_column['values'] as $ntronica_row_index => $ntronica_value) : ?>
									<?php $ntronica_tall = ! empty($ntronica_spec_rows[$ntronica_row_index]['tall']); ?>
									<p class="text-block product-specs__cell product-specs__value<?php echo $ntronica_tall ? ' product-specs__cell--tall' : ''; ?>">
										<span><?php echo esc_html($ntronica_value); ?></span>
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
