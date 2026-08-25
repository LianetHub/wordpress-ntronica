<?php

/**
 * Third-party integrations (ACF, CF7, Rank Math)
 *
 * @package ntronica
 */

// Contact Form 7 — disable auto <p>/<br>.
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Custom Rank Math breadcrumbs markup.
 *
 * @param string $html   Default HTML.
 * @param array  $crumbs Crumb items.
 * @param string $class  CSS class.
 * @return string
 */
add_filter(
	'rank_math/frontend/breadcrumb/html',
	function ($html, $crumbs, $class) {
		unset($html, $class);

		$output = '<ul class="breadcrumbs__list">';

		foreach ($crumbs as $key => $crumb) {
			$is_last  = (count($crumbs) - 1) === $key;
			$li_class = $is_last ? 'breadcrumbs__item breadcrumbs__item--last' : 'breadcrumbs__item';

			$output .= '<li class="' . esc_attr($li_class) . '">';

			if (! $is_last && isset($crumb[1])) {
				$output .= '<a href="' . esc_url($crumb[1]) . '" class="breadcrumbs__link">' . esc_html($crumb[0]) . '</a>';
			} else {
				$output .= '<span class="breadcrumbs__current">' . esc_html($crumb[0]) . '</span>';
			}

			$output .= '</li>';
		}

		$output .= '</ul>';
		return $output;
	},
	10,
	3
);

add_filter(
	'rank_math/frontend/breadcrumb/settings',
	function ($settings) {
		$settings['separator'] = '';
		return $settings;
	}
);
