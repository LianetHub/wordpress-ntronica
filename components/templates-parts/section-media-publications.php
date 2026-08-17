<?php

/**
 * Section: Media publications
 *
 * @package ntronica
 */

$ntronica_media_items = array_fill(
	0,
	6,
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
	)
);
?>
<section class="section-media-publications band-full" id="media">
	<div class="container">
		<h2 class="section-title section-title--light section-media-publications__title">
			Media publications
		</h2>

		<div class="row section-media-publications__grid">
			<?php foreach ($ntronica_media_items as $ntronica_item) : ?>
				<div class="col-12 col-md-4">
					<article class="media-card">
						<p class="media-card__date"><?php echo esc_html($ntronica_item['date']); ?></p>
						<h3 class="media-card__title"><?php echo esc_html($ntronica_item['title']); ?></h3>
						<p class="media-card__excerpt"><?php echo esc_html($ntronica_item['excerpt']); ?></p>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>