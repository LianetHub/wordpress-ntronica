<?php
/**
 * Section: Events & news
 *
 * @package ntronica
 */

$news_items = array(
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor sit',
	),
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor sit',
	),
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor sit',
	),
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor sit',
	),
);
?>
<section class="section-news" id="news">
	<div class="container">
		<h2 class="section-title section-news__title">Events &amp; news</h2>
		<p class="section-lead section-news__lead">
			We stay active in the industry. Below, discover where you can meet our team and experience our latest activities. We look forward to connecting with you in person.
		</p>

		<div class="row section-news__grid">
			<?php foreach ( $news_items as $index => $item ) : ?>
				<div class="col-12 col-md-3<?php echo 0 === $index ? '' : ' section-news__item--desktop'; ?>">
					<article class="news-card">
						<div class="news-card__media" aria-hidden="true"></div>
						<p class="news-card__date"><?php echo esc_html( $item['date'] ); ?></p>
						<h3 class="news-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
					</article>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="section-news__more">
			<a class="link-more" href="#">
				<span>LEARN MORE</span>
				<span class="link-more__arrow" aria-hidden="true">→</span>
			</a>
		</div>
	</div>
</section>
