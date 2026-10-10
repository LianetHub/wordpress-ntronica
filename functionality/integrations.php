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
	return array(
		'your-name' => 'Enter your name',
		'email'     => 'Enter a valid e-mail',
		'phone'     => 'Enter a valid phone number',
	);
}

/**
 * Replace SWV error text for one rule, if its field is in the map.
 *
 * @param object               $rule     SWV rule.
 * @param array<string,string> $messages Field name => tip.
 */
function ntronica_cf7_set_rule_error($rule, $messages)
{
	if (! is_object($rule)) {
		return;
	}

	try {
		$reflection = new ReflectionObject($rule);
	} catch (ReflectionException $exception) {
		unset($exception);
		return;
	}

	if ($reflection->hasProperty('properties')) {
		$property = $reflection->getProperty('properties');
		$property->setAccessible(true);
		$props = $property->getValue($rule);
		if (is_array($props) && isset($props['field'], $messages[$props['field']])) {
			$props['error'] = $messages[$props['field']];
			$property->setValue($rule, $props);
			return;
		}
	}

	if (! $reflection->hasProperty('field') || ! $reflection->hasProperty('error')) {
		return;
	}

	$field_prop = $reflection->getProperty('field');
	$error_prop = $reflection->getProperty('error');
	$field_prop->setAccessible(true);
	$error_prop->setAccessible(true);
	$field = $field_prop->getValue($rule);
	if (is_string($field) && isset($messages[$field])) {
		$error_prop->setValue($rule, $messages[$field]);
	}
}

/**
 * Custom required/format tips for the Contact us form.
 *
 * @param object $schema       WPCF7_SWV_Schema.
 * @param object $contact_form WPCF7_ContactForm.
 */
function ntronica_cf7_contact_schema($schema, $contact_form)
{
	if (! is_object($contact_form) || ! method_exists($contact_form, 'hash')) {
		return;
	}
	if ('9a6010d' !== (string) $contact_form->hash()) {
		return;
	}
	if (! is_object($schema)) {
		return;
	}

	$rules = array();
	if (method_exists($schema, 'rules')) {
		$rules = $schema->rules();
	} else {
		try {
			$reflection = new ReflectionObject($schema);
			if ($reflection->hasProperty('rules')) {
				$property = $reflection->getProperty('rules');
				$property->setAccessible(true);
				$rules = $property->getValue($schema);
			}
		} catch (ReflectionException $exception) {
			unset($exception);
			$rules = array();
		}
	}

	if (! is_array($rules)) {
		return;
	}

	$messages = ntronica_cf7_contact_messages();
	foreach ($rules as $rule) {
		ntronica_cf7_set_rule_error($rule, $messages);
	}
}
add_action('wpcf7_swv_create_schema', 'ntronica_cf7_contact_schema', 20, 2);

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
