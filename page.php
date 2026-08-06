<?php
/**
 * Default page template
 *
 * @package ntronica
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="_container">
		<h1><?php the_title(); ?></h1>
		<div class="page__content">
			<?php the_content(); ?>
		</div>
	</div>
	<?php
endwhile;

get_footer();
