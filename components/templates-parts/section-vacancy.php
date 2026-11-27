<?php

/**
 * Single vacancy: hero facts and two lists
 *
 * @package ntronica
 */

$ntronica_facts = array(
	array(
		'label' => ntronica_ui_text('TEAM'),
		'value' => get_field('vacancy_team'),
	),
	array(
		'label' => ntronica_ui_text('WORK EXPERIENCE'),
		'value' => get_field('vacancy_experience'),
	),
	array(
		'label' => ntronica_ui_text('EDUCATION BACKGROUND'),
		'value' => get_field('vacancy_education'),
	),
);

$ntronica_lists = array(
	array(
		'title' => ntronica_ui_text('Responsibilities'),
		'items' => get_field('vacancy_responsibilities'),
	),
	array(
		'title' => ntronica_ui_text('Requirements'),
		'items' => get_field('vacancy_requirements'),
	),
);
?>
<article class="vacancy">
	<div class="vacancy__hero">
		<div class="container">
			<h1 class="title vacancy__title"><?php the_title(); ?></h1>

			<ul class="row vacancy__facts">
				<?php foreach ($ntronica_facts as $ntronica_fact) : ?>
					<?php
					$ntronica_value = isset($ntronica_fact['value']) && is_string($ntronica_fact['value']) && '' !== $ntronica_fact['value']
						? $ntronica_fact['value']
						: '';
					?>
					<?php if ('' !== $ntronica_value) : ?>
						<li class="col-12 col-md-4">
							<p class="text-block vacancy__label"><?php echo esc_html($ntronica_fact['label']); ?></p>
							<p class="text-block vacancy__value"><?php echo esc_html($ntronica_value); ?></p>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<div class="vacancy__body">
		<div class="container">
			<div class="row vacancy__lists">
				<?php foreach ($ntronica_lists as $ntronica_list) : ?>
					<?php $ntronica_items = is_array($ntronica_list['items']) ? $ntronica_list['items'] : array(); ?>
					<?php if (! empty($ntronica_items)) : ?>
						<div class="col-12 col-md-6">
							<h2 class="subtitle fs-italic vacancy__subtitle"><?php echo esc_html($ntronica_list['title']); ?></h2>
							<ul class="feature-list">
								<?php foreach ($ntronica_items as $ntronica_item) : ?>
									<?php
									$ntronica_text = isset($ntronica_item['text']) && is_string($ntronica_item['text'])
										? $ntronica_item['text']
										: '';
									?>
									<?php if ('' !== $ntronica_text) : ?>
										<li><?php echo esc_html($ntronica_text); ?></li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</article>