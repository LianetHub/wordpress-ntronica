<?php

/**
 * About: Technological processes / solutions — powered by ACF
 *
 * @package ntronica
 */

$ntronica_lead  = get_field('about_solutions_lead');
$ntronica_items = get_field('about_solutions_items');

$ntronica_lead  = is_string($ntronica_lead) && '' !== $ntronica_lead ? $ntronica_lead : 'We develop and manufacture solutions for the following technological processes.';
$ntronica_items = is_array($ntronica_items) ? $ntronica_items : array();
?>
<section class="about-solutions" id="solutions">
	<div class="container">
		<div class="row about-solutions__intro">
			<div class="col-md-6">
				<h2 class="about-solutions__lead"><?php echo esc_html($ntronica_lead); ?></h2>
			</div>
		</div>

		<ul class="row about-solutions__grid">
			<?php foreach ($ntronica_items as $ntronica_item) : ?>
				<?php
				$ntronica_title = isset($ntronica_item['title']) && is_string($ntronica_item['title']) ? $ntronica_item['title'] : '';
				$ntronica_url   = isset($ntronica_item['url']) && is_string($ntronica_item['url']) ? $ntronica_item['url'] : '';
				$ntronica_image = isset($ntronica_item['image']) && is_string($ntronica_item['image']) ? $ntronica_item['image'] : '';
				$ntronica_alt   = isset($ntronica_item['alt']) && is_string($ntronica_item['alt']) ? $ntronica_item['alt'] : $ntronica_title;
				?>
				<?php if ('' !== $ntronica_title && '' !== $ntronica_url) : ?>
				<li class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'     => $ntronica_title,
							'url'       => $ntronica_url,
							'image'     => $ntronica_image,
							'image_alt' => $ntronica_alt,
						)
					);
					?>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
</section>