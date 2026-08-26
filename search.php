<?php

/**
 * Search results
 *
 * @package ntronica
 */

get_header();

// mock results 
$ntronica_mock_excerpt = 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation';
$ntronica_mock_results = array_fill(0, 6, array(
	'title'   => 'Lorem ipsum dolor',
	'excerpt' => $ntronica_mock_excerpt,
	'url'     => '#',
));
$ntronica_found = count($ntronica_mock_results);
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

		<?php if ($ntronica_mock_results) : ?>
			<div class="row utility__results">
				<?php foreach ($ntronica_mock_results as $ntronica_result) : ?>
					<div class="col-12 col-md-6 col-xl-4">
						<a class="search-card" href="<?php echo esc_url($ntronica_result['url']); ?>">
							<span class="search-card__title subtitle"><?php echo esc_html($ntronica_result['title']); ?></span>
							<span class="search-card__excerpt text-lead"><?php echo esc_html($ntronica_result['excerpt']); ?></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<p class="utility__empty text-lead">Nothing found.</p>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
