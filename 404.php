<?php

/**
 * 404 template
 *
 * @package ntronica
 */

get_header();
?>

<section class="utility" aria-label="Error 404">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<h1 class="utility__title">Error 404</h1>
				<p class="text-block utility__text">
					Sorry, we can’t find the page you are looking for. It may have been moved, deleted or the address may be incorrect
				</p>
				<a class="link-more utility__link" href="<?php echo esc_url(home_url('/')); ?>" data-title="BACK TO HOMEPAGE">
					<span>BACK TO HOMEPAGE</span>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
