<?php

/**
 * Single product: hero, quick specs, gallery, key features, process description.
 *
 * Data is loaded from ACF fields.
 *
 * @package ntronica
 */

$ntronica_product_id = get_the_ID();

$ntronica_tagline        = get_field('product_tagline');
$ntronica_intro          = get_field('product_intro');
$ntronica_quick_specs    = get_field('product_quick_specs');
$ntronica_gallery        = get_field('product_gallery');
$ntronica_key_features   = get_field('product_key_features');
$ntronica_process_text   = get_field('product_process_text');
$ntronica_process_stages = get_field('product_process_stages');
$ntronica_micrographs    = get_field('product_micrographs');

if (! is_array($ntronica_quick_specs)) {
	$ntronica_quick_specs = array();
}
if (! is_array($ntronica_gallery)) {
	$ntronica_gallery = array();
}
if (! is_array($ntronica_key_features)) {
	$ntronica_key_features = array();
}
$ntronica_key_features_chunks = array_chunk($ntronica_key_features, 3);

if (! is_string($ntronica_process_text) || '' === $ntronica_process_text) {
	$ntronica_process_text = false;
}
if (! is_array($ntronica_process_stages)) {
	$ntronica_process_stages = array();
}
if (! is_array($ntronica_micrographs)) {
	$ntronica_micrographs = array();
}

$ntronica_has_process     = $ntronica_process_text || ! empty($ntronica_process_stages);
$ntronica_has_micrographs = ! empty($ntronica_micrographs);
?>
<article class="product">
	<div class="container">
		<div class="row product__hero">
			<div class="col-12 col-md-6">
				<h1 class="product__title"><?php the_title(); ?></h1>
			</div>

			<?php if ($ntronica_tagline) : ?>
			<div class="col-12 col-md-6">
				<p class="subtitle fs-italic product__tagline"><?php echo esc_html($ntronica_tagline); ?></p>
			</div>
			<?php endif; ?>
		</div>

		<div class="row product__overview">
			<div class="col-12 col-md-6 product__summary">
				<?php if ($ntronica_intro) : ?>
				<p class="text-block product__intro"><?php echo esc_html($ntronica_intro); ?></p>
				<?php endif; ?>

				<?php if (! empty($ntronica_quick_specs)) : ?>
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

						<a class="btn-box product__contact" href="<?php echo esc_url(home_url('/contacts/')); ?>">CONTACT US</a>
					</div>
				</div>
				<?php endif; ?>
			</div>

			<?php if (! empty($ntronica_gallery)) : ?>
			<div class="col-12 col-md-6 product__media">
				<div class="swiper product-gallery">
					<div class="swiper-wrapper">
						<?php foreach ($ntronica_gallery as $ntronica_slide) : ?>
							<?php
							$ntronica_slide_id   = is_array($ntronica_slide) ? $ntronica_slide['image'] : 0;
							$ntronica_slide_url  = $ntronica_slide_id ? wp_get_attachment_image_url($ntronica_slide_id, 'large') : '';
							$ntronica_slide_alt  = is_array($ntronica_slide) ? ($ntronica_slide['caption'] ?: '') : '';
							?>
							<?php if ($ntronica_slide_url) : ?>
							<div class="swiper-slide" data-caption="<?php echo esc_attr($ntronica_slide_alt); ?>">
								<a class="product__image-link" href="<?php echo esc_url($ntronica_slide_url); ?>" data-fancybox="product-images" data-caption="<?php echo esc_attr($ntronica_slide_alt); ?>">
									<img
										class="product-gallery__img"
										src="<?php echo esc_url($ntronica_slide_url); ?>"
										alt="<?php echo esc_attr($ntronica_slide_alt); ?>"
										width="945"
										height="945">
								</a>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>

					<?php if (count($ntronica_gallery) > 1) : ?>
					<div class="product-gallery__footer">
						<p class="text-block product-gallery__caption" aria-live="polite">
							<?php
							$ntronica_first = reset($ntronica_gallery);
							echo esc_html(is_array($ntronica_first) ? ($ntronica_first['caption'] ?: '') : '');
							?>
						</p>
						<div class="slider-nav product-gallery__nav">
							<?php ntronica_slider_nav_button('prev', 'Previous view'); ?>
							<p class="text-block slider-nav__fraction" aria-live="polite"></p>
							<?php ntronica_slider_nav_button('next', 'Next view'); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<?php if (! empty($ntronica_key_features_chunks)) : ?>
		<div class="product__features">
			<p class="subtitle fs-italic product__subtitle">Key features:</p>

			<div class="row product__features-grid">
				<?php foreach ($ntronica_key_features_chunks as $ntronica_list) : ?>
					<div class="col-12 col-md-6">
						<ul class="feature-list">
							<?php foreach ($ntronica_list as $ntronica_item) : ?>
								<li><?php echo esc_html(is_array($ntronica_item) ? ($ntronica_item['text'] ?? '') : $ntronica_item); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($ntronica_has_process) : ?>
		<div class="row product__process">
			<div class="col-12 col-md-6">
				<h2 class="title product__process-title">Process description</h2>
				<?php if ($ntronica_process_text) : ?>
				<p class="text-block product__process-text"><?php echo esc_html($ntronica_process_text); ?></p>
				<?php endif; ?>
			</div>

			<?php if (! empty($ntronica_process_stages)) : ?>
			<div class="col-12 col-md-6">
				<p class="subtitle fs-italic product__subtitle">Results after 3 etching stages:</p>
				<ul class="feature-list">
					<?php foreach ($ntronica_process_stages as $ntronica_stage) : ?>
						<li><?php echo esc_html(is_array($ntronica_stage) ? ($ntronica_stage['text'] ?? '') : $ntronica_stage); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if ($ntronica_has_micrographs) : ?>
		<div class="row product__micrographs">
			<?php foreach ($ntronica_micrographs as $ntronica_shot) : ?>
				<?php
				$ntronica_shot_id  = is_array($ntronica_shot) ? $ntronica_shot['image'] : 0;
				$ntronica_shot_url = $ntronica_shot_id ? wp_get_attachment_image_url($ntronica_shot_id, 'large') : '';
				$ntronica_shot_alt = is_array($ntronica_shot) ? ($ntronica_shot['alt'] ?: '') : '';
				?>
				<?php if ($ntronica_shot_url) : ?>
				<div class="col-6 col-md-3">
					<a class="product__image-link" href="<?php echo esc_url($ntronica_shot_url); ?>" data-fancybox="product-images">
						<img
							class="product__micrograph"
							src="<?php echo esc_url($ntronica_shot_url); ?>"
							alt="<?php echo esc_attr($ntronica_shot_alt); ?>"
							width="461"
							height="306"
							loading="lazy">
					</a>
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</article>
