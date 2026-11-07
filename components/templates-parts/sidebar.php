<?php

/**
 * Primary sidebar navigation
 *
 * @package ntronica
 */

$current_language = apply_filters('wpml_current_language', 'en');

if (! in_array($current_language, ['en', 'ru'], true)) {
	$current_language = 'en';
}

$ntronica_sidebar_items = ntronica_get_nav_tree();
$ntronica_sidebar_is_ru = 'ru' === $current_language;

if ($ntronica_sidebar_is_ru) {
	$ntronica_sidebar_labels = array(
		'about' => array(
			'label' => 'Компания',
			'children' => array(
				'#overview' => 'Компания',
				'#goal'     => 'Наша цель',
				'#about-us' => 'О нас',
			),
		),
		'technology' => array(
			'label' => 'Технология',
			'children' => array(
				'#microchips' => 'О микроэлектронике',
				'#processes'  => 'Технологические процессы',
				'#media'      => 'Публикации в СМИ',
			),
		),
		'products' => array(
			'label' => 'Разработки',
			'children' => array(
				'#thin-films'      => 'Тонкоплёночное оборудование',
				'#wet-process'     => 'Оборудование для жидкой химии',
				'#process-control' => 'Контроль процессов',
			),
		),
		'news' => array(
			'label' => 'Новости',
			'children' => array(
				'#events' => 'События и новости',
				'#press'  => 'Пресс-релизы',
				'#media'  => 'СМИ о нас',
			),
		),
		'careers' => array(
			'label' => 'Карьера',
			'children' => array(
				'#team'     => 'Наша команда',
				'#careers'  => 'Открытые вакансии',
				'#contacts' => 'Связаться с нами',
			),
		),
		'contacts' => array(
			'label' => 'Контакты',
			'children' => array(
				'#about'              => 'Реквизиты компании',
				'#our-representative' => 'Наше представительство',
				'#contacts'           => 'Связаться с нами',
			),
		),
	);

	foreach ($ntronica_sidebar_items as $ntronica_index => $ntronica_item) {
		$ntronica_labels = $ntronica_sidebar_labels[$ntronica_item['slug']] ?? null;
		if (null === $ntronica_labels) {
			continue;
		}

		$ntronica_sidebar_items[$ntronica_index]['label'] = $ntronica_labels['label'];
		foreach ($ntronica_item['children'] as $ntronica_child_index => $ntronica_child) {
			$ntronica_sidebar_items[$ntronica_index]['children'][$ntronica_child_index]['label'] =
				$ntronica_labels['children'][$ntronica_child['href']] ?? $ntronica_child['label'];
		}
	}
}
?>
<aside class="sidebar is-collapsed sidebar--language-<?php echo esc_attr($current_language); ?>" aria-label="<?php echo esc_attr($ntronica_sidebar_is_ru ? 'Основная навигация' : 'Primary'); ?>">
	<div class="sidebar__lang">
		<?php get_template_part('components/templates-parts/lang-switcher', null, array(
			'switch_label_format' => $ntronica_sidebar_is_ru ? 'Переключить язык на %s' : 'Switch to %s',
		)); ?>
	</div>
	<button class="sidebar__close" type="button">
		<span class="screen-reader-text"><?php echo esc_html($ntronica_sidebar_is_ru ? 'Закрыть меню' : 'Close menu'); ?></span>
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
		<span class="screen-reader-text"><?php echo esc_html($ntronica_sidebar_is_ru ? 'Меню' : 'Menu'); ?></span>
		<?php
		get_template_part(
			'components/templates-parts/logo',
			$current_language
		);
		?>
	</a>
</aside>