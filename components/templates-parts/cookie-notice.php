<?php

/**
 * Cookie consent banner.
 *
 * @package ntronica
 */

$ntronica_consent     = ntronica_get_cookie_consent();
$ntronica_has_consent = null !== $ntronica_consent;

$ntronica_categories = array(
	array(
		'key'      => 'functional',
		'title'    => 'Functional Cookies',
		'desc'     => 'These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or third-party providers whose services we added to our pages. If you do not allow these cookies, some or all of these services may not function properly.',
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['functional']),
	),
	array(
		'key'      => 'performance',
		'title'    => 'Performance Cookies',
		'desc'     => 'These cookies collect anonymous data about how visitors use our website. They help track visits and traffic sources, allowing us to measure and improve site performance. If you disable them, we won’t know when you visited or be able to analyze how the website performs.',
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['performance']),
	),
	array(
		'key'      => 'targeting',
		'title'    => 'Targeting Cookies',
		'desc'     => 'These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or by third-party providers whose services are added to our pages. If you disable these cookies, some or all of these services may not function properly.',
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['targeting']),
	),
	array(
		'key'      => 'necessary',
		'title'    => 'Necessary Cookies',
		'desc'     => 'These cookies are necessary for the website to function and cannot be switched off. They are set in response to your actions, like preferences or logging in. You can block or alert them in your browser, but parts of the site may not work. They do not store personal data.',
		'locked'   => true,
		'checked'  => true,
	),
);
?>
<aside
	id="cookie-notice"
	class="cookie-notice"
	role="dialog"
	aria-label="Cookie notice"
	aria-modal="false"
	data-cookie-name="<?php echo esc_attr(NTRONICA_COOKIE_CONSENT); ?>"
	<?php echo $ntronica_has_consent ? 'hidden' : ''; ?>>
	<div class="container cookie-notice__inner">
		<div class="cookie-notice__panel cookie-notice__panel--default">
			<div class="row cookie-notice__default">
				<div class="col-12 col-xl-4 cookie-notice__intro">
					<p class="text-block-alternate cookie-notice__text">
						<strong>This site uses cookies to improve service.</strong>
						Click to agree, personalize your experience and make your future visit even better
					</p>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<button class="cookie-notice__btn" type="button" data-cookie-manage aria-expanded="false" aria-controls="cookie-notice-manage">
						Manage cookies
					</button>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<button class="cookie-notice__btn" type="button" data-cookie-accept>
						Accept all
					</button>
				</div>
			</div>
		</div>

		<div class="cookie-notice__panel cookie-notice__panel--manage" id="cookie-notice-manage" hidden>
			<button class="cookie-notice__close" type="button" data-cookie-close>
				<span class="screen-reader-text">Close cookie settings</span>
				<?php ntronica_icon('close'); ?>
			</button>

			<div class="row cookie-notice__manage-head">
				<div class="col-12 col-xxl-4">
					<h2 class="cookie-notice__title" id="cookie-notice-title">Manage cookie preferences</h2>
					<p class="text-block-alternate cookie-notice__lead">
						Configure cookie settings and confirm to save your settings. You can change consent at any time on our cookie consent page
					</p>
				</div>
			</div>

			<div class="row cookie-notice__categories">
				<?php foreach ($ntronica_categories as $ntronica_cat) : ?>
					<div class="col-12 col-md-6 col-xxl-4">
						<label class="cookie-notice__check<?php echo $ntronica_cat['locked'] ? ' cookie-notice__check--locked' : ''; ?>">
							<input
								class="cookie-notice__input"
								type="checkbox"
								name="cookie_<?php echo esc_attr($ntronica_cat['key']); ?>"
								value="1"
								data-cookie-category="<?php echo esc_attr($ntronica_cat['key']); ?>"
								<?php checked($ntronica_cat['checked']); ?>
								<?php disabled($ntronica_cat['locked']); ?>>
							<span class="cookie-notice__box" aria-hidden="true"></span>
							<span class="cookie-notice__check-body">
								<span class="cookie-notice__check-title"><?php echo esc_html($ntronica_cat['title']); ?></span>
								<span class="cookie-notice__check-desc"><?php echo esc_html($ntronica_cat['desc']); ?></span>
							</span>
						</label>
					</div>
				<?php endforeach; ?>
				<div class="col-12 col-md-6 col-xxl-4 offset-xxl-4 cookie-notice__confirm">
					<button class="cookie-notice__btn" type="button" data-cookie-confirm>
						Confirm
					</button>
				</div>
			</div>
		</div>
	</div>
</aside>