<?php
/**
 * 404 template
 *
 * @package ntronica
 */

get_header();
?>

<section class="section-error content-rail" aria-label="<?php esc_attr_e( 'Error 404', 'ntronica' ); ?>">
	<div class="content-rail__inner">
		<div class="section-error__top">
			<p class="section-error__crumb"><?php esc_html_e( 'About — Error 404', 'ntronica' ); ?></p>
			<a class="section-error__lang" href="#"><?php esc_html_e( 'ru', 'ntronica' ); ?></a>
		</div>

		<div class="row section-error__body">
			<div class="col-12 col-md-6">
				<h1 class="section-error__title"><?php esc_html_e( 'Error 404', 'ntronica' ); ?></h1>
				<p class="section-error__text">
					<?php esc_html_e( 'Sorry, we can’t find the page you are looking for. It may have been moved, deleted or the address may be incorrect', 'ntronica' ); ?>
				</p>
				<a class="link-more section-error__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span><?php esc_html_e( 'BACK TO HOMEPAGE', 'ntronica' ); ?></span>
					<span class="link-more__arrow" aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
