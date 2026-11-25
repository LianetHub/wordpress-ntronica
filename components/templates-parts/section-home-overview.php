<?php

/**
 * Home: Company overview — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title       = get_field('overview_title');
$ntronica_intro       = get_field('overview_intro');
$ntronica_link_url    = get_field('overview_link_url');
$ntronica_link_text   = get_field('overview_link_text');
$ntronica_subtitle    = get_field('overview_subtitle');
$ntronica_features    = get_field('overview_features');

$ntronica_title    = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_intro    = is_string($ntronica_intro) ? $ntronica_intro : '';
$ntronica_link_url = is_string($ntronica_link_url) && '' !== $ntronica_link_url ? $ntronica_link_url : '';
$ntronica_link_text = is_string($ntronica_link_text) && '' !== $ntronica_link_text ? $ntronica_link_text : '';
$ntronica_subtitle = is_string($ntronica_subtitle) && '' !== $ntronica_subtitle ? $ntronica_subtitle : '';
?>
<section class="overview" id="overview">
	<div class="container">
		<div class="row overview__layout">
			<div class="col-12 col-md-6 overview__summary">
				<h2 class="title overview__title"><?php echo esc_html($ntronica_title); ?></h2>
				<?php if ('' !== $ntronica_intro) : ?>
				<div class="text-block overview__intro">
					<p><?php echo esc_html($ntronica_intro); ?></p>
				</div>
				<?php endif; ?>
				<div class="overview__more">
					<a class="link-more" href="<?php echo esc_url($ntronica_link_url); ?>" data-title="<?php echo esc_attr($ntronica_link_text); ?>">
						<span><?php echo esc_html($ntronica_link_text); ?></span>
					</a>
				</div>
			</div>

			<div class="col-12 col-md-6 overview__details">
				<p class="subtitle fs-italic overview__subtitle"><?php echo esc_html($ntronica_subtitle); ?></p>
				<?php if (! empty($ntronica_features) && is_array($ntronica_features)) : ?>
				<ul class="overview__features feature-list">
					<?php foreach ($ntronica_features as $ntronica_feature) : ?>
						<?php $ntronica_text = isset($ntronica_feature['text']) ? (string) $ntronica_feature['text'] : ''; ?>
						<?php if ('' !== $ntronica_text) : ?>
						<li><?php echo esc_html($ntronica_text); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="overview__more overview__more--mobile">
			<a class="link-more" href="<?php echo esc_url($ntronica_link_url); ?>" data-title="<?php echo esc_attr($ntronica_link_text); ?>">
				<span><?php echo esc_html($ntronica_link_text); ?></span>
			</a>
		</div>
	</div>
</section>
