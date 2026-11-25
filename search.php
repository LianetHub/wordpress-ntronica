<?php

/**
 * Search results
 *
 * @package ntronica
 */

get_header();

$ntronica_query   = get_search_query();
$ntronica_results = new WP_Query(array(
	's'              => $ntronica_query,
	'posts_per_page' => -1,
));
$ntronica_found   = $ntronica_results->have_posts() ? $ntronica_results->post_count : 0;
?>

<section class="utility" aria-label="Search">
	<div class="container">
		<h1 class="title-md utility__title">Search</h1>

		<div class="utility__form">
			<?php get_search_form(array('ntronica_variant' => 'page')); ?>
		</div>

		<p class="text-block utility__count">
			<span>RESULTS: </span>
			<strong><?php echo esc_html((string) $ntronica_found); ?></strong>
		</p>

		<?php if ($ntronica_results->have_posts()) : ?>
			<div class="row utility__results">
				<?php while ($ntronica_results->have_posts()) : $ntronica_results->the_post(); ?>
					<div class="col-12 col-md-6 col-xl-4">
						<a class="search-card" href="<?php the_permalink(); ?>">
							<span class="search-card__title subtitle"><?php the_title(); ?></span>
							<span class="search-card__excerpt text-leap"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30, '…')); ?></span>
						</a>
					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="utility__empty text-lead">Nothing found.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
