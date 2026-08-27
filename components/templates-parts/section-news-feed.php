<?php

/**
 * News cards listing with Swiper grid (Events & news / Press releases)
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $id         Section id.
 *     @type string $title      Heading.
 *     @type string $lead       Intro text.
 *     @type string $modifier   Optional BEM modifier (e.g. press).
 *     @type array  $items      Cards: array{ date: string, title: string, url?: string }.
 *     @type string $nav_prefix Aria-label prefix for slider buttons.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_feed = wp_parse_args(
	$args,
	array(
		'id'         => '',
		'title'      => '',
		'lead'       => '',
		'modifier'   => '',
		'items'      => array(),
		'nav_prefix' => '',
	)
);

$ntronica_class = 'news-feed';
if ('' !== $ntronica_feed['modifier']) {
	$ntronica_class .= ' news-feed--' . sanitize_html_class($ntronica_feed['modifier']);
}

$ntronica_nav_prefix = $ntronica_feed['nav_prefix'];
if ('' === $ntronica_nav_prefix) {
	$ntronica_nav_prefix = $ntronica_feed['title'];
}

$ntronica_items = is_array($ntronica_feed['items']) ? $ntronica_feed['items'] : array();
?>
<section class="<?php echo esc_attr($ntronica_class); ?>" id="<?php echo esc_attr($ntronica_feed['id']); ?>">
	<div class="container">
		<h2 class="title news-feed__title"><?php echo esc_html($ntronica_feed['title']); ?></h2>
		<?php if ('' !== $ntronica_feed['lead']) : ?>
			<div class="row">
				<div class="col-12 col-md-6">
					<p class="text-block news-feed__lead"><?php echo esc_html($ntronica_feed['lead']); ?></p>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($ntronica_items) : ?>
			<div class="swiper news-feed-slider">
				<div class="swiper-wrapper">
					<?php foreach ($ntronica_items as $ntronica_item) : ?>
						<?php
						$ntronica_url = isset($ntronica_item['url']) ? $ntronica_item['url'] : '#';
						?>
						<div class="swiper-slide">
							<article class="news-card">
								<a class="news-card__link" href="<?php echo esc_url($ntronica_url); ?>">
									<div class="news-card__media" aria-hidden="true"></div>
									<p class="news-card__date"><?php echo esc_html($ntronica_item['date']); ?></p>
									<h3 class="news-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
								</a>
							</article>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="slider-nav news-feed__nav">
					<button
						type="button"
						class="swiper-button-prev"
						aria-label="<?php echo esc_attr(sprintf('Previous %s', $ntronica_nav_prefix)); ?>"></button>
					<p class="text-block slider-nav__fraction" aria-live="polite"></p>
					<button
						type="button"
						class="swiper-button-next"
						aria-label="<?php echo esc_attr(sprintf('Next %s', $ntronica_nav_prefix)); ?>"></button>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>