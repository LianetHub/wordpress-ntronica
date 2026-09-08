<?php

/**
 * Product / solution card
 *
 * Canonical markup: media + title (see About → solutions).
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $title     Caption.
 *     @type string $url       Permalink.
 *     @type string $image     Image URL.
 *     @type string $image_alt Optional alt; defaults to title.
 *     @type int    $width     Image width. Default 622.
 *     @type int    $height    Image height. Default 412.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_card = wp_parse_args(
	$args,
	array(
		'title'     => '',
		'url'       => '#',
		'image'     => '',
		'image_alt' => '',
		'width'     => 622,
		'height'    => 412,
	)
);

$ntronica_image_alt = $ntronica_card['image_alt'];
if ('' === $ntronica_image_alt) {
	$ntronica_image_alt = $ntronica_card['title'];
}

$ntronica_has_image = '' !== $ntronica_card['image'];
?>
<a class="product-card" href="<?php echo esc_url($ntronica_card['url']); ?>">
	<div class="product-card__media" <?php echo $ntronica_has_image ? '' : ' aria-hidden="true"'; ?>>
		<?php if ($ntronica_has_image) : ?>
			<img
				class="product-card__img"
				src="<?php echo esc_url($ntronica_card['image']); ?>"
				alt="<?php echo esc_attr($ntronica_image_alt); ?>"
				width="<?php echo esc_attr((string) (int) $ntronica_card['width']); ?>"
				height="<?php echo esc_attr((string) (int) $ntronica_card['height']); ?>"
				loading="lazy">
		<?php endif; ?>
	</div>
	<h3 class="product-card__title"><?php echo esc_html($ntronica_card['title']); ?></h3>
</a>