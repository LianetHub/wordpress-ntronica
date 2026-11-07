<?php

/**
 * WPML language switcher.
 *
 * @param array $args Optional switch_label_format for the accessible label (%s is the language name).
 *
 * @package ntronica
 */

if (! has_filter('wpml_active_languages')) {
	return;
}

$languages = apply_filters('wpml_active_languages', null, [
	'skip_missing' => 0,
]);

if (empty($languages) || ! is_array($languages)) {
	return;
}

$switch_label_format = $args['switch_label_format'] ?? 'Switch to %s';

foreach ($languages as $language) {
	if (! empty($language['active'])) {
		continue;
	}

	$code = strtoupper((string) ($language['code'] ?? ''));
	$url = (string) ($language['url'] ?? '');
	$name = (string) ($language['native_name'] ?? $code);

	if ($code === '' || $url === '') {
		continue;
	}
?>
	<a
		class="lang-switcher"
		href="<?php echo esc_url($url); ?>"
		hreflang="<?php echo esc_attr(strtolower($code)); ?>"
		lang="<?php echo esc_attr(strtolower($code)); ?>"
		aria-label="<?php echo esc_attr(sprintf($switch_label_format, $name)); ?>">
		<?php echo esc_html($code); ?>
	</a>
<?php
	break;
}
