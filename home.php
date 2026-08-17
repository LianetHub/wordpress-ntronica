<?php

/**
 * Blog posts index — News
 *
 * Assign this in Settings → Reading → Posts page.
 *
 * @package ntronica
 */

get_header();

$ntronica_blog_id = (int) get_option('page_for_posts');
$ntronica_title   = $ntronica_blog_id ? get_the_title($ntronica_blog_id) : 'News';
$ntronica_tagline = $ntronica_blog_id ? get_the_excerpt($ntronica_blog_id) : '';
$ntronica_image   = IMG_PATH . '/news/hero.webp';

if ('' === $ntronica_tagline) {
	$ntronica_tagline = 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities';
}

if ($ntronica_blog_id && has_post_thumbnail($ntronica_blog_id)) {
	$ntronica_thumb = get_the_post_thumbnail_url($ntronica_blog_id, 'full');
	if ($ntronica_thumb) {
		$ntronica_image = $ntronica_thumb;
	}
}

$ntronica_events_lead = ntronica_get_category_lead(
	'events',
	'We stay active in the industry. Below, discover where you can meet our team and experience our latest activities. We look forward to connecting with you in person.'
);
$ntronica_press_lead = ntronica_get_category_lead('press', $ntronica_events_lead);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_title,
		'image'   => $ntronica_image,
		'tagline' => $ntronica_tagline,
		'nav'     => array(
			array(
				'href'  => '#events',
				'label' => 'Events & news',
			),
			array(
				'href'  => '#press',
				'label' => 'Press releases',
			),
			array(
				'href'  => '#media',
				'label' => 'Media publications',
			),
		),
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'news-feed',
	array(
		'id'       => 'events',
		'title'    => 'Events & news',
		'lead'     => $ntronica_events_lead,
		'category' => 'events',
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'news-feed',
	array(
		'id'       => 'press',
		'title'    => 'Press releases',
		'lead'     => $ntronica_press_lead,
		'modifier' => 'press',
		'category' => 'press',
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'media-publications'); ?>

<?php
get_footer();
