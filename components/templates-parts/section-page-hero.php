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
 *     @type string $nav_label     Nav aria-label.
 *     @type array  $nav           Links: array{ href: string, label: string }.
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_hero = wp_parse_args(
	$args,
	array(
		'title'     => '',
		'image'     => '',
		'tagline'   => '',
		'nav_label' => '',
		'nav'       => array(),
	)
);

?>
<section
	class="page-hero band-full"
	<?php if ('' !== $ntronica_hero['image']) : ?>
	style="background-image: url('<?php echo esc_url($ntronica_hero['image']); ?>');"
	<?php endif; ?>>
	<div class="container page-hero__inner">

		<p class="page-hero__tagline" data-title="<?php echo esc_attr($ntronica_hero['tagline']); ?>"><span><?php echo esc_html($ntronica_hero['tagline']); ?></span></p>

		<h1 class="page-hero__title" data-title="<?php echo esc_attr($ntronica_hero['title']); ?>"><span><?php echo esc_html($ntronica_hero['title']); ?></span></h1>
	</div>
</section>