<?php

/**
 * Language switcher (WPML): other language as a 2-letter code.
 *
 * @package ntronica
 */

if (! has_filter('wpml_active_languages')) {
	return;
}

$ntronica_languages = apply_filters(
	'wpml_active_languages',
	null,
	array(
		'skip_missing' => 0,
	)
);

if (empty($ntronica_languages) || ! is_array($ntronica_languages)) {
	return;
}

$ntronica_other = null;

foreach ($ntronica_languages as $ntronica_lang) {
	if (empty($ntronica_lang['active'])) {
		$ntronica_other = $ntronica_lang;
		break;
	}
}

if (! $ntronica_other) {
	return;
}

$ntronica_code = isset($ntronica_other['code']) ? (string) $ntronica_other['code'] : '';
$ntronica_url  = isset($ntronica_other['url']) ? (string) $ntronica_other['url'] : '';
$ntronica_name = isset($ntronica_other['native_name']) ? (string) $ntronica_other['native_name'] : $ntronica_code;

if ('' === $ntronica_code || '' === $ntronica_url) {
	return;
}
?>
<a
	class="lang-switcher"
	href="<?php echo esc_url($ntronica_url); ?>"
	hreflang="<?php echo esc_attr($ntronica_code); ?>"
	lang="<?php echo esc_attr($ntronica_code); ?>"
	aria-label="<?php echo esc_attr(sprintf('Switch to %s', $ntronica_name)); ?>"><?php echo esc_html($ntronica_code); ?></a>