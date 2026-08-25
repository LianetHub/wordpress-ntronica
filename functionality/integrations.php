<?php

/**
 * Third-party integrations (ACF, CF7, Rank Math)
 *
 * @package ntronica
 */

// Contact Form 7 — disable auto <p>/<br>.
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Output ACF option scripts in <head>.
 */
add_action(
	'wp_head',
	function () {
		if (! function_exists('get_field')) {
			return;
		}

		$header_scripts = get_field('header_scripts', 'options');

		if (! empty($header_scripts)) {
			echo "\n<!-- Global Header Scripts from ACF -->\n";
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- intentional raw scripts from options.
			echo $header_scripts;
			echo "\n<!-- End Global Header Scripts -->\n";
		}
	},
	100
);

/**
 * Output ACF option scripts after <body>.
 */
add_action(
	'wp_body_open',
	function () {
		if (! function_exists('get_field')) {
			return;
		}

		$body_scripts = get_field('body_scripts', 'options');

		if (! empty($body_scripts)) {
			echo "\n<!-- Global Body Scripts from ACF -->\n";
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- intentional raw scripts from options.
			echo $body_scripts;
			echo "\n<!-- End Global Body Scripts -->\n";
		}
	},
	100
);

/**
 * Output ACF option scripts in footer.
 */
add_action(
	'wp_footer',
	function () {
		if (! function_exists('get_field')) {
			return;
		}

		$footer_scripts = get_field('footer_scripts', 'options');

		if (! empty($footer_scripts)) {
			echo "\n<!-- Global Footer Scripts from ACF -->\n";
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- intentional raw scripts from options.
			echo $footer_scripts;
			echo "\n<!-- End Global Footer Scripts -->\n";
		}
	},
	100
);

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
