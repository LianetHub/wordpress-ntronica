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
		'title'    => esc_html__('Functional Cookies', 'ntronica'),
		'desc'     => esc_html__('These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or third-party providers whose services we added to our pages. If you do not allow these cookies, some or all of these services may not function properly.', 'ntronica'),
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['functional']),
	),
	array(
		'key'      => 'performance',
		'title'    => esc_html__('Performance Cookies', 'ntronica'),
		'desc'     => esc_html__('These cookies collect anonymous data about how visitors use our website. They help track visits and traffic sources, allowing us to measure and improve site performance. If you disable them, we won\'t know when you visited or be able to analyze how the website performs.', 'ntronica'),
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['performance']),
	),
	array(
		'key'      => 'targeting',
		'title'    => esc_html__('Targeting Cookies', 'ntronica'),
		'desc'     => esc_html__('These cookies enable the website to provide enhanced functionality and personalization. They may be set by us or by third-party providers whose services are added to our pages. If you disable these cookies, some or all of these services may not function properly.', 'ntronica'),
		'locked'   => false,
		'checked'  => $ntronica_has_consent && ! empty($ntronica_consent['targeting']),
	),
	array(
		'key'      => 'necessary',
		'title'    => esc_html__('Necessary Cookies', 'ntronica'),
		'desc'     => esc_html__('These cookies are necessary for the website to function and cannot be switched off. They are set in response to your actions, like preferences or logging in. You can block or alert them in your browser, but parts of the site may not work. They do not store personal data.', 'ntronica'),
		'locked'   => true,
		'checked'  => true,
	),
);
?>
<aside
	id="cookie-notice"
	class="cookie-notice"
	role="dialog"
	aria-label="<?php echo esc_attr__('Cookie notice', 'ntronica'); ?>"
	aria-modal="false"
	data-cookie-name="<?php echo esc_attr(NTRONICA_COOKIE_CONSENT); ?>"
	<?php echo $ntronica_has_consent ? 'hidden' : ''; ?>>
	<div class="container cookie-notice__inner">
		<div class="cookie-notice__panel cookie-notice__panel--default">
			<div class="row cookie-notice__default">
				<div class="col-12 col-xl-4 cookie-notice__intro">
					<p class="text-block-alternate cookie-notice__text">
						<strong><?php echo esc_html__('This site uses cookies to improve service.', 'ntronica'); ?></strong>
						<?php echo esc_html__('Click to agree, personalize your experience and make your future visit even better', 'ntronica'); ?>
					</p>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<button class="btn btn--white" type="button" data-cookie-manage aria-expanded="false" aria-controls="cookie-notice-manage">
						<?php echo esc_html__('Manage cookies', 'ntronica'); ?>
					</button>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<button class="btn btn--white" type="button" data-cookie-accept>
						<?php echo esc_html__('Accept all', 'ntronica'); ?>
					</button>
				</div>
			</div>
		</div>

		<div class="cookie-notice__panel cookie-notice__panel--manage" id="cookie-notice-manage" hidden>
			<button class="cookie-notice__close" type="button" data-cookie-close>
				<span class="screen-reader-text"><?php echo esc_html__('Close cookie settings', 'ntronica'); ?></span>
				<svg class="icon icon--close" aria-hidden="true" focusable="false" viewBox="0 0 19 19" fill="none">
					<path
						d="M2.5 2.5L16.5 16.5M2.5 16.5L16.5 2.5"
						stroke="currentColor" />
				</svg>
			</button>

			<div class="row cookie-notice__manage-head">
				<div class="col-12 col-md-8 col-lg-6 col-xxl-4">
					<h2 class="cookie-notice__title" id="cookie-notice-title"><?php echo esc_html__('Manage cookie preferences', 'ntronica'); ?></h2>
					<p class="text-block-alternate cookie-notice__lead">
						<?php echo esc_html__('Configure cookie settings and confirm to save your settings. You can change consent at any time on our cookie consent page', 'ntronica'); ?>
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
					<button class="btn btn--white" type="button" data-cookie-confirm>
						<?php echo esc_html__('Confirm', 'ntronica'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</aside>