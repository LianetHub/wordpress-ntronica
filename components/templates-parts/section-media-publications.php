<?php

/**
 * Section: Media publications
 *
 * @package ntronica
 */

$ntronica_media_query = ntronica_query_news_posts('media', 6);
$ntronica_media_posts = $ntronica_media_query->posts;
?>
<section class="media-publications band-full" id="media">
	<div class="container">
		<h2 class="section-title section-title--light media-publications__title">
			Media publications
		</h2>

		<?php if ($ntronica_media_posts) : ?>
			<div class="row media-publications__grid">
				<?php foreach ($ntronica_media_posts as $ntronica_post) : ?>
					<div class="col-12 col-md-4">
						<article class="media-card">
							<a class="media-card__link" href="<?php echo esc_url(get_permalink($ntronica_post)); ?>">
								<p class="media-card__date"><?php echo esc_html(get_the_date('d.m.Y', $ntronica_post)); ?></p>
								<h3 class="media-card__title"><?php echo esc_html(get_the_title($ntronica_post)); ?></h3>
								<p class="media-card__excerpt"><?php echo esc_html(get_the_excerpt($ntronica_post)); ?></p>
							</a>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
wp_reset_postdata();
