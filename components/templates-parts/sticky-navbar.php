<?php

/**
 * Sticky navbar (page breadcrumbs / section nav).
 *
 * @package ntronica
 *
 * @var array $args {
 *     @type string        $variant        'nav'|'breadcrumbs'.
 *     @type string        $nav_label      aria-label / accessible label (nav variant).
 *     @type string        $theme          Optional theme for breadcrumbs ('light').
 *     @type array<int,array{href:string,label:string}> $nav   Nav links (nav variant).
 *     @type array<int,array{label:string,url?:string}> $crumbs Mock crumbs (breadcrumbs variant).
 *     @type bool          $show_breadcrumbs Show Rank Math breadcrumbs (breadcrumbs variant).
 * }
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$variant = isset($args['variant']) && is_string($args['variant']) ? $args['variant'] : 'nav';
$nav_label = isset($args['nav_label']) ? (string) $args['nav_label'] : 'Page navigation';
$theme = isset($args['theme']) && is_string($args['theme']) ? $args['theme'] : '';

$nav = isset($args['nav']) && is_array($args['nav']) ? $args['nav'] : array();
$crumbs = isset($args['crumbs']) && is_array($args['crumbs']) ? $args['crumbs'] : array();
$show_breadcrumbs = isset($args['show_breadcrumbs']) ? (bool) $args['show_breadcrumbs'] : false;

$ntronica_navbar_attrs = ' data-variant="' . esc_attr($variant) . '"';
if ('' !== $theme) {
	$ntronica_navbar_attrs .= ' data-theme="' . esc_attr($theme) . '"';
}
?>

<header class="sticky-navbar" <?php echo $ntronica_navbar_attrs; ?>>
	<div class="container">
		<div class="sticky-navbar__inner">
			<?php if ('nav' === $variant && $nav) : ?>
				<nav class="sticky-navbar__nav" aria-label="<?php echo esc_attr($nav_label); ?>">
					<ul class="sticky-navbar__nav-list">
						<?php foreach ($nav as $nav_item) : ?>
							<?php
							$href = isset($nav_item['href']) ? (string) $nav_item['href'] : '';
							$text = isset($nav_item['label']) ? (string) $nav_item['label'] : '';
							?>
							<li class="sticky-navbar__nav-item">
								<a class="sticky-navbar__nav-link" href="<?php echo esc_url($href); ?>">
									<?php echo esc_html($text); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php elseif ('nav' !== $variant) : ?>
				<div class="sticky-navbar__breadcrumbs">
					<?php
					if ($crumbs) {
						ntronica_render_breadcrumbs($crumbs);
					} elseif ($show_breadcrumbs && function_exists('rank_math_the_breadcrumbs')) {
						rank_math_the_breadcrumbs();
					}
					?>
				</div>
			<?php endif; ?>

			<div class="sticky-navbar__lang">
				<?php get_template_part('components/templates-parts/lang-switcher'); ?>
			</div>
		</div>
	</div>
</header>