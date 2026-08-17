<?php

/**
 * Theme helpers
 *
 * @package ntronica
 */

/**
 * Estimate reading time in minutes.
 *
 * @param int|null $post_id            Post ID.
 * @param int      $wpm                Words per minute.
 * @param int      $seconds_per_image  Extra seconds per image.
 * @return int
 */
function ntronica_get_reading_time($post_id = null, $wpm = 200, $seconds_per_image = 5)
{
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$html    = apply_filters('the_content', get_post_field('post_content', $post_id));
	$words   = str_word_count(wp_strip_all_tags($html));

	preg_match_all('/<img\b[^>]*>/i', $html, $matches);
	$images = count($matches[0]);
	$words += ($images * $seconds_per_image) * $wpm / 60;

	return max(1, (int) ceil($words / $wpm));
}

/**
 * Print reading time string.
 *
 * @param int|null $post_id Post ID.
 * @param string   $before  Prefix.
 * @param string   $after   Suffix.
 */
function ntronica_the_reading_time($post_id = null, $before = '', $after = ' мин. читать')
{
	printf(
		'%s%d%s',
		$before,
		ntronica_get_reading_time($post_id),
		$after
	);
}

/**
 * Print the theme SVG sprite once so <use href="#icon-*"> can reference it.
 */
function ntronica_svg_sprite()
{
	$path = get_template_directory() . '/assets/img/icons/sprite.svg';
	if (! is_readable($path)) {
		return;
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- theme SVG sprite.
	echo file_get_contents($path);
}
add_action('wp_body_open', 'ntronica_svg_sprite', 1);

/**
 * Query posts for a news category slug.
 *
 * @param string $category_slug Category slug.
 * @param int    $number        Number of posts.
 * @return WP_Query
 */
function ntronica_query_news_posts($category_slug, $number = 8)
{
	return new WP_Query(
		array(
			'post_type'           => 'post',
			'posts_per_page'      => (int) $number,
			'category_name'       => sanitize_title($category_slug),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
}

/**
 * Category description, or a fallback lead.
 *
 * @param string $category_slug Category slug.
 * @param string $fallback      Fallback text.
 * @return string
 */
function ntronica_get_category_lead($category_slug, $fallback = '')
{
	$ntronica_term = get_term_by('slug', $category_slug, 'category');
	if ($ntronica_term && ! is_wp_error($ntronica_term) && '' !== $ntronica_term->description) {
		return $ntronica_term->description;
	}

	return $fallback;
}

/**
 * Posts page URL, with /news/ fallback.
 *
 * @return string
 */
function ntronica_get_news_url()
{
	$ntronica_blog_id = (int) get_option('page_for_posts');
	if ($ntronica_blog_id) {
		return get_permalink($ntronica_blog_id);
	}

	return home_url('/news/');
}

/**
 * Print an SVG icon from the theme sprite.
 *
 * @param string $name  Symbol name without the `icon-` prefix.
 * @param string $class Extra class names on the <svg>.
 */
function ntronica_icon($name, $class = '')
{
	$name = sanitize_html_class($name);
	if ('' === $name) {
		return;
	}

	$classes = trim('icon icon--' . $name . ' ' . $class);

	printf(
		'<svg class="%1$s" aria-hidden="true" focusable="false"><use href="#icon-%2$s"></use></svg>',
		esc_attr($classes),
		esc_attr($name)
	);
}
