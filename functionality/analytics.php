<?php

/**
 * Third-party metrics, gated by cookie consent.
 *
 * Paste IDs below. Empty IDs output nothing even after consent.
 * Performance cookies gate GTM / GA / Yandex Metrika.
 *
 * @package ntronica
 */

if (! defined('NTRONICA_GTM_ID')) {
	define('NTRONICA_GTM_ID', ''); // GTM-XXXXXXX
}

if (! defined('NTRONICA_GA_ID')) {
	define('NTRONICA_GA_ID', ''); // G-XXXXXXXX
}

if (! defined('NTRONICA_YM_ID')) {
	define('NTRONICA_YM_ID', ''); // Yandex Metrika counter id
}

/**
 * Trimmed analytics ID, or empty string.
 *
 * @param string $constant Constant name.
 * @return string
 */
function ntronica_analytics_id($constant)
{
	if (! defined($constant)) {
		return '';
	}

	return preg_replace('/[^A-Za-z0-9_-]/', '', (string) constant($constant));
}

/**
 * GTM / GA / Metrika in <head> when Performance cookies are allowed.
 */
function ntronica_analytics_head()
{
	if (! ntronica_cookie_allowed('performance')) {
		return;
	}

	$gtm = ntronica_analytics_id('NTRONICA_GTM_ID');
	$ga  = ntronica_analytics_id('NTRONICA_GA_ID');
	$ym  = ntronica_analytics_id('NTRONICA_YM_ID');

	if ('' !== $gtm) {
?>
		<script>
			(function(w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({
					'gtm.start': new Date().getTime(),
					event: 'gtm.js'
				});
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != 'dataLayer' ? '&l=' + l : '';
				j.async = true;
				j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, 'script', 'dataLayer', '<?php echo esc_js($gtm); ?>');
		</script>
	<?php
	}

	if ('' !== $ga) {
	?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo rawurlencode($ga); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());
			gtag('config', '<?php echo esc_js($ga); ?>');
		</script>
	<?php
	}

	if ('' !== $ym) {
	?>
		<script>
			(function(m, e, t, r, i, k, a) {
				m[i] = m[i] || function() {
					(m[i].a = m[i].a || []).push(arguments)
				};
				m[i].l = 1 * new Date();
				for (var j = 0; j < document.scripts.length; j++) {
					if (document.scripts[j].src === r) {
						return;
					}
				}
				k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
			})
			(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');
			ym(<?php echo (int) $ym; ?>, 'init', {
				clickmap: true,
				accurateTrackBounce: true,
				trackLinks: true
			});
		</script>
	<?php
	}

	/**
	 * Extra performance / analytics tags after consent.
	 */
	do_action('ntronica_analytics_performance');
}
add_action('wp_head', 'ntronica_analytics_head', 2);

/**
 * GTM noscript + Metrika noscript right after <body>.
 */
function ntronica_analytics_body()
{
	if (! ntronica_cookie_allowed('performance')) {
		return;
	}

	$gtm = ntronica_analytics_id('NTRONICA_GTM_ID');
	$ym  = ntronica_analytics_id('NTRONICA_YM_ID');

	if ('' !== $gtm) {
	?>
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm); ?>"
				height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
	}

	if ('' !== $ym) {
	?>
		<noscript>
			<div><img src="https://mc.yandex.ru/watch/<?php echo (int) $ym; ?>" style="position:absolute;left:-9999px" alt="Yandex Metrika" width="1" height="1"></div>
		</noscript>
<?php
	}
}
add_action('wp_body_open', 'ntronica_analytics_body', 2);

/**
 * Placeholders for non-performance categories (paste pixels inside these hooks).
 */
function ntronica_analytics_optional_categories()
{
	if (ntronica_cookie_allowed('functional')) {
		do_action('ntronica_analytics_functional');
	}

	if (ntronica_cookie_allowed('targeting')) {
		do_action('ntronica_analytics_targeting');
	}
}
add_action('wp_head', 'ntronica_analytics_optional_categories', 3);
