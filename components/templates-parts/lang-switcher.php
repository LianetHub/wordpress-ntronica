<?php

/**
 * WPML language switcher — renders a simple language link.
 *
 * @package ntronica
 */

$ntronica_languages = apply_filters('wpml_active_languages', null, 'skip_missing=0');

if (empty($ntronica_languages)) {
	return;
}

$ntronica_current_lang = apply_filters('wpml_current_language', null);

foreach ($ntronica_languages as $ntronica_lang) {
	if (! empty($ntronica_lang['active'])) {
		continue;
	}
?>
	<a
		class="lang-switcher"
		href="<?php echo esc_url($ntronica_lang['url']); ?>"
		hreflang="<?php echo esc_attr($ntronica_lang['language_code']); ?>"
		lang="<?php echo esc_attr($ntronica_lang['language_code']); ?>"
		aria-label="<?php echo esc_attr(sprintf(ntronica_ui_text('Switch to %s'), $ntronica_lang['native_name'])); ?>">
		<?php echo esc_html(strtoupper($ntronica_lang['language_code'])); ?>
	</a>
<?php
	break;
}
