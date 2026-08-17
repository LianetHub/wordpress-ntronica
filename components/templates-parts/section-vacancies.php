<?php

/**
 * Section: Immediate vacancies (Swiper)
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

$ntronica_vacancy_pages = array_chunk($vacancies, 6);
$ntronica_vacancy_has_nav = count($ntronica_vacancy_pages) > 1;
?>
<section class="vacancies band-full" id="careers">
	<div class="container">
		<h2 class="title vacancies__title">
			Immediate vacancies
		</h2>

		<div class="swiper vacancies-slider vacancies__slider">
			<div class="swiper-wrapper">
				<?php foreach ($ntronica_vacancy_pages as $ntronica_page) : ?>
					<div class="swiper-slide">
						<div class="row vacancies__grid">
							<?php foreach ($ntronica_page as $ntronica_item) : ?>
								<div class="col-12 col-md-4">
									<article class="vacancy-card">
										<h3 class="vacancy-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
										<p class="vacancy-card__dept"><?php echo esc_html($ntronica_item['dept']); ?></p>
									</article>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ($ntronica_vacancy_has_nav) : ?>
				<div class="vacancies__nav">
					<button type="button" class="vacancies__arrow vacancies__arrow--prev" aria-label="Previous vacancies">←</button>
					<button type="button" class="vacancies__arrow vacancies__arrow--next" aria-label="Next vacancies">→</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>