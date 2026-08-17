<?php

/**
 * News cards listing with Swiper pages (Events & news / Press releases)
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $id         Section id.
 *     @type string $title      Heading.
 *     @type string $lead       Intro text.
 *     @type string $modifier   Optional BEM modifier (e.g. press).
 *     @type string $nav_prefix Aria-label prefix for slider buttons.
 *     @type array  $items      Cards: array{ date: string, title: string }.
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
		'nav_prefix' => '',
		'items'      => array(),
	)
);

$ntronica_class = 'section-news-feed';
if ('' !== $ntronica_feed['modifier']) {
	$ntronica_class .= ' section-news-feed--' . sanitize_html_class($ntronica_feed['modifier']);
}

$ntronica_nav_prefix = $ntronica_feed['nav_prefix'];
if ('' === $ntronica_nav_prefix) {
	$ntronica_nav_prefix = $ntronica_feed['title'];
}

$ntronica_items = is_array($ntronica_feed['items']) ? $ntronica_feed['items'] : array();
$ntronica_pages = array_chunk($ntronica_items, 8);
$ntronica_has_nav = count($ntronica_pages) > 1;
?>
<section class="<?php echo esc_attr($ntronica_class); ?>" id="<?php echo esc_attr($ntronica_feed['id']); ?>">
	<div class="container">
		<h2 class="section-title section-news-feed__title"><?php echo esc_html($ntronica_feed['title']); ?></h2>
		<div class="row">
			<div class="col-12 col-md-6">
				<p class="section-lead section-news-feed__lead"><?php echo esc_html($ntronica_feed['lead']); ?></p>
			</div>
		</div>

		<div class="swiper js-paged-slider section-news-feed__slider">
			<div class="swiper-wrapper">
				<?php foreach ($ntronica_pages as $ntronica_page) : ?>
					<div class="swiper-slide">
						<div class="row section-news-feed__grid">
							<?php foreach ($ntronica_page as $ntronica_item) : ?>
								<div class="col-12 col-md-3">
									<article class="news-card">
										<div class="news-card__media" aria-hidden="true"></div>
										<p class="news-card__date"><?php echo esc_html($ntronica_item['date']); ?></p>
										<h3 class="news-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
									</article>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ($ntronica_has_nav) : ?>
				<div class="slider-nav section-news-feed__nav">
					<button type="button" class="slider-nav__prev" aria-label="<?php echo esc_attr(sprintf('Previous %s', $ntronica_nav_prefix)); ?>">←</button>
					<p class="slider-nav__fraction" aria-live="polite"></p>
					<button type="button" class="slider-nav__next" aria-label="<?php echo esc_attr(sprintf('Next %s', $ntronica_nav_prefix)); ?>">→</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>