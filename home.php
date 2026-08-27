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

// Temporary mock content — real WP posts wiring comes later.
$ntronica_news_lead = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing sit amet, consectetuer. Lorem ipsum dolor sit amet, consectetuer adipiscing sit.';

$ntronica_news_items = array_fill(
	0,
	24,
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor',
		'url'   => '#',
	)
);

$ntronica_media_items = array_fill(
	0,
	18,
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
		'url'     => '#',
	)
);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => $ntronica_title,
		'image'   => $ntronica_image,
		'tagline' => $ntronica_tagline,
		'nav'     => ntronica_get_page_section_nav('news'),
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'news-feed',
	array(
		'id'    => 'events',
		'title' => 'Events & news',
		'lead'  => $ntronica_news_lead,
		'items' => $ntronica_news_items,
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
		'lead'     => $ntronica_news_lead,
		'modifier' => 'press',
		'items'    => $ntronica_news_items,
	)
);
?>
<?php
get_template_part(
	'components/templates-parts/section',
	'media-publications',
	array(
		'items' => $ntronica_media_items,
	)
);
?>

<?php
get_footer();
