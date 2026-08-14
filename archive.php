<?php
/**
 * Archive template
 *
 * @package ntronica
 */

get_header();
?>
<div class="container">
	<h1><?php the_archive_title(); ?></h1>
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</article>
			<?php
		endwhile;
		the_posts_navigation();
		?>
	<?php else : ?>
		<p>Nothing found.</p>
	<?php endif; ?>
</div>
<?php
get_footer();
