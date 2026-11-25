<?php

/**
 * Single product: Machine Characteristics.
 *
 * The "Parameter" column stays put; the product columns are Swiper slides.
 * Data is loaded from ACF fields.
 *
 * @package ntronica
 */

$ntronica_product_id = get_the_ID();
$ntronica_spec_rows  = get_field('product_spec_rows');
if (! is_array($ntronica_spec_rows)) {
	$ntronica_spec_rows = array();
}

$ntronica_spec_columns = array();

$ntronica_product_title  = get_the_title();
$ntronica_product_values = array();
foreach ($ntronica_spec_rows as $ntronica_row) {
	$ntronica_product_values[] = isset($ntronica_row['value']) ? $ntronica_row['value'] : '';
}
$ntronica_spec_columns[] = array(
	'title'  => $ntronica_product_title,
	'values' => $ntronica_product_values,
);

$ntronica_terms = wp_get_object_terms($ntronica_product_id, 'product_category', array('orderby' => 'term_id'));
if (! is_wp_error($ntronica_terms) && ! empty($ntronica_terms)) {
	$ntronica_sibling_query = new WP_Query(
		array(
			'post_type'      => 'product',
			'posts_per_page' => 5,
			'post__not_in'   => array($ntronica_product_id),
			'orderby'        => 'title',
			'order'          => 'ASC',
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_category',
					'field'    => 'term_id',
					'terms'    => $ntronica_terms[0]->term_id,
				),
			),
		)
	);

	if ($ntronica_sibling_query->have_posts()) {
		while ($ntronica_sibling_query->have_posts()) {
			$ntronica_sibling_query->the_post();
			$ntronica_sibling_id   = get_the_ID();
			$ntronica_sibling_rows = get_field('product_spec_rows', $ntronica_sibling_id);

			if (is_array($ntronica_sibling_rows)) {
				$ntronica_sibling_values = array();
				foreach ($ntronica_sibling_rows as $ntronica_sibling_row) {
					$ntronica_sibling_values[] = isset($ntronica_sibling_row['value']) ? $ntronica_sibling_row['value'] : '';
				}
				$ntronica_spec_columns[] = array(
					'title'  => get_the_title(),
					'values' => $ntronica_sibling_values,
				);
			}
		}
		wp_reset_postdata();
	}
}
?>
<?php if (! empty($ntronica_spec_rows)) : ?>
<section class="product-specs">
	<div class="container">
		<h2 class="title product-specs__title">Machine Characteristics</h2>

		<div class="row product-specs__layout">
			<div class="col-5 col-md-4 col-xxl-3 product-specs__labels">
				<p class="product-specs__col-title"><span>Parameter</span></p>

				<?php foreach ($ntronica_spec_rows as $ntronica_row) : ?>
					<p class="text-block product-specs__cell product-specs__label<?php echo ! empty($ntronica_row['tall']) ? ' product-specs__cell--tall' : ''; ?>">
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
<?php endif; ?>
