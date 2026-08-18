<?php

/**
 * Search results
 *
 * @package ntronica
 */

get_header();

global $wp_query;
$ntronica_found = isset($wp_query->found_posts) ? (int) $wp_query->found_posts : 0;
?>

<section class="search" aria-label="Search">
	<div class="container">
		<h1 class="search__title">Search</h1>

		<div class="search__form">
			<?php get_search_form(array('ntronica_variant' => 'page')); ?>
		</div>

		<p class="search__count">
			<span>RESULTS: </span>
			<strong><?php echo esc_html((string) $ntronica_found); ?></strong>
		</p>

		<?php if (have_posts()) : ?>
			<div class="row search__results">
				<?php
				while (have_posts()) :
					the_post();
					$ntronica_excerpt = wp_trim_words(get_the_excerpt(), 28, '…');
				?>
					<div class="col-12 col-md-6 col-xl-4">
						<article class="search-card">
							<h2 class="search-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if ($ntronica_excerpt) : ?>
								<p class="search-card__excerpt"><?php echo esc_html($ntronica_excerpt); ?></p>
							<?php endif; ?>
						</article>
					</div>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<p class="search__empty">Nothing found.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
