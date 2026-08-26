<?php

/**
 * Template Name: Policy page
 *
 * Shared utility layout (404 / search / policy).
 *
 * @package ntronica
 */

get_header();

while (have_posts()) :
	the_post();
?>
	<section class="utility" aria-label="<?php echo esc_attr(get_the_title()); ?>">
		<div class="container">
			<h1 class="title-md utility__title"><?php the_title(); ?></h1>
			<div class="text-block utility__content">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
<?php
endwhile;

get_footer();
