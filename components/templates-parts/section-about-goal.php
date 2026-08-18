<?php

/**
 * About: Our goal
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="about-goal" id="goal">
	<div class="container">
		<div class="row about-goal__layout">
			<div class="col-12 col-md-6">
				<h2 class="title about-goal__title">Our goal</h2>
				<div class="text-block about-goal__text">
					<p>We're here to help our customers solve their toughest technological challenges, whether in a lab or a fab.</p>
					<p>It's a thrilling journey, and to unlock its full potential, we actively seek partnerships that lift everyone.</p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="about-goal__media">
					<img
						class="about-goal__img"
						src="<?php echo esc_url($ntronica_about_img . 'goal.webp'); ?>"
						alt="Laboratory equipment"
						loading="lazy"
						width="945"
						height="515">
				</div>
			</div>
		</div>
	</div>
</section>