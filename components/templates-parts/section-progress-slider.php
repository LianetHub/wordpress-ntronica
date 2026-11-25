<?php

/**
 * Section: Technological Processes (Progress Slider) — powered by ACF
 *
 * @package ntronica
 */

$ntronica_slider_title = get_field('slider_title');
$ntronica_slider_items = get_field('slider_items');

$ntronica_slider_title = is_string($ntronica_slider_title) ? $ntronica_slider_title : '';

$ntronica_slider_items = is_array($ntronica_slider_items) ? $ntronica_slider_items : array();

$ntronica_default_image = IMG_PATH . '/progress-slider/process-epitaxy.webp';
$ntronica_bg_image      = $ntronica_default_image;

if (! empty($ntronica_slider_items)) {
    $ntronica_first_image = isset($ntronica_slider_items[0]['image'])
        ? (string) $ntronica_slider_items[0]['image']
        : '';
    if ('' !== $ntronica_first_image) {
        $ntronica_bg_image = $ntronica_first_image;
    }
}
?>
<section class="progress-slider" id="processes" style="background-image: url('<?php echo esc_url($ntronica_bg_image); ?>');">
	<div class="container">
		<h2 class="title-md progress-slider__header"><?php echo esc_html($ntronica_slider_title); ?></h2>

		<div class="swiper progress-slider__slider">
			<div class="swiper-wrapper">
				<?php foreach ($ntronica_slider_items as $ntronica_item) : ?>
					<?php
					$ntronica_item_title = isset($ntronica_item['title']) ? (string) $ntronica_item['title'] : '';
					$ntronica_item_image = isset($ntronica_item['image']) ? (string) $ntronica_item['image'] : $ntronica_default_image;
					$ntronica_item_text1 = isset($ntronica_item['text_1']) ? (string) $ntronica_item['text_1'] : '';
					$ntronica_item_text2 = isset($ntronica_item['text_2']) ? (string) $ntronica_item['text_2'] : '';

					if ('' === $ntronica_item_title) {
						continue;
					}
					?>
					<div class="swiper-slide progress-slider__slide" data-background="<?php echo esc_url($ntronica_item_image); ?>">
						<div class="progress-slider__body">
							<h3 class="subtitle progress-slider__process-title">
								<?php echo esc_html($ntronica_item_title); ?>
							</h3>

							<div class="row progress-slider__text-row">
								<?php if ('' !== $ntronica_item_text1) : ?>
								<div class="col-12 col-md-6">
									<p class="text-block"><?php echo esc_html($ntronica_item_text1); ?></p>
								</div>
								<?php endif; ?>
								<?php if ('' !== $ntronica_item_text2) : ?>
								<div class="col-12 col-md-6">
									<p class="text-block"><?php echo esc_html($ntronica_item_text2); ?></p>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="progress-slider__footer row">
			<div class="col-1 progress-slider__prev">
				<?php ntronica_slider_nav_button('prev', 'Previous process'); ?>
			</div>
			<div class="col-1">
				<div class="progress-slider__index"></div>
			</div>
			<div class="col-1 progress-slider__next">
				<?php ntronica_slider_nav_button('next', 'Next process'); ?>
			</div>
		</div>
	</div>
</section>
