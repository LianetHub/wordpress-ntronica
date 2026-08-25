<?php

/**
 * Section: Immediate vacancies (Swiper grid)
 *
 * @package ntronica
 */

$vacancies = array(
	array(
		'title' => 'Operation specialist',
		'dept'  => 'Human Resources',
	),
	array(
		'title' => 'Strategy manager',
		'dept'  => 'Projects, Programs and Change',
	),
	array(
		'title' => 'Operation specialist',
		'dept'  => 'Human Resources',
	),
	array(
		'title' => 'Production engineer',
		'dept'  => 'Manufacturing',
	),
	array(
		'title' => 'Senior scientist',
		'dept'  => 'Research and Technology Development',
	),
	array(
		'title' => 'Production engineer',
		'dept'  => 'Manufacturing',
	),
	array(
		'title' => 'Production engineer',
		'dept'  => 'Human Resources',
	),
	array(
		'title' => 'Strategy manager',
		'dept'  => 'Projects, Programs and Change',
	),
	array(
		'title' => 'Operation specialist',
		'dept'  => 'Human Resources',
	),
	array(
		'title' => 'Production engineer',
		'dept'  => 'Manufacturing',
	),
	array(
		'title' => 'Senior scientist',
		'dept'  => 'Research and Technology Development',
	),
);

?>
<section class="vacancies band-full" id="careers">
	<div class="container">
		<h2 class="title vacancies__title">
			Immediate vacancies
		</h2>

		<div class="swiper vacancies-slider">
			<div class="swiper-wrapper">
				<?php foreach ($vacancies as $ntronica_item) : ?>
					<div class="swiper-slide">
						<a href="" class="vacancy-card">
							<span class="vacancy-card__title subtitle"><?php echo esc_html($ntronica_item['title']); ?></span>
							<span class="vacancy-card__dept text-lead"><?php echo esc_html($ntronica_item['dept']); ?></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="vacancies__nav">
				<button
					type="button"
					class="swiper-button-prev vacancies__arrow--prev"
					aria-label="Previous vacancies"></button>
				<button
					type="button"
					class="swiper-button-next vacancies__arrow--next"
					aria-label="Next vacancies"></button>
			</div>
		</div>
	</div>
</section>