<?php
/**
 * 404 template
 *
 * @package ntronica
 */

get_header();
?>

<section class="section-error" aria-label="Error 404">
	<div class="container">
		<div class="section-error__top">
			<p class="section-error__crumb">About — Error 404</p>
			<a class="section-error__lang" href="#">ru</a>
		</div>

		<div class="row section-error__body">
			<div class="col-12 col-md-6">
				<h1 class="section-error__title">Error 404</h1>
				<p class="section-error__text">
					Sorry, we can’t find the page you are looking for. It may have been moved, deleted or the address may be incorrect
				</p>
				<a class="link-more section-error__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span>BACK TO HOMEPAGE</span>
					<span class="link-more__arrow" aria-hidden="true">→</span>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
