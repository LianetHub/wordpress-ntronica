<?php

/**
 * News card
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $date      Visible date (d.m.Y).
 *     @type string $datetime  Optional machine-readable date (Y-m-d or ISO 8601).
 *     @type string $title     Title.
 *     @type string $url       Permalink.
 *     @type string $image     Optional image URL.
 *     @type string $image_alt Optional image alt; defaults to title.
 *     @type string $class     Extra classes on the article (e.g. swiper-slide).
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_card = wp_parse_args(
	$args,
	array(
		'date'      => '',
		'datetime'  => '',
		'title'     => '',
		'url'       => '#',
		'image'     => '',
		'image_alt' => '',
		'class'     => '',
	)
);

$ntronica_class = 'news-card';
if ('' !== $ntronica_card['class']) {
	$ntronica_class .= ' ' . $ntronica_card['class'];
}

$ntronica_datetime = $ntronica_card['datetime'];
if ('' === $ntronica_datetime && '' !== $ntronica_card['date']) {
	$ntronica_parsed = DateTime::createFromFormat('d.m.Y', $ntronica_card['date']);
	if ($ntronica_parsed instanceof DateTimeInterface) {
		$ntronica_datetime = $ntronica_parsed->format('Y-m-d');
	}
}

$ntronica_image_alt = $ntronica_card['image_alt'];
if ('' === $ntronica_image_alt) {
	$ntronica_image_alt = $ntronica_card['title'];
}

$ntronica_has_image = '' !== $ntronica_card['image'];
?>
<article class="<?php echo esc_attr($ntronica_class); ?>">
	<a class="news-card__link" href="<?php echo esc_url($ntronica_card['url']); ?>">
		<div class="news-card__media" <?php echo $ntronica_has_image ? '' : ' aria-hidden="true"'; ?>>
			<?php if ($ntronica_has_image) : ?>
				<img
					class="news-card__img"
					src="<?php echo esc_url($ntronica_card['image']); ?>"
					alt="<?php echo esc_attr($ntronica_image_alt); ?>"
					width="622"
					height="412"
					loading="lazy">
			<?php endif; ?>
		</div>
		<?php if ('' !== $ntronica_card['date']) : ?>
			<time class="news-card__date" <?php echo '' !== $ntronica_datetime ? ' datetime="' . esc_attr($ntronica_datetime) . '"' : ''; ?>><?php echo esc_html($ntronica_card['date']); ?></time>
		<?php endif; ?>
		<h3 class="news-card__title"><?php echo esc_html($ntronica_card['title']); ?></h3>
	</a>
</article>