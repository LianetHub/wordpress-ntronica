<?php

/**
 * About: Our goal — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title = get_field('about_goal_title');
$ntronica_text  = get_field('about_goal_text');
$ntronica_image = get_field('about_goal_image');

$ntronica_title = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_text  = is_string($ntronica_text) && '' !== $ntronica_text ? $ntronica_text : '';
$ntronica_image = is_string($ntronica_image) && '' !== $ntronica_image ? $ntronica_image : IMG_PATH . '/about/goal.webp';
?>
<section class="about-goal" id="goal">
	<div class="container">
		<div class="row about-goal__layout">
			<div class="col-12 col-md-6">
				<h2 class="title about-goal__title"><?php echo esc_html($ntronica_title); ?></h2>
				<div class="text-block about-goal__text">
					<p><?php echo esc_html($ntronica_text); ?></p>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<div class="about-goal__media">
					<img
						class="about-goal__img"
						src="<?php echo esc_url($ntronica_image); ?>"
						alt="Laboratory equipment"
						loading="lazy"
						width="945"
						height="515">
				</div>
			</div>
		</div>
	</div>
</section>