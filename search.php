<?php
/**
 * Search results
 *
 * @package ntronica
 */

get_header();
?>
<div class="container">
	<h1>
		<?php printf( 'Search results: %s', esc_html( get_search_query() ) ); ?>
	</h1>
	<?php if ( have_posts() ) : ?>
		<ul>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
	<?php else : ?>
		<p>Nothing found.</p>
	<?php endif; ?>
</div>
<?php
get_footer();
