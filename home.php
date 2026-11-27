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

// Hero fields: ACF override → page title → fallback.
$ntronica_title   = $ntronica_blog_id ? get_the_title($ntronica_blog_id) : ntronica_ui_text('News');
$ntronica_tagline = $ntronica_blog_id ? get_the_excerpt($ntronica_blog_id) : '';
$ntronica_image   = IMG_PATH . '/news/hero.webp';

$ntronica_acf_hero_title   = $ntronica_blog_id ? get_field('news_hero_title', $ntronica_blog_id) : null;
$ntronica_acf_hero_tagline = $ntronica_blog_id ? get_field('news_hero_tagline', $ntronica_blog_id) : null;
$ntronica_acf_hero_image   = $ntronica_blog_id ? get_field('news_hero_image', $ntronica_blog_id) : null;

if (is_string($ntronica_acf_hero_title) && '' !== $ntronica_acf_hero_title) {
	$ntronica_title = $ntronica_acf_hero_title;
}

if (is_string($ntronica_acf_hero_tagline) && '' !== $ntronica_acf_hero_tagline) {
	$ntronica_tagline = $ntronica_acf_hero_tagline;
}

if (is_string($ntronica_acf_hero_image) && '' !== $ntronica_acf_hero_image) {
	$ntronica_image = $ntronica_acf_hero_image;
} elseif ($ntronica_blog_id && has_post_thumbnail($ntronica_blog_id)) {
	$ntronica_thumb = get_the_post_thumbnail_url($ntronica_blog_id, 'full');
	if ($ntronica_thumb) {
		$ntronica_image = $ntronica_thumb;
	}
}



// Category IDs from ACF.
$ntronica_events_cat = $ntronica_blog_id ? (int) get_field('news_events_category', $ntronica_blog_id) : 0;
$ntronica_press_cat  = $ntronica_blog_id ? (int) get_field('news_press_category', $ntronica_blog_id) : 0;
$ntronica_media_cat  = $ntronica_blog_id ? (int) get_field('news_media_category', $ntronica_blog_id) : 0;

// Lead texts from ACF → category description → fallback.
$ntronica_events_lead = '';
$ntronica_press_lead  = '';
$ntronica_media_lead  = '';

if ($ntronica_blog_id) {
	$ntronica_events_lead = get_field('news_events_lead', $ntronica_blog_id);
	$ntronica_press_lead  = get_field('news_press_lead', $ntronica_blog_id);
	$ntronica_media_lead  = get_field('news_media_lead', $ntronica_blog_id);
}

$ntronica_events_lead = is_string($ntronica_events_lead) && '' !== $ntronica_events_lead
	? $ntronica_events_lead
	: ntronica_get_category_lead_by_id($ntronica_events_cat, '');

$ntronica_press_lead = is_string($ntronica_press_lead) && '' !== $ntronica_press_lead
	? $ntronica_press_lead
	: ntronica_get_category_lead_by_id($ntronica_press_cat, '');

$ntronica_media_lead = is_string($ntronica_media_lead) && '' !== $ntronica_media_lead
	? $ntronica_media_lead
	: ntronica_get_category_lead_by_id($ntronica_media_cat, '');

// Queries.
$ntronica_events_query = null;
$ntronica_press_query  = null;
$ntronica_media_query  = null;

if ($ntronica_events_cat > 0) {
	$ntronica_events_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 8,
			'cat'                 => $ntronica_events_cat,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
}

if ($ntronica_press_cat > 0) {
	$ntronica_press_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => 8,
			'cat'                 => $ntronica_press_cat,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
}

if ($ntronica_media_cat > 0) {
	$ntronica_media_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => -1,
			'cat'                 => $ntronica_media_cat,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
}

$ntronica_news_article_url = ntronica_get_news_article_url();

// Items arrays.
$ntronica_events_items = $ntronica_events_query && $ntronica_events_query->have_posts()
	? ntronica_query_to_items($ntronica_events_query, 'feed')
	: array();

$ntronica_press_items = $ntronica_press_query && $ntronica_press_query->have_posts()
	? ntronica_query_to_items($ntronica_press_query, 'feed')
	: array();

$ntronica_media_items = $ntronica_media_query && $ntronica_media_query->have_posts()
	? ntronica_query_to_items($ntronica_media_query, 'media')
	: array();
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
<?php if (! empty($ntronica_events_items)) : ?>
<?php
	get_template_part(
		'components/templates-parts/section',
		'news-feed',
		array(
			'id'    => 'events',
			'title' => ntronica_ui_text('Events & news'),
			'lead'  => $ntronica_events_lead,
			'items' => $ntronica_events_items,
		)
	);
?>
<?php endif; ?>

<?php if (! empty($ntronica_press_items)) : ?>
<?php
	get_template_part(
		'components/templates-parts/section',
		'news-feed',
		array(
			'id'       => 'press',
			'title'    => ntronica_ui_text('Press releases'),
			'lead'     => $ntronica_press_lead,
			'modifier' => 'press',
			'items'    => $ntronica_press_items,
		)
	);
?>
<?php endif; ?>

<?php if (! empty($ntronica_media_items)) : ?>
<?php
	get_template_part(
		'components/templates-parts/section',
		'media-publications',
		array(
			'items' => $ntronica_media_items,
		)
	);
?>
<?php endif; ?>

<?php
get_footer();
