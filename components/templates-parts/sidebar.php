<?php

/**
 * Primary sidebar navigation
 *
 * @package ntronica
 */

$ntronica_sidebar_items = ntronica_get_nav_tree();
?>
<aside class="sidebar" aria-label="Primary">
	<div class="sidebar__lang">
		<?php get_template_part('components/templates-parts/lang-switcher'); ?>
	</div>
	<button class="sidebar__close" type="button">
		<span class="screen-reader-text">Close menu</span>
		<?php ntronica_icon('close'); ?>
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
	<button
		class="sidebar__logo"
		type="button"
		aria-expanded="false"
		aria-controls="sidebar-nav">
		<span class="screen-reader-text">Menu</span>
		<svg width="234" height="34" viewBox="0 0 234 34" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
			<path d="M0 33.2493V9.06909H15.096C20.9021 9.06909 24.156 13.0043 24.156 17.4964V33.2493H18.12V15.1111H6.03598V33.2493H0ZM35.478 15.1111V27.1952H47.55V15.1111H35.478ZM58.872 24.8219V0H64.9079V9.06909H78.4919V15.1111H64.9079V27.1952H78.4919V33.2372H67.9199C62.15 33.2372 58.8599 29.3504 58.8599 24.8098L58.872 24.8219ZM102.648 15.1111H89.0639V33.2493H83.028V17.3754C83.028 12.8105 86.6931 9.06909 92.463 9.06909H102.648V15.1111ZM116.958 8.30627C109.906 8.30627 104.16 14.0456 104.16 21.1168C104.16 28.188 109.894 34 116.958 34C124.022 34 129.828 28.2607 129.828 21.1168C129.828 13.9729 124.058 8.30627 116.958 8.30627ZM110.958 15.1111H123.03V27.1952H110.958V15.1111ZM134.352 33.2493V9.06909H149.484C155.254 9.06909 158.508 12.9558 158.508 17.4964V33.2493H152.472V15.1111H140.4V33.2493H134.364H134.352ZM181.914 9.06909H162.294V15.1111H175.878V33.2493H181.914V9.06909ZM175.878 0V6.04202H181.914V0H175.878ZM186.45 21.1168C186.45 14.6631 191.204 9.06909 198.413 9.06909H206.832V15.0748H193.248V27.2073H206.832V33.2493H198.413C191.204 33.2493 186.45 27.6189 186.45 21.1289V21.1168ZM234 9.05698V33.2493H218.904C214.114 33.2493 209.844 30.2222 209.844 25.6937C209.844 21.1652 212.263 18.4046 215.88 17.6417V27.1952H227.952V15.1111H215.88V9.06909H234V9.05698Z" fill="currentColor" />
		</svg>
	</button>
</aside>
