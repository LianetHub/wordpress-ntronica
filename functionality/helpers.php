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
 * Permalink of a published post for mock news cards.
 *
 * @return string
 */
function ntronica_get_news_article_url()
{
	$ntronica_posts = get_posts(
		array(
			'numberposts'      => 1,
			'post_status'      => 'publish',
			'post_type'        => 'post',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'no_found_rows'    => true,
			'suppress_filters' => false,
		)
	);

	if ($ntronica_posts) {
		return get_permalink($ntronica_posts[0]);
	}

	return ntronica_get_news_url();
}

/**
 * Hardcoded mock article used by the news article template.
 *
 * @return array{
 *     title: string,
 *     date: string,
 *     datetime: string,
 *     lead: string,
 *     paragraphs: array<int, string>,
 *     gallery: array<int, array{src: string, alt: string}>
 * }
 */
function ntronica_get_mock_news_article()
{
	$ntronica_image = IMG_PATH . '/news/article.webp';
	$ntronica_alt   = 'Technicians in cleanroom suits in a semiconductor facility';

	return array(
		'title'      => 'Lorem ipsum dolor sit',
		'date'       => '25.01.2023',
		'datetime'   => '2023-01-25',
		'lead'       => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.',
		'paragraphs' => array(
			'It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).',
			'It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production.',
		),
		'gallery'    => array(
			array(
				'src' => $ntronica_image,
				'alt' => $ntronica_alt,
			),
			array(
				'src' => $ntronica_image,
				'alt' => $ntronica_alt,
			),
			array(
				'src' => $ntronica_image,
				'alt' => $ntronica_alt,
			),
		),
	);
}

/**
 * Breadcrumb crumbs for the mock news article: News — Title.
 *
 * @return array<int, array{label: string, url: string}>
 */
function ntronica_get_news_article_crumbs()
{
	$ntronica_article = ntronica_get_mock_news_article();

	return array(
		array(
			'label' => 'News',
			'url'   => ntronica_get_news_url(),
		),
		array(
			'label' => $ntronica_article['title'],
			'url'   => '',
		),
	);
}

/**
 * Print "Parent — Current" breadcrumbs list.
 *
 * @param array<int, array{label: string, url?: string}> $crumbs Crumb items.
 */
function ntronica_render_breadcrumbs($crumbs)
{
	if (! is_array($crumbs) || ! $crumbs) {
		return;
	}

	$last = count($crumbs) - 1;

	echo '<ol class="breadcrumbs__list">';

	foreach ($crumbs as $key => $crumb) {
		$label   = isset($crumb['label']) ? (string) $crumb['label'] : '';
		$url     = isset($crumb['url']) ? (string) $crumb['url'] : '';
		$is_last = (int) $key === $last;
		$class   = $is_last ? 'breadcrumbs__item breadcrumbs__item--last' : 'breadcrumbs__item';

		echo '<li class="' . esc_attr($class) . '">';

		if (! $is_last && $url) {
			echo '<a href="' . esc_url($url) . '" class="breadcrumbs__link">' . esc_html($label) . '</a>';
		} else {
			echo '<span class="breadcrumbs__current">' . esc_html($label) . '</span>';
		}

		echo '</li>';

		if (! $is_last) {
			echo '<li class="breadcrumbs__sep" aria-hidden="true"> — </li>';
		}
	}

	echo '</ol>';
}

/**
 * Primary nav tree: top-level items and page-section children.
 *
 * Children keep hash-only hrefs for page-hero; the sidebar prefixes the page URL.
 *
 * @return array<int, array{slug: string, label: string, url: string, children: array<int, array{href: string, label: string}>}>
 */
function ntronica_get_nav_tree()
{
	static $ntronica_tree = null;

	if (null !== $ntronica_tree) {
		return $ntronica_tree;
	}

	$ntronica_tree = array(
		array(
			'slug'     => 'about',
			'label'    => 'About',
			'url'      => home_url('/about/'),
			'children' => array(
				array(
					'href'  => '#overview',
					'label' => 'Company overview',
				),
				array(
					'href'  => '#goal',
					'label' => 'Our goal',
				),
				array(
					'href'  => '#about-us',
					'label' => 'About us',
				),
			),
		),
		array(
			'slug'     => 'technology',
			'label'    => 'Technology',
			'url'      => home_url('/technology/'),
			'children' => array(
				array(
					'href'  => '#microchips',
					'label' => 'All about microchips',
				),
				array(
					'href'  => '#lorem-ipsum',
					'label' => 'Lorem ipsum',
				),
				array(
					'href'  => '#processes',
					'label' => 'Chip making processes',
				),
				array(
					'href'  => '#media',
					'label' => 'Media publications',
				),
			),
		),
		array(
			'slug'     => 'products',
			'label'    => 'Products',
			'url'      => home_url('/products/'),
			'children' => array(
				array(
					'href'  => '#thin-films',
					'label' => 'Thin films equipment',
				),
				array(
					'href'  => '#wet-process',
					'label' => 'Wet process equipment',
				),
				array(
					'href'  => '#process-control',
					'label' => 'Process control',
				),
			),
		),
		array(
			'slug'     => 'news',
			'label'    => 'News',
			'url'      => ntronica_get_news_url(),
			'children' => array(
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
					'label' => 'Mass media publications',
				),
			),
		),
		array(
			'slug'     => 'careers',
			'label'    => 'Careers',
			'url'      => home_url('/careers/'),
			'children' => array(
				array(
					'href'  => '#team',
					'label' => 'Our team',
				),
				array(
					'href'  => '#careers',
					'label' => 'Open positions',
				),
				array(
					'href'  => '#contacts',
					'label' => 'Contact us',
				),
			),
		),
		array(
			'slug'     => 'contacts',
			'label'    => 'Contacts',
			'url'      => home_url('/contacts/'),
			'children' => array(
				array(
					'href'  => '#about',
					'label' => 'Company information',
				),
				array(
					'href'  => '#our-representative',
					'label' => 'Our representative',
				),
				array(
					'href'  => '#contacts',
					'label' => 'Contact us',
				),
			),
		),
	);

	return $ntronica_tree;
}

/**
 * Section nav for a page slug (page-hero).
 *
 * @param string $slug Top-level nav slug.
 * @return array<int, array{href: string, label: string}>
 */
function ntronica_get_page_section_nav($slug)
{
	$slug = sanitize_title($slug);

	foreach (ntronica_get_nav_tree() as $ntronica_item) {
		if ($slug === $ntronica_item['slug']) {
			return $ntronica_item['children'];
		}
	}

	return array();
}

/**
 * Whether a top-level nav slug is the current view.
 *
 * @param string $slug Top-level nav slug.
 * @return bool
 */
function ntronica_is_nav_item_current($slug)
{
	if ('news' === $slug) {
		return is_home() || is_singular('post');
	}

	return is_page($slug);
}

/**
 * Shared dark shell: 404, search, policy (breadcrumbs sticky navbar).
 *
 * @return bool
 */
function ntronica_is_utility_page()
{
	return is_404() || is_search() || is_page_template('page-policy.php');
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
