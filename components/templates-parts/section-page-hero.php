<?php

/**
 * Shared page hero
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string $title         Page title (h1).
 *     @type string $image         Background image URL.
 *     @type string $tagline       Intro text.
 *     @type bool   $tagline_dark  Dark tagline color.
 *     @type string $nav_label     Nav aria-label.
 *     @type array  $nav           Links: array{ href: string, label: string }.
 *     @type string $lang          Language switcher label.
 *     @type string $lang_url      Language switcher URL.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_hero = wp_parse_args(
	$args,
	array(
		'title'        => '',
		'image'        => '',
		'tagline'      => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'tagline_dark' => false,
		'nav_label'    => '',
		'nav'          => array(),
		'lang'         => 'ru',
		'lang_url'     => '#',
	)
);

$ntronica_tagline_class = 'page-hero__tagline';
if (! empty($ntronica_hero['tagline_dark'])) {
	$ntronica_tagline_class .= ' page-hero__tagline--dark';
}

$ntronica_nav_label = $ntronica_hero['nav_label'];
if ('' === $ntronica_nav_label && '' !== $ntronica_hero['title']) {
	$ntronica_nav_label = $ntronica_hero['title'] . ' sections';
}

$ntronica_nav = is_array($ntronica_hero['nav']) ? $ntronica_hero['nav'] : array();
?>
<section
	class="page-hero band-full"
	<?php if ('' !== $ntronica_hero['image']) : ?>
	style="background-image: url('<?php echo esc_url($ntronica_hero['image']); ?>');"
	<?php endif; ?>>
	<div class="container page-hero__inner">
		<div class="page-hero__top">
			<nav class="page-hero__nav" aria-label="<?php echo esc_attr($ntronica_nav_label); ?>">
				<?php foreach ($ntronica_nav as $ntronica_nav_item) : ?>
					<?php
					$ntronica_nav_href = isset($ntronica_nav_item['href']) ? $ntronica_nav_item['href'] : '';
					$ntronica_nav_text = isset($ntronica_nav_item['label']) ? $ntronica_nav_item['label'] : '';
					?>
					<a class="page-hero__nav-link" href="<?php echo esc_url($ntronica_nav_href); ?>"><?php echo esc_html($ntronica_nav_text); ?></a>
				<?php endforeach; ?>
			</nav>
			<a class="page-hero__lang" href="<?php echo esc_url($ntronica_hero['lang_url']); ?>"><?php echo esc_html($ntronica_hero['lang']); ?></a>
		</div>

		<p class="<?php echo esc_attr($ntronica_tagline_class); ?>"><?php echo esc_html($ntronica_hero['tagline']); ?></p>

		<h1 class="page-hero__title"><?php echo esc_html($ntronica_hero['title']); ?></h1>
	</div>
</section>