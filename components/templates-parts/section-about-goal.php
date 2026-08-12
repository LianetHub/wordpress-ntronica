<?php
/**
 * About: Our goal
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="section-about-goal content-rail" id="goal">
	<div class="content-rail__inner">
		<div class="row section-about-goal__layout">
			<div class="col-12 col-md-6">
				<h2 class="section-title section-about-goal__title"><?php esc_html_e( 'Our goal', 'ntronica' ); ?></h2>
				<div class="section-about-goal__text">
					<p><?php esc_html_e( "We're here to help our customers solve their toughest technological challenges, whether in a lab or a fab.", 'ntronica' ); ?></p>
					<p><?php esc_html_e( "It's a thrilling journey, and to unlock its full potential, we actively seek partnerships that lift everyone.", 'ntronica' ); ?></p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="section-about-goal__media">
					<img
						class="section-about-goal__img"
						src="<?php echo esc_url( $ntronica_about_img . 'goal.png' ); ?>"
						alt="<?php esc_attr_e( 'Laboratory equipment', 'ntronica' ); ?>"
						width="945"
						height="515"
					>
				</div>
			</div>
		</div>
	</div>
</section>
