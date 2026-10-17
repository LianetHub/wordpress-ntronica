<?php

/**
 * Primary sidebar navigation
 *
 * @package ntronica
 */

$ntronica_sidebar_items = ntronica_get_nav_tree();

$current_language = apply_filters('wpml_current_language', 'en');

if (! in_array($current_language, ['en', 'ru'], true)) {
	$current_language = 'en';
}
?>
<aside class="sidebar is-collapsed sidebar--language-<?= $current_language ?>" aria-label="Primary">
	<div class="sidebar__lang">
		<?php get_template_part('components/templates-parts/lang-switcher'); ?>
	</div>
	<button class="sidebar__close" type="button">
		<span class="screen-reader-text">Close menu</span>
		<?php ntronica_icon('close', '', '0 0 19 19'); ?>
	</button>
	<nav class="sidebar__nav" id="sidebar-nav">
		<ul class="sidebar__menu">
			<?php foreach ($ntronica_sidebar_items as $ntronica_item) : ?>
				<?php
				$ntronica_is_current   = ntronica_is_nav_item_current($ntronica_item['slug']);
				$ntronica_children     = $ntronica_item['children'];
				$ntronica_has_children = ! empty($ntronica_children);
				$ntronica_item_class   = 'sidebar__item';
				$ntronica_link_class   = 'sidebar__link';

				if ($ntronica_is_current) {
					$ntronica_link_class .= ' is-active';
					if ($ntronica_has_children) {
						$ntronica_item_class .= ' is-expanded';
					}
				}
				?>
				<li class="<?php echo esc_attr($ntronica_item_class); ?>">
					<a
						class="<?php echo esc_attr($ntronica_link_class); ?>"
						href="<?php echo esc_url($ntronica_item['url']); ?>"
						<?php if ($ntronica_has_children) : ?>
						aria-expanded="<?php echo $ntronica_is_current ? 'true' : 'false'; ?>"
						<?php endif; ?>
						data-title="<?php echo esc_attr($ntronica_item['label']); ?>"><span><?php echo esc_html($ntronica_item['label']); ?></span></a>
					<?php if ($ntronica_has_children) : ?>
						<ul class="sidebar__submenu">
							<?php foreach ($ntronica_children as $ntronica_child) : ?>
								<li>
									<a
										class="sidebar__sublink"
										href="<?php echo esc_url($ntronica_item['url'] . $ntronica_child['href']); ?>"><?php echo esc_html($ntronica_child['label']); ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<a href="<?php echo esc_url(home_url('/')); ?>"
		class="sidebar__logo"
		aria-expanded="false"
		aria-controls="sidebar-nav">
		<span class="screen-reader-text">Menu</span>
		<?php
		get_template_part(
			'components/templates-parts/logo',
			$current_language
		);
		?>
	</a>
</aside>