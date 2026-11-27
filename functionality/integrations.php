<?php

/**
 * Third-party integrations (ACF, CF7, Rank Math)
 *
 * @package ntronica
 */

// Contact Form 7 — disable auto <p>/<br>.
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Tips under Contact us fields. Edit these strings to change the copy.
 *
 * @return array<string, string>
 */
function ntronica_cf7_contact_messages()
{
	$form = function_exists('wpcf7_get_current_contact_form') ? wpcf7_get_current_contact_form() : null;
	$is_ru = $form ? 0 === strpos($form->locale(), 'ru') : (function_exists('ntronica_current_language') && 'ru' === ntronica_current_language());
	if ($is_ru) {
		return array(
			'your-name' => 'Введите ваше имя',
			'email' => 'Введите корректный адрес электронной почты',
			'phone' => 'Введите корректный номер телефона',
		);
	}
	return array(
		'your-name' => 'Enter your name',
		'email'     => 'Enter a valid e-mail',
		'phone'     => 'Enter a valid phone number',
	);
}

/**
 * Override SWV error messages for the Contact form via filter.
 *
 * CF7 6.x made rule $error readonly, so we use the dedicated filter instead
 * of modifying the property by reflection.
 */
add_filter(
	'wpcf7_swv_rule_error_message',
	function ($message, $rule) {
		$messages = ntronica_cf7_contact_messages();

		if (! is_object($rule)) {
			return $message;
		}

		$field = null;
		try {
			$reflection = new ReflectionObject($rule);
			if ($reflection->hasProperty('properties')) {
				$prop = $reflection->getProperty('properties');
				$prop->setAccessible(true);
				$props = $prop->getValue($rule);
				if (is_array($props) && isset($props['field'])) {
					$field = $props['field'];
				}
			} elseif ($reflection->hasProperty('field')) {
				$prop = $reflection->getProperty('field');
				$prop->setAccessible(true);
				$field = $prop->getValue($rule);
			}
		} catch (ReflectionException $exception) {
			unset($exception);
			return $message;
		}

		if (is_string($field) && isset($messages[$field])) {
			return $messages[$field];
		}

		return $message;
	},
	10,
	2
);

/**
 * Keep acceptance clicks from validating the fields above the checkbox.
 *
 * @param string $html Form markup.
 * @return string
 */
function ntronica_cf7_consent_novalidate($html)
{
	if (! is_string($html) || false === strpos($html, 'class="form__consent"')) {
		return $html;
	}

	return str_replace(
		'class="form__consent"',
		'class="form__consent novalidate"',
		$html
	);
}
add_filter('wpcf7_form_elements', 'ntronica_cf7_consent_novalidate');

// TODO: удалить после смены ключа WPML на production (плашка «development site»).
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_add_inline_style(
			'ntronica-style',
			'.otgs-development-site-front-end{display:none!important}'
		);
	},
	20
);

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
