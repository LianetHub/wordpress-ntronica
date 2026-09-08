<?php

/**
 * About: Technological processes / solutions
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';

$ntronica_solutions = array(
	array(
		'title' => 'Thin films equipment',
		'image' => $ntronica_about_img . 'thin-films.webp',
		'alt'   => 'Thin films equipment',
	),
	array(
		'title' => 'Wet process equipment',
		'image' => $ntronica_about_img . 'wet-process.webp',
		'alt'   => 'Wet process equipment',
	),
	array(
		'title' => 'Process control',
		'image' => $ntronica_about_img . 'process-control.webp',
		'alt'   => 'Process control',
	),
);
?>
<section class="about-solutions" id="solutions">
	<div class="container">
		<div class="row about-solutions__intro">
			<div class="col-sm-6">
				<h2 class="about-solutions__lead">We develop and manufacture solutions for the following technological processes.</h2>
			</div>
		</div>

		<ul class="row about-solutions__grid">
			<?php foreach ($ntronica_solutions as $ntronica_item) : ?>
				<li class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'     => $ntronica_item['title'],
							'image'     => $ntronica_item['image'],
							'image_alt' => $ntronica_item['alt'],
						)
					);
					?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>