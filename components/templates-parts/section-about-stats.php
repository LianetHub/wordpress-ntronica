<?php

/**
 * About: About us / stats
 *
 * @package ntronica
 */

$ntronica_title       = get_field('about_stats_title');
$ntronica_text_left   = get_field('about_stats_text_left');
$ntronica_text_right  = get_field('about_stats_text_right');
$ntronica_stats_items = get_field('about_stats_items');

$ntronica_title       = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_text_left   = is_string($ntronica_text_left) && '' !== $ntronica_text_left ? $ntronica_text_left : '';
$ntronica_text_right  = is_string($ntronica_text_right) && '' !== $ntronica_text_right ? $ntronica_text_right : '';
$ntronica_stats_items = is_array($ntronica_stats_items) ? $ntronica_stats_items : array();

$ntronica_left_paragraphs = explode("\n", str_replace(array("\r\n", "\r"), "\n", $ntronica_text_left));
?>
<section class="about-stats" id="about-us">
	<div class="container">
		<h2 class="title about-stats__title"><?php echo esc_html($ntronica_title); ?></h2>

		<div class="row about-stats__intro">
			<div class="col-12 col-md-6">
				<div class="text-block about-stats__text">
					<?php foreach ($ntronica_left_paragraphs as $ntronica_paragraph) : ?>
						<?php $ntronica_paragraph = trim($ntronica_paragraph); ?>
						<?php if ('' !== $ntronica_paragraph) : ?>
						<p><?php echo esc_html($ntronica_paragraph); ?></p>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<p class="text-block-alternate"><?php echo esc_html($ntronica_text_right); ?></p>
			</div>
		</div>

		<?php if (! empty($ntronica_stats_items)) : ?>
		<ul class="row about-stats__grid">
			<?php foreach ($ntronica_stats_items as $ntronica_stat) : ?>
				<?php
				$ntronica_value = isset($ntronica_stat['value']) && is_string($ntronica_stat['value']) ? $ntronica_stat['value'] : '';
				$ntronica_label = isset($ntronica_stat['label']) && is_string($ntronica_stat['label']) ? $ntronica_stat['label'] : '';
				?>
				<?php if ('' !== $ntronica_value && '' !== $ntronica_label) : ?>
				<li class="col-6 col-md-3">
					<p class="about-stats__value"><?php echo esc_html($ntronica_value); ?></p>
					<p class="about-stats__label subtitle"><?php echo esc_html($ntronica_label); ?></p>
				</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
</section>