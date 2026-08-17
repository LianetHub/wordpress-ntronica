<?php

/**
 * Section: Events & news
 *
 * @package ntronica
 */

$ntronica_home_news = ntronica_query_news_posts('events', 4);
$ntronica_home_posts = $ntronica_home_news->posts;
$ntronica_news_url = ntronica_get_news_url();
?>
<section class="section-news" id="news">
	<div class="container">
		<h2 class="section-title section-news__title">Events &amp; news</h2>
		<p class="section-lead section-news__lead">
			<?php echo esc_html(ntronica_get_category_lead('events', 'We stay active in the industry. Below, discover where you can meet our team and experience our latest activities. We look forward to connecting with you in person.')); ?>
		</p>

		<?php if ($ntronica_home_posts) : ?>
			<div class="row section-news__grid">
				<?php foreach ($ntronica_home_posts as $ntronica_index => $ntronica_post) : ?>
					<div class="col-12 col-md-3<?php echo 0 === $ntronica_index ? '' : ' section-news__item--desktop'; ?>">
						<article class="news-card">
							<a class="news-card__link" href="<?php echo esc_url(get_permalink($ntronica_post)); ?>">
								<div class="news-card__media" <?php echo has_post_thumbnail($ntronica_post) ? '' : ' aria-hidden="true"'; ?>>
									<?php
									if (has_post_thumbnail($ntronica_post)) {
										echo get_the_post_thumbnail(
											$ntronica_post,
											'medium_large',
											array(
												'class'   => 'news-card__img',
												'alt'     => get_the_title($ntronica_post),
												'loading' => 'lazy',
											)
										);
									}
									?>
								</div>
								<p class="news-card__date"><?php echo esc_html(get_the_date('d.m.Y', $ntronica_post)); ?></p>
								<h3 class="news-card__title"><?php echo esc_html(get_the_title($ntronica_post)); ?></h3>
							</a>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="section-news__more">
			<a class="link-more" href="<?php echo esc_url($ntronica_news_url); ?>">
				<span>LEARN MORE</span>
				<span class="link-more__arrow" aria-hidden="true">→</span>
			</a>
		</div>
	</div>
</section>
<?php
wp_reset_postdata();
