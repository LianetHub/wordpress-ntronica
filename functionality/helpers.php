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

	return ntronica_page_url('news');
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
	$ntronica_alt   = ntronica_ui_text('Technicians in cleanroom suits in a semiconductor facility');

	return array(
		'title'      => 'Lorem ipsum dolor sit',
		'date'       => '25.01.2023',
		'datetime'   => '2023-01-25',
		'lead'       => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.',
		'paragraphs' => array(
			ntronica_ui_text('It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).'),
			ntronica_ui_text('It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production.'),
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
			'label' => ntronica_ui_text('News'),
			'url'   => ntronica_get_news_url(),
		),
		array(
			'label' => $ntronica_article['title'],
			'url'   => '',
		),
	);
}

/**
 * Breadcrumb crumbs for a vacancy: Careers — Title.
 *
 * @param int|null $post_id Post ID.
 * @return array<int, array{label: string, url: string}>
 */
function ntronica_get_vacancy_crumbs($post_id = null)
{
	$post_id = $post_id ? (int) $post_id : get_the_ID();

	return array(
		array(
			'label' => ntronica_ui_text('Careers'),
			'url'   => ntronica_page_url('careers'),
		),
		array(
			'label' => get_the_title($post_id),
			'url'   => '',
		),
	);
}

/**
 * Breadcrumb crumbs for a product: Products, category, title.
 *
 * The middle crumb uses the category that determines the product permalink.
 *
 * @param int|null $post_id Post ID.
 * @return array<int, array{label: string, url: string}>
 */
function ntronica_get_product_crumbs($post_id = null)
{
	$post_id = $post_id ? (int) $post_id : get_the_ID();

	$terms = wp_get_object_terms($post_id, 'product_category', array('orderby' => 'term_id'));
	$category = ! is_wp_error($terms) && $terms ? $terms[0] : null;
	$category_url = $category ? get_term_link($category) : '';

	return array(
		array(
			'label' => ntronica_ui_text('Products'),
			'url'   => ntronica_page_url('products'),
		),
		array(
			'label' => $category ? $category->name : ntronica_ui_text('Uncategorized'),
			'url'   => ! is_wp_error($category_url) ? $category_url : '',
		),
		array(
			'label' => get_the_title($post_id),
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

	$ntronica_acf_tree = function_exists('ntronica_acf_get_nav_tree') ? ntronica_acf_get_nav_tree() : array();

	if (! empty($ntronica_acf_tree)) {
		$ntronica_tree = $ntronica_acf_tree;
		return $ntronica_tree;
	}

	$ntronica_tree = array(
		array(
			'slug'     => 'front_page',
			'label'    => ntronica_ui_text('Front Page'),
			'url'      => home_url('/'),
			'children' => array(
				array(
					'href'  => '#hero',
					'label' => ntronica_ui_text('Hero'),
				),
				array(
					'href'  => '#overview',
					'label' => ntronica_ui_text('Company overview'),
				),
				array(
					'href'  => '#products',
					'label' => ntronica_ui_text('Products'),
				),
				array(
					'href'  => '#processes',
					'label' => ntronica_ui_text('Technological processes'),
				),
				array(
					'href'  => '#info',
					'label' => ntronica_ui_text('Company information'),
				),
				array(
					'href'  => '#contacts',
					'label' => ntronica_ui_text('Contact us'),
				),
			),
		),
		array(
			'slug'     => 'about',
			'label'    => ntronica_ui_text('About'),
			'url'      => ntronica_page_url('about'),
			'children' => array(
				array(
					'href'  => '#overview',
					'label' => ntronica_ui_text('Company overview'),
				),
				array(
					'href'  => '#goal',
					'label' => ntronica_ui_text('Our goal'),
				),
				array(
					'href'  => '#about-us',
					'label' => ntronica_ui_text('About us'),
				),
			),
		),
		array(
			'slug'     => 'technology',
			'label'    => ntronica_ui_text('Technology'),
			'url'      => ntronica_page_url('technology'),
			'children' => array(
				array(
					'href'  => '#microchips',
					'label' => ntronica_ui_text('All about microchips'),
				),
				array(
					'href'  => '#processes',
					'label' => ntronica_ui_text('Chip making processes'),
				),
				array(
					'href'  => '#media',
					'label' => ntronica_ui_text('Media publications'),
				),
			),
		),
		array(
			'slug'     => 'products',
			'label'    => ntronica_ui_text('Products'),
			'url'      => ntronica_page_url('products'),
			'children' => array(
				array(
					'href'  => '#thin-films',
					'label' => ntronica_ui_text('Thin films equipment'),
				),
				array(
					'href'  => '#wet-process',
					'label' => ntronica_ui_text('Wet process equipment'),
				),
				array(
					'href'  => '#process-control',
					'label' => ntronica_ui_text('Process control'),
				),
			),
		),
		array(
			'slug'     => 'news',
			'label'    => ntronica_ui_text('News'),
			'url'      => ntronica_get_news_url(),
			'children' => array(
				array(
					'href'  => '#events',
					'label' => ntronica_ui_text('Events & news'),
				),
				array(
					'href'  => '#press',
					'label' => ntronica_ui_text('Press releases'),
				),
				array(
					'href'  => '#media',
					'label' => ntronica_ui_text('Mass media publications'),
				),
			),
		),
		array(
			'slug'     => 'careers',
			'label'    => ntronica_ui_text('Careers'),
			'url'      => ntronica_page_url('careers'),
			'children' => array(
				array(
					'href'  => '#team',
					'label' => ntronica_ui_text('Our team'),
				),
				array(
					'href'  => '#careers',
					'label' => ntronica_ui_text('Open positions'),
				),
				array(
					'href'  => '#contacts',
					'label' => ntronica_ui_text('Contact us'),
				),
			),
		),
		array(
			'slug'     => 'contacts',
			'label'    => ntronica_ui_text('Contacts'),
			'url'      => ntronica_page_url('contacts'),
			'children' => array(
				array(
					'href'  => '#about',
					'label' => ntronica_ui_text('Company information'),
				),
				array(
					'href'  => '#our-representative',
					'label' => ntronica_ui_text('Our representative'),
				),
				array(
					'href'  => '#contacts',
					'label' => ntronica_ui_text('Contact us'),
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
	if ('front_page' === $slug) {
		return is_front_page();
	}

	if ('news' === $slug) {
		return is_home() || is_singular('post');
	}

	if (is_page($slug)) {
		return true;
	}

	$ntronica_tree = ntronica_get_nav_tree();
	foreach ($ntronica_tree as $ntronica_item) {
		if ($slug === $ntronica_item['slug'] && isset($ntronica_item['url'])) {
			$ntronica_request_path = wp_parse_url(wp_unslash($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH);
			$ntronica_item_path    = wp_parse_url($ntronica_item['url'], PHP_URL_PATH);
			if (is_string($ntronica_request_path) && is_string($ntronica_item_path) && rtrim($ntronica_request_path, '/') === rtrim($ntronica_item_path, '/')) {
				return true;
			}
		}
	}

	return false;
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
 * @param string $name     Symbol name without the `icon-` prefix.
 * @param string $class    Extra class names on the <svg>.
 * @param string $view_box Optional viewBox so the icon can scale via CSS.
 */
function ntronica_icon($name, $class = '', $view_box = '')
{
	$name = sanitize_html_class($name);
	if ('' === $name) {
		return;
	}

	$classes       = trim('icon icon--' . $name . ' ' . $class);
	$view_box_attr = '' !== $view_box ? ' viewBox="' . esc_attr($view_box) . '"' : '';

	printf(
		'<svg class="%1$s" aria-hidden="true" focusable="false"%3$s><use href="#icon-%2$s"></use></svg>',
		esc_attr($classes),
		esc_attr($name),
		$view_box_attr
	);
}

/**
 * Convert a WP_Query of posts to items arrays for section template parts.
 *
 * @param WP_Query|null $query  WP_Query with 'post' post type.
 * @param string        $format 'news' for section-news, 'feed' for section-news-feed, 'media' for section-media-publications.
 * @return array
 */
function ntronica_query_to_items($query, $format = 'media')
{
	$items = array();

	if (! $query instanceof WP_Query || ! $query->have_posts()) {
		return $items;
	}

	while ($query->have_posts()) {
		$query->the_post();

		$item = array(
			'date'  => get_the_date(),
			'title' => get_the_title(),
			'url'   => get_permalink(),
		);

		if ('news' === $format || 'feed' === $format) {
			$image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
			if ($image) {
				$item['image'] = $image;
			}
		}

		if ('media' === $format) {
			$excerpt = get_the_excerpt();
			$item['excerpt'] = $excerpt ? $excerpt : '';
		}

		$items[] = $item;
	}

	wp_reset_postdata();

	return $items;
}

/**
 * Category description by ID, or a fallback lead.
 *
 * @param int    $term_id  Category term ID.
 * @param string $fallback Fallback text.
 * @return string
 */
function ntronica_get_category_lead_by_id($term_id, $fallback = '')
{
	if ($term_id < 1) {
		return $fallback;
	}

	$ntronica_term = get_term((int) $term_id, 'category');
	if ($ntronica_term && ! is_wp_error($ntronica_term) && '' !== $ntronica_term->description) {
		return $ntronica_term->description;
	}

	return $fallback;
}

/**
 * Print a Swiper prev/next button with sprite arrows (default + hover).
 *
 * @param string $direction  `prev` or `next`.
 * @param string $aria_label Accessible label.
 */
function ntronica_slider_nav_button($direction, $aria_label)
{
	$direction = 'prev' === $direction ? 'prev' : 'next';
?>
	<button
		type="button"
		class="swiper-button-<?php echo esc_attr($direction); ?>"
		aria-label="<?php echo esc_attr(ntronica_ui_text($aria_label)); ?>">
		<?php ntronica_icon('arrow-' . $direction, '', '0 0 29 19'); ?>
		<?php ntronica_icon('arrow-' . $direction . '-hover', '', '0 0 29 19'); ?>
	</button>
<?php
}
