<?php

/**
 * Section: Company information — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title     = get_field('ntronica_info_title', 'option');
$ntronica_text      = get_field('ntronica_info_text', 'option');
$ntronica_email_1   = get_field('ntronica_info_email_1', 'option');
$ntronica_email_2   = get_field('ntronica_info_email_2', 'option');
$ntronica_phone     = get_field('ntronica_info_phone', 'option');
$ntronica_address   = get_field('ntronica_info_address', 'option');
$ntronica_cin       = get_field('ntronica_info_cin', 'option');

$ntronica_title   = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_text    = is_string($ntronica_text) ? $ntronica_text : '';
$ntronica_email_1 = is_string($ntronica_email_1) && '' !== $ntronica_email_1 ? $ntronica_email_1 : '';
$ntronica_email_2 = is_string($ntronica_email_2) && '' !== $ntronica_email_2 ? $ntronica_email_2 : '';
$ntronica_phone   = is_string($ntronica_phone) && '' !== $ntronica_phone ? $ntronica_phone : '';
$ntronica_address = is_string($ntronica_address) && '' !== $ntronica_address ? $ntronica_address : '';
$ntronica_cin     = is_string($ntronica_cin) && '' !== $ntronica_cin ? $ntronica_cin : '';
?>
<section class="info" id="about">
	<div class="container">
		<h2 class="title info__title"><?php echo esc_html($ntronica_title); ?></h2>

		<div class="row info__grid">
			<div class="col-12 col-md-6">
				<?php if ('' !== $ntronica_text) : ?>
				<div class="text-block info__text">
					<p><?php echo esc_html($ntronica_text); ?></p>
				</div>
				<?php endif; ?>
			</div>

			<div class="col-12 col-md-6">
				<ul class="info__list feature-list">
					<li data-label="Mail">
						<a href="mailto:<?php echo esc_attr($ntronica_email_1); ?>"><?php echo esc_html($ntronica_email_1); ?></a><br>
						<a href="mailto:<?php echo esc_attr($ntronica_email_2); ?>"><?php echo esc_html($ntronica_email_2); ?></a>
					</li>
					<li data-label="Tel">
						<a href="tel:<?php echo esc_attr(preg_replace('/[^\d+]/', '', $ntronica_phone)); ?>"><?php echo esc_html($ntronica_phone); ?></a>
					</li>
					<?php if ('' !== $ntronica_address) : ?>
					<li data-label="Add">
						<address><?php echo esc_html($ntronica_address); ?></address>
					</li>
					<?php endif; ?>
					<?php if ('' !== $ntronica_cin) : ?>
					<li data-label="CIN"><?php echo esc_html($ntronica_cin); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
