<?php

/**
 * Section: Events & news (home, row/col — no slider)
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type array $items Cards: array{ date: string, title: string, url?: string, image?: string }.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_news = wp_parse_args(
	$args,
	array(
		'items' => array(),
	)
);

$ntronica_items = is_array($ntronica_news['items']) ? $ntronica_news['items'] : array();
$ntronica_news_url = ntronica_get_news_url();
?>
<section class="news" id="news">
	<div class="container">
		<h2 class="title news__title"><?php echo esc_html(ntronica_ui_text('Events & news')); ?></h2>
		<p class="text-block news__lead">
			<?php echo esc_html(ntronica_get_category_lead('events', '')); ?>
		</p>

		<?php if ($ntronica_items) : ?>
			<div class="row news__grid">
				<?php foreach ($ntronica_items as $ntronica_index => $ntronica_item) : ?>
					<div class="col-12 col-md-3<?php echo 0 === $ntronica_index ? '' : ' news__item--desktop'; ?>">
						<?php
						get_template_part(
							'components/templates-parts/card',
							'news',
							array(
								'date'  => isset($ntronica_item['date']) ? $ntronica_item['date'] : '',
								'title' => isset($ntronica_item['title']) ? $ntronica_item['title'] : '',
								'url'   => isset($ntronica_item['url']) ? $ntronica_item['url'] : '#',
								'image' => isset($ntronica_item['image']) ? $ntronica_item['image'] : '',
							)
						);
						?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="news__more">
			<a class="link-more" href="<?php echo esc_url($ntronica_news_url); ?>" data-title="<?php echo esc_attr(ntronica_ui_text('LEARN MORE')); ?>">
				<span><?php echo esc_html(ntronica_ui_text('LEARN MORE')); ?></span>
			</a>
		</div>
	</div>
</section>