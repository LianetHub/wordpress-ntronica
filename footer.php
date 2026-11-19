<?php

/**
 * Footer — powered by ACF
 *
 * @package ntronica
 */

$ntronica_email_1       = get_field('ntronica_footer_email_1', 'option');
$ntronica_email_2       = get_field('ntronica_footer_email_2', 'option');
$ntronica_phone         = get_field('ntronica_footer_phone', 'option');
$ntronica_website       = get_field('ntronica_footer_website', 'option');
$ntronica_address       = get_field('ntronica_footer_address', 'option');
$ntronica_privacy_url   = get_field('ntronica_footer_privacy_url', 'option');
$ntronica_terms_url     = get_field('ntronica_footer_terms_url', 'option');

$ntronica_email_1     = is_string($ntronica_email_1) && '' !== $ntronica_email_1 ? $ntronica_email_1 : 'contact@ntronica.com';
$ntronica_email_2     = is_string($ntronica_email_2) && '' !== $ntronica_email_2 ? $ntronica_email_2 : 'business@ntronica.com';
$ntronica_phone       = is_string($ntronica_phone) && '' !== $ntronica_phone ? $ntronica_phone : '+91 221-234-5678';
$ntronica_website     = is_string($ntronica_website) && '' !== $ntronica_website ? $ntronica_website : 'https://www.ntronica.com';
$ntronica_privacy_url = is_string($ntronica_privacy_url) && '' !== $ntronica_privacy_url ? $ntronica_privacy_url : home_url('/privacy-policy/');
$ntronica_terms_url   = is_string($ntronica_terms_url) && '' !== $ntronica_terms_url ? $ntronica_terms_url : home_url('/terms-of-use/');

$ntronica_address_lines = array();
if (is_string($ntronica_address) && '' !== $ntronica_address) {
	$ntronica_address_lines = explode("\n", str_replace(array("\r\n", "\r"), "\n", $ntronica_address));
}
?>
</main>
<footer class="footer">
	<div class="container">
		<div class="row footer__grid g-4">
			<div class="col-12 col-xxl-3 footer__copy">
				<div class="row">
					<div class="col-12 col-md-4 col-xxl-12">
						<p class="footer__year">Copyright (c) 2025-2026</p>
					</div>
					<div class="col-12 col-md-8 col-xxl-12">
						<p class="footer__company">Nanotronica India
							<span class="footer__company--desktop-text">Private Limited Company</span>
							<span class="footer__company--tablet-text">Pvt Ltd</span>
							<span class="footer__company--mobile-text">Private Limited</span>
						</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<ul class="feature-list">
					<li data-label="Mail" data-label-short="Eml">
						<a href="mailto:<?php echo esc_attr($ntronica_email_1); ?>"><?php echo esc_html($ntronica_email_1); ?></a><br>
						<a href="mailto:<?php echo esc_attr($ntronica_email_2); ?>"><?php echo esc_html($ntronica_email_2); ?></a>
					</li>
					<li data-label="Tel">
						<a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $ntronica_phone)); ?>"><?php echo esc_html($ntronica_phone); ?></a>
					</li>
					<li data-label="Web">
						<a href="<?php echo esc_url($ntronica_website); ?>"><?php echo esc_html(preg_replace('#^https?://#', '', $ntronica_website)); ?></a>
					</li>
				</ul>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<?php if (! empty($ntronica_address_lines)) : ?>
				<address class="footer__address" data-label="Add">
					<?php foreach ($ntronica_address_lines as $ntronica_line) : ?>
						<?php $ntronica_line = trim($ntronica_line); ?>
						<?php if ('' !== $ntronica_line) : ?>
						<span><?php echo esc_html($ntronica_line); ?></span>
						<?php endif; ?>
					<?php endforeach; ?>
				</address>
				<?php endif; ?>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<div class="footer__links">
					<div class="footer__search">
						<?php get_search_form(array('ntronica_variant' => 'footer')); ?>
					</div>
					<div class="footer__policies">
						<a class="footer__link" href="<?php echo esc_url($ntronica_privacy_url); ?>">Privacy policy</a>
						<a class="footer__link" href="<?php echo esc_url($ntronica_terms_url); ?>">Terms of use</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div><!-- .site-body -->
</div><!-- .wrapper -->
<?php get_template_part('components/templates-parts/cookie-notice'); ?>
<?php wp_footer(); ?>
</body>

</html>
