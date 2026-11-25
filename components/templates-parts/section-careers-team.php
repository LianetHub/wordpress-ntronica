<?php

/**
 * Careers: Our team — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title   = get_field('careers_team_title');
$ntronica_tagline = get_field('careers_team_tagline');
$ntronica_text    = get_field('careers_team_text');

$ntronica_title   = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_tagline = is_string($ntronica_tagline) && '' !== $ntronica_tagline ? $ntronica_tagline : '';
$ntronica_text    = is_string($ntronica_text) && '' !== $ntronica_text ? $ntronica_text : '';

$ntronica_paragraphs = explode("\n", str_replace(array("\r\n", "\r"), "\n", $ntronica_text));
?>
<section class="careers-team" id="team">
	<div class="container">
		<h2 class="title careers-team__title"><?php echo esc_html($ntronica_title); ?></h2>

		<div class="row careers-team__grid">
			<div class="col-12 col-md-6">
				<div class="text-block careers-team__tagline">
					<p><?php echo esc_html($ntronica_tagline); ?></p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="text-block-alternate careers-team__text">
					<?php foreach ($ntronica_paragraphs as $ntronica_paragraph) : ?>
						<?php $ntronica_paragraph = trim($ntronica_paragraph); ?>
						<?php if ('' !== $ntronica_paragraph) : ?>
						<p><?php echo esc_html($ntronica_paragraph); ?></p>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
