<?php

/**
 * Cookie consent helpers.
 *
 * @package ntronica
 */

define('NTRONICA_COOKIE_CONSENT', 'ntronica_cookie_consent');

/**
 * Parsed consent cookie, or null if the visitor has not chosen yet.
 *
 * @return array{v:int,necessary:bool,functional:bool,performance:bool,targeting:bool}|null
 */
function ntronica_get_cookie_consent()
{
	if (! isset($_COOKIE[NTRONICA_COOKIE_CONSENT])) {
		return null;
	}

	$raw = wp_unslash($_COOKIE[NTRONICA_COOKIE_CONSENT]);
	if (! is_string($raw) || '' === $raw) {
		return null;
	}

	$data = json_decode($raw, true);
	if (! is_array($data)) {
		return null;
	}

	return array(
		'v'           => isset($data['v']) ? (int) $data['v'] : 1,
		'necessary'   => true,
		'functional'  => ! empty($data['functional']),
		'performance' => ! empty($data['performance']),
		'targeting'   => ! empty($data['targeting']),
	);
}

/**
 * Whether the visitor has already saved a consent choice.
 *
 * @return bool
 */
function ntronica_has_cookie_consent()
{
	return null !== ntronica_get_cookie_consent();
}

/**
 * Whether a cookie category is allowed.
 *
 * Necessary cookies are always on. Everything else is opt-in.
 *
 * @param string $category necessary|functional|performance|targeting.
 * @return bool
 */
function ntronica_cookie_allowed($category)
{
	$category = sanitize_key($category);

	if ('necessary' === $category) {
		return true;
	}

	$consent = ntronica_get_cookie_consent();
	if (! $consent || ! array_key_exists($category, $consent)) {
		return false;
	}

	return (bool) $consent[$category];
}

/**
 * Body class while the cookie banner is shown (reserves space above it).
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function ntronica_cookie_notice_body_class($classes)
{
	if (! ntronica_has_cookie_consent()) {
		$classes[] = 'has-cookie-notice';
	}

	return $classes;
}
add_filter('body_class', 'ntronica_cookie_notice_body_class');
