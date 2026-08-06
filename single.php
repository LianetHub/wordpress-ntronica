<?php
/**
 * Single post template
 *
 * @package ntronica
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="_container">
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	</div>
	<?php
endwhile;

get_footer();
