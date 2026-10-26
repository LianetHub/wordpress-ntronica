<?php

/**
 * Template Name: Technology page
 *
 * @package ntronica
 */

get_header();

// Temporary mock content — real WP posts wiring comes later.
$ntronica_media_items = array(
	array(
		'date'    => '18.09.2026',
		'title'   => 'Precision at every layer',
		'excerpt' => 'A closer look at thin-film deposition and the process controls that help deliver consistent results across each wafer.',
		'url'     => '#',
	),
	array(
		'date'    => '02.09.2026',
		'title'   => 'Inside the cleanroom',
		'excerpt' => 'Explore how controlled environments support reliable microelectronics production, from material handling to final inspection.',
		'url'     => '#',
	),
	array(
		'date'    => '21.08.2026',
		'title'   => 'From research to repeatable production',
		'excerpt' => 'Moving a promising laboratory process into manufacturing requires careful validation. Our engineers explain the key stages of that transition.',
		'url'     => '#',
	),
	array(
		'date'    => '06.08.2026',
		'title'   => 'Plasma processing explained',
		'excerpt' => 'How plasma interacts with materials and why its properties matter for etching, surface treatment, and deposition.',
		'url'     => '#',
	),
	array(
		'date'    => '24.07.2026',
		'title'   => 'Smarter process monitoring',
		'excerpt' => 'Real-time measurements can help teams identify process drift earlier and understand what happens inside the chamber.',
		'url'     => '#',
	),
	array(
		'date'    => '09.07.2026',
		'title'   => 'Building a modular platform for advanced R&D',
		'excerpt' => 'Discover an equipment architecture designed to accommodate different research tasks, process modules, and evolving laboratory requirements.',
		'url'     => '#',
	),
	array(
		'date'    => '19.06.2026',
		'title'   => 'The role of vacuum',
		'excerpt' => 'A short introduction to vacuum systems and their place in modern semiconductor manufacturing.',
		'url'     => '#',
	),
	array(
		'date'    => '03.06.2026',
		'title'   => 'Engineering for serviceability',
		'excerpt' => 'Accessible components, clear diagnostics, and thoughtful layouts make routine maintenance easier for technical teams.',
		'url'     => '#',
	),
	array(
		'date'    => '22.05.2026',
		'title'   => 'Materials meet microelectronics',
		'excerpt' => 'New materials bring new processing challenges. We examine how temperature, chemistry, and surface preparation shape equipment requirements.',
		'url'     => '#',
	),
	array(
		'date'    => '07.05.2026',
		'title'   => 'A closer look at wafer handling',
		'excerpt' => 'Reliable transfer systems help protect sensitive substrates as they move between process steps.',
		'url'     => '#',
	),
	array(
		'date'    => '16.04.2026',
		'title'   => 'Scaling without losing control',
		'excerpt' => 'What changes when a process moves to larger substrates, and how can engineering teams maintain uniformity across a wider surface?',
		'url'     => '#',
	),
	array(
		'date'    => '01.04.2026',
		'title'   => 'Software behind the process',
		'excerpt' => 'Recipe management and equipment interfaces connect operator decisions with precise, repeatable machine actions.',
		'url'     => '#',
	),
	array(
		'date'    => '20.03.2026',
		'title'   => 'Surface preparation matters',
		'excerpt' => 'Small differences at the surface can affect the next production step. This overview introduces common preparation methods and their purposes.',
		'url'     => '#',
	),
	array(
		'date'    => '05.03.2026',
		'title'   => 'Connecting the full production cycle',
		'excerpt' => 'An integrated view of deposition, etching, cleaning, and inspection helps researchers plan more effective process workflows.',
		'url'     => '#',
	),
	array(
		'date'    => '13.02.2026',
		'title'   => 'Designed for experimentation',
		'excerpt' => 'Flexible equipment configurations give research teams room to test ideas and refine process parameters.',
		'url'     => '#',
	),
	array(
		'date'    => '29.01.2026',
		'title'   => 'Understanding process uniformity',
		'excerpt' => 'Why uniformity matters, how it is measured, and which equipment settings can influence results across a substrate.',
		'url'     => '#',
	),
	array(
		'date'    => '15.12.2025',
		'title'   => 'Collaboration starts with the application',
		'excerpt' => 'Defining materials, target structures, and operating constraints early helps align equipment development with practical research needs.',
		'url'     => '#',
	),
	array(
		'date'    => '27.11.2025',
		'title'   => 'Microelectronics: the next questions',
		'excerpt' => 'A look at the engineering questions driving new approaches to equipment design, process integration, and advanced materials research.',
		'url'     => '#',
	),
);
?>

<?php
get_template_part(
	'components/templates-parts/section',
	'page-hero',
	array(
		'title'   => 'Technology',
		'image'   => IMG_PATH . '/technology/hero.webp',
		'tagline' => 'We develop innovative equipment to enable the full cycle of microelectronics production and complex r&d activities',
		'nav'     => ntronica_get_page_section_nav('technology'),
	)
);
?>
<?php get_template_part('components/templates-parts/section', 'tech-microchips'); ?>
<?php get_template_part('components/templates-parts/section', 'progress-slider'); ?>
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
