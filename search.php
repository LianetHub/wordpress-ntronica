<?php
/**
 * Search results
 *
 * @package ntronica
 */

get_header();
?>
<div class="_container">
	<h1>
		<?php
		/* translators: %s: search query */
		printf( esc_html__( 'Search results: %s', 'ntronica' ), esc_html( get_search_query() ) );
		?>
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
		<p><?php esc_html_e( 'Nothing found.', 'ntronica' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
