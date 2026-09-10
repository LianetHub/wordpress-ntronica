<?php

/**
 * Single news article (mock)
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $title      Heading.
 *     @type string $date       Visible date (d.m.Y).
 *     @type string $datetime   Machine-readable date (Y-m-d).
 *     @type string $lead       Intro on the gray hero.
 *     @type array  $paragraphs Body paragraphs.
 *     @type array  $gallery    Slides: array{ src: string, alt: string }.
 *     @type array  $crumbs     Breadcrumb items for the mobile hero.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_article = wp_parse_args($args, ntronica_get_mock_news_article());
$ntronica_crumbs  = isset($args['crumbs']) && is_array($args['crumbs'])
	? $args['crumbs']
	: ntronica_get_news_article_crumbs();
$ntronica_paragraphs = isset($ntronica_article['paragraphs']) && is_array($ntronica_article['paragraphs'])
	? $ntronica_article['paragraphs']
	: array();
$ntronica_gallery = isset($ntronica_article['gallery']) && is_array($ntronica_article['gallery'])
	? $ntronica_article['gallery']
	: array();
?>
<article class="news-article">
	<header class="news-article__hero">
		<div class="container">
			<?php if ($ntronica_crumbs) : ?>
				<nav class="news-article__crumbs" aria-label="<?php echo esc_attr('Breadcrumb'); ?>">
					<?php ntronica_render_breadcrumbs($ntronica_crumbs); ?>
				</nav>
			<?php endif; ?>

			<div class="row">
				<div class="col-12 col-md-6">
					<h1 class="title news-article__title"><?php echo esc_html($ntronica_article['title']); ?></h1>
					<?php if ('' !== $ntronica_article['date']) : ?>
						<time
							class="text-block news-article__date"
							<?php echo '' !== $ntronica_article['datetime'] ? ' datetime="' . esc_attr($ntronica_article['datetime']) . '"' : ''; ?>><?php echo esc_html($ntronica_article['date']); ?></time>
					<?php endif; ?>
					<?php if ('' !== $ntronica_article['lead']) : ?>
						<p class="text-block-alternate news-article__lead"><?php echo esc_html($ntronica_article['lead']); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</header>

	<div class="news-article__body">
		<div class="container">
			<div class="row news-article__layout">
				<div class="col-12 col-md-6 news-article__main">
					<div class="news-article__copy">
						<?php if ($ntronica_paragraphs) : ?>
							<div class="text-block news-article__content">
								<?php foreach ($ntronica_paragraphs as $ntronica_paragraph) : ?>
									<p><?php echo esc_html($ntronica_paragraph); ?></p>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="news-article__share-col">
						<button
							type="button"
							class="link-more news-article__share"
							data-title="SHARE THIS ARTICLE"
							aria-label="<?php echo esc_attr('Share this article'); ?>">
							<span>SHARE THIS ARTICLE</span>
						</button>
					</div>
				</div>

				<?php if ($ntronica_gallery) : ?>
					<div class="col-12 col-md-6 news-article__media">
						<div class="swiper news-article-slider">
							<div class="swiper-wrapper">
								<?php foreach ($ntronica_gallery as $ntronica_slide) : ?>
									<?php
									$ntronica_src = isset($ntronica_slide['src']) ? $ntronica_slide['src'] : '';
									$ntronica_alt = isset($ntronica_slide['alt']) ? $ntronica_slide['alt'] : $ntronica_article['title'];
									if ('' === $ntronica_src) {
										continue;
									}
									?>
									<div class="swiper-slide">
										<div class="news-article__figure">
											<img
												class="news-article__img"
												src="<?php echo esc_url($ntronica_src); ?>"
												alt="<?php echo esc_attr($ntronica_alt); ?>"
												width="945"
												height="582"
												loading="lazy">
										</div>
									</div>
								<?php endforeach; ?>
							</div>

							<div class="slider-nav news-article__nav">
								<button
									type="button"
									class="swiper-button-prev"
									aria-label="<?php echo esc_attr('Previous image'); ?>"></button>
								<p class="text-block slider-nav__fraction" aria-live="polite"></p>
								<button
									type="button"
									class="swiper-button-next"
									aria-label="<?php echo esc_attr('Next image'); ?>"></button>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>