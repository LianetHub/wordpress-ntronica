<?php
/**
 * Section: Immediate vacancies (Swiper)
 *
 * Pages: 4 cards (<768) / 6 cards (≥768). Built in JS from data-vacancies.
 *
 * @package ntronica
 */

$vacancies = array(
	array(
		'title' => 'Leading specialist of chemical processing equipment',
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
);
?>
<section class="section-vacancies band-full" id="careers">
	<div class="container">
		<h2 class="section-title section-title--light section-vacancies__title">
			Immediate vacancies
		</h2>

		<div
			class="swiper vacancies-slider section-vacancies__slider"
			data-vacancies="<?php echo esc_attr( wp_json_encode( $vacancies ) ); ?>"
		>
			<div class="swiper-wrapper"></div>

			<div class="section-vacancies__nav section-vacancies__nav--hidden">
				<button type="button" class="section-vacancies__arrow section-vacancies__arrow--prev" aria-label="Previous vacancies">←</button>
				<button type="button" class="section-vacancies__arrow section-vacancies__arrow--next" aria-label="Next vacancies">→</button>
			</div>
		</div>
	</div>
</section>
