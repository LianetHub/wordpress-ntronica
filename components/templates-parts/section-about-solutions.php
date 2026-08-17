<?php

/**
 * About: Technological processes / solutions
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="about-solutions" id="solutions">
	<div class="container">
		<div class="row about-solutions__intro">
			<div class="col-6">
				<h2 class="about-solutions__lead">We develop and manufacture solutions for the following technological processes.</h2>
			</div>
		</div>

		<ul class="row about-solutions__grid">
			<li class="col-12 col-md-4 about-solutions__item">
				<div class="about-solutions__media">
					<img
						class="about-solutions__img"
						src="<?php echo esc_url($ntronica_about_img . 'thin-films.webp'); ?>"
						alt="Thin films equipment"
						width="622"
						height="412"
						loading="lazy">
				</div>
				<h3 class="about-solutions__caption">Thin films equipment</h3>
			</li>

			<li class="col-12 col-md-4 about-solutions__item">
				<div class="about-solutions__media">
					<img
						class="about-solutions__img"
						src="<?php echo esc_url($ntronica_about_img . 'wet-process.webp'); ?>"
						alt="Wet process equipment"
						width="622"
						height="413"
						loading="lazy">
				</div>
				<h3 class="about-solutions__caption">Wet process equipment</h3>
			</li>

			<li class="col-12 col-md-4 about-solutions__item">
				<div class="about-solutions__media">
					<img
						class="about-solutions__img"
						src="<?php echo esc_url($ntronica_about_img . 'process-control.webp'); ?>"
						alt="Process control"
						width="622"
						height="413"
						loading="lazy">
				</div>
				<h3 class="about-solutions__caption">Process control</h3>
			</li>
		</ul>
	</div>
</section>