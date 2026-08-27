<?php

/**
 * Section: Media publications
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type array $items Cards: array{ date: string, title: string, excerpt: string, url?: string }.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_media = wp_parse_args(
	$args,
	array(
		'items' => array(),
	)
);

$ntronica_items = is_array($ntronica_media['items']) ? $ntronica_media['items'] : array();
?>
<section class="media-publications band-full" id="media">
	<div class="container">
		<h2 class="title media-publications__title">
			Media publications
		</h2>

		<?php if ($ntronica_items) : ?>
			<div class="swiper media-publications-slider">
				<div class="swiper-wrapper">
					<?php foreach ($ntronica_items as $ntronica_item) : ?>
						<?php
						$ntronica_url = isset($ntronica_item['url']) ? $ntronica_item['url'] : '#';
						?>
						<div class="swiper-slide">
							<article class="media-card">
								<a class="media-card__link" href="<?php echo esc_url($ntronica_url); ?>">
									<p class="media-card__date"><?php echo esc_html($ntronica_item['date']); ?></p>
									<h3 class="media-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
									<p class="media-card__excerpt text-lead"><?php echo esc_html($ntronica_item['excerpt']); ?></p>
								</a>
							</article>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="slider-nav media-publications__nav">
					<button
						type="button"
						class="swiper-button-prev"
						aria-label="Previous media publications"></button>
					<p class="text-block slider-nav__fraction" aria-live="polite"></p>
					<button
						type="button"
						class="swiper-button-next"
						aria-label="Next media publications"></button>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>