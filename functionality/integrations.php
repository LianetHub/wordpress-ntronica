<?php

/**
 * Third-party integrations (ACF, CF7, Rank Math)
 *
 * @package ntronica
 */

// Contact Form 7 — disable auto <p>/<br>.
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Custom Rank Math breadcrumbs markup: "Parent — Current".
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

		if (! is_array($crumbs) || ! $crumbs) {
			return '';
		}

		$output = '<ol class="breadcrumbs__list">';
		$last   = count($crumbs) - 1;

		foreach ($crumbs as $key => $crumb) {
			$label    = isset($crumb[0]) ? (string) $crumb[0] : '';
			$url      = isset($crumb[1]) ? (string) $crumb[1] : '';
			$is_last  = (int) $key === $last;
			$li_class = $is_last ? 'breadcrumbs__item breadcrumbs__item--last' : 'breadcrumbs__item';

			$output .= '<li class="' . esc_attr($li_class) . '">';

			if (! $is_last && $url) {
				$output .= '<a href="' . esc_url($url) . '" class="breadcrumbs__link">' . esc_html($label) . '</a>';
			} else {
				$output .= '<span class="breadcrumbs__current">' . esc_html($label) . '</span>';
			}

			$output .= '</li>';

			if (! $is_last) {
				$output .= '<li class="breadcrumbs__sep" aria-hidden="true"> — </li>';
			}
		}

		$output .= '</ol>';
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

add_filter(
	'rank_math/frontend/breadcrumb/strings',
	function ($strings) {
		$strings['error404'] = 'Error 404';
		return $strings;
	}
);
