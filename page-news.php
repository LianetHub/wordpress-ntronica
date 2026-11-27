<?php

/**
 * News page template
 *
 * @package ntronica
 */

get_header();

$ntronica_news_lead = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing sit amet, consectetuer. Lorem ipsum dolor sit amet, consectetuer adipiscing sit.';

$ntronica_news_items = array_fill(
	0,
	24,
	array(
		'date'  => '25.01.2023',
		'title' => 'Lorem ipsum dolor',
	)
);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => ntronica_ui_text('News'),
		'image'   => IMG_PATH . '/news/hero.webp',
		'tagline' => ntronica_ui_text('We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities'),
		'nav'     => array(
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
				'label' => ntronica_ui_text('Media publications'),
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
		'id'    => 'events',
		'title' => ntronica_ui_text('Events & news'),
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
		'title'    => ntronica_ui_text('Press releases'),
		'lead'     => $ntronica_news_lead,
		'modifier' => 'press',
		'items'    => $ntronica_news_items,
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'media-publications'); ?>

<?php
get_footer();
