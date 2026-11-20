<?php

/**
 * About: Company overview — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title    = get_field('about_overview_title');
$ntronica_intro    = get_field('about_overview_intro');
$ntronica_subtitle = get_field('about_overview_subtitle');
$ntronica_features = get_field('about_overview_features');

$ntronica_title    = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : 'Company overview';
$ntronica_intro    = is_string($ntronica_intro) && '' !== $ntronica_intro ? $ntronica_intro : 'Every day at N-tronica, we create tools that enable the production of the chips powering our world. From large-scale manufacturing to advanced R&amp;D, our work helps accelerate innovation and bring new technologies to life faster. We take pride in contributing to devices that are faster, smarter, and more efficient.';
$ntronica_subtitle = is_string($ntronica_subtitle) && '' !== $ntronica_subtitle ? $ntronica_subtitle : 'Key features:';
$ntronica_features = is_array($ntronica_features) ? $ntronica_features : array();
?>
<section class="overview overview--about" id="overview">
	<div class="container">
		<div class="row overview__layout">
			<div class="col-12 col-md-6 overview__summary">
				<h2 class="title overview__title"><?php echo esc_html($ntronica_title); ?></h2>
				<div class="text-block overview__intro">
					<p><?php echo esc_html($ntronica_intro); ?></p>
				</div>
			</div>

			<div class="col-12 col-md-6 overview__details">
				<p class="subtitle fs-italic overview__subtitle"><?php echo esc_html($ntronica_subtitle); ?></p>
				<ul class="overview__features feature-list">
					<?php foreach ($ntronica_features as $ntronica_feature) : ?>
						<?php
						$ntronica_text = isset($ntronica_feature['text']) && is_string($ntronica_feature['text']) ? $ntronica_feature['text'] : '';
						?>
						<?php if ('' !== $ntronica_text) : ?>
						<li><?php echo esc_html($ntronica_text); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>