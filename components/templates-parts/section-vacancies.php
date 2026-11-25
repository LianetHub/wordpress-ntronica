<?php

/**
 * Section: Open positions — powered by WP_Query
 *
 * @package ntronica
 */

$ntronica_title = get_field('careers_vacancies_title');
$ntronica_title = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';

$ntronica_query = new WP_Query(array(
	'post_type'      => 'vacancy',
	'posts_per_page' => -1,
	'orderby'        => 'date',
	'order'          => 'DESC',
));
?>
<section class="vacancies" id="careers">
	<div class="container">
		<h2 class="title vacancies__title">
			<?php echo esc_html($ntronica_title); ?>
		</h2>

		<?php if ($ntronica_query->have_posts()) : ?>
		<div class="row vacancies__grid">
			<?php while ($ntronica_query->have_posts()) : $ntronica_query->the_post(); ?>
				<div class="col-12 col-md-4">
					<a href="<?php the_permalink(); ?>" class="vacancy-card">
						<span class="text-block vacancy-card__date"><?php echo esc_html(get_the_date()); ?></span>
						<span class="subtitle vacancy-card__title"><?php the_title(); ?></span>
						<span class="text-lead vacancy-card__excerpt"><?php echo esc_html(get_field('vacancy_excerpt')); ?></span>
					</a>
				</div>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>

		<?php wp_reset_postdata(); ?>
	</div>
</section>
