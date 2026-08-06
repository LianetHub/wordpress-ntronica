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
		'title' => __( 'Leading specialist of chemical processing equipment', 'ntronica' ),
		'dept'  => __( 'Human Resources', 'ntronica' ),
	),
	array(
		'title' => __( 'Strategy manager', 'ntronica' ),
		'dept'  => __( 'Projects, Programs and Change', 'ntronica' ),
	),
	array(
		'title' => __( 'Operation specialist', 'ntronica' ),
		'dept'  => __( 'Human Resources', 'ntronica' ),
	),
	array(
		'title' => __( 'Production engineer', 'ntronica' ),
		'dept'  => __( 'Manufacturing', 'ntronica' ),
	),
	array(
		'title' => __( 'Senior scientist', 'ntronica' ),
		'dept'  => __( 'Research and Technology Development', 'ntronica' ),
	),
	array(
		'title' => __( 'Production engineer', 'ntronica' ),
		'dept'  => __( 'Manufacturing', 'ntronica' ),
	),
	array(
		'title' => __( 'Operation specialist', 'ntronica' ),
		'dept'  => __( 'Human Resources', 'ntronica' ),
	),
	array(
		'title' => __( 'Strategy manager', 'ntronica' ),
		'dept'  => __( 'Projects, Programs and Change', 'ntronica' ),
	),
	array(
		'title' => __( 'Operation specialist', 'ntronica' ),
		'dept'  => __( 'Human Resources', 'ntronica' ),
	),
	array(
		'title' => __( 'Production engineer', 'ntronica' ),
		'dept'  => __( 'Manufacturing', 'ntronica' ),
	),
	array(
		'title' => __( 'Senior scientist', 'ntronica' ),
		'dept'  => __( 'Research and Technology Development', 'ntronica' ),
	),
);
?>
<section class="section-vacancies band-full" id="careers">
	<div class="band-full__inner">
		<h2 class="section-title section-title--light section-vacancies__title">
			<?php esc_html_e( 'Immediate vacancies', 'ntronica' ); ?>
		</h2>

		<div
			class="swiper vacancies-slider section-vacancies__slider"
			data-vacancies="<?php echo esc_attr( wp_json_encode( $vacancies ) ); ?>"
		>
			<div class="swiper-wrapper"></div>

			<div class="section-vacancies__nav section-vacancies__nav--hidden">
				<button type="button" class="section-vacancies__arrow section-vacancies__arrow--prev" aria-label="<?php esc_attr_e( 'Previous vacancies', 'ntronica' ); ?>">←</button>
				<button type="button" class="section-vacancies__arrow section-vacancies__arrow--next" aria-label="<?php esc_attr_e( 'Next vacancies', 'ntronica' ); ?>">→</button>
			</div>
		</div>
	</div>
</section>
