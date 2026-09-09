<?php

/**
 * Technology: All about microchips
 *
 * @package ntronica
 */

$ntronica_topics = array_fill(
	0,
	4,
	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidlaoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'
);
?>
<section class="tech-microchips" id="microchips">
	<div class="container">
		<h2 class="title tech-microchips__title">All about microchips</h2>

		<div class="row tech-microchips__intro">
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing sit amet, consectetuer. Lorem ipsum dolor sit amet, consectetuer adipiscing sit.</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block-alternate">
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>There are two major ways to categorize microchips: by functionality and by type of integrated circuitry. In terms of circuitry, a chip can be analog, digital, or mixed. The difference between analog and digital function has to do with the electric signals they process. In digital chips, the signals are binary. In analog chips, the signals are continuous, meaning they can take on any value within a given range, and they use more traditional circuit elements (resistors, capacitors and occasionally inductors). In terms of functionality, there are four main categories: Logic chips, Memory chips, application-specific integrated chips (ASICs).</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>The two most common types of chips, Logic chips and Memory chips, are digital: they manipulate and store bits and bytes using transistors. ASICs and SoCs are mainly a mix of analog and digital. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonum.</p>
				</div>
			</div>
		</div>

		<div class="row tech-microchips__cards" id="lorem-ipsum">
			<?php foreach ($ntronica_topics as $ntronica_topic) : ?>
				<div class="col-12 col-md-6">
					<div class="tech-microchips__card">
						<h3 class="subtitle fs-italic tech-microchips__heading">Lorem ipsum sit amet</h3>
						<ul class="feature-list">
							<li><?php echo esc_html($ntronica_topic); ?></li>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>