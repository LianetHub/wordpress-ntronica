<?php
/**
 * 404 template
 *
 * @package ntronica
 */

get_header();
?>
<section class="error">
	<div class="error__container _container">
		<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumbs', 'ntronica' ); ?>">
			<ul class="breadcrumbs__list">
				<li class="breadcrumbs__item">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs__link"><?php esc_html_e( 'Home', 'ntronica' ); ?></a>
				</li>
				<li class="breadcrumbs__item breadcrumbs__item--last">
					<span class="breadcrumbs__current">404</span>
				</li>
			</ul>
		</nav>
		<div class="error__body">
			<div class="error__status">404</div>
			<h1 class="error__title">
				<span><?php esc_html_e( 'Error:', 'ntronica' ); ?></span>
				<?php esc_html_e( 'page not found', 'ntronica' ); ?>
			</h1>
			<p class="error__subtitle">
				<?php esc_html_e( 'The address is typed incorrectly, or such page does not exist on the site at present', 'ntronica' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error__btn btn">
				<?php esc_html_e( 'Go back to home page', 'ntronica' ); ?>
			</a>
		</div>
	</div>
</section>
<?php
get_footer();
