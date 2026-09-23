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
$ntronica_news_lead = 'Updates from our labs, events, and partnerships across the microelectronics equipment cycle — from process development to production tools.';

$ntronica_news_article_url = ntronica_get_news_article_url();

$ntronica_news_items = array(
	array(
		'date'  => '14.03.2026',
		'title' => 'Ntronica opens a new process development lab in Bangalore',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '02.03.2026',
		'title' => 'Partnership with IIT Madras on plasma etch research',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '18.02.2026',
		'title' => 'SEMICON India 2026: live demos of our deposition tools',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '05.02.2026',
		'title' => 'New ALD module enters pilot production',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '22.01.2026',
		'title' => 'Hiring: process engineers for the thin films team',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '09.01.2026',
		'title' => 'Year in review: 2025 milestones in etch and epitaxy',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '12.12.2025',
		'title' => 'Customer workshop: scaling R&D tools to volume manufacturing',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '28.11.2025',
		'title' => 'ISO 9001 recertification completed',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '15.11.2025',
		'title' => 'Metrology roadmap: in-line analytics for 2026',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '03.11.2025',
		'title' => 'First shipment of dual-chamber etch systems to Europe',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '20.10.2025',
		'title' => 'Open day at the Ntronica cleanroom facility',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '07.10.2025',
		'title' => 'Technical webinar: PEALD for advanced gate stacks',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '24.09.2025',
		'title' => 'Collaboration with a leading foundry on SiC etch',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '11.09.2025',
		'title' => 'New service hub launched in Pune',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '29.08.2025',
		'title' => 'Patent granted for low-damage plasma source design',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '14.08.2025',
		'title' => 'Summer internship program awards announced',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '01.08.2025',
		'title' => 'Software update 3.4: recipe library and remote diagnostics',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '18.07.2025',
		'title' => 'Ntronica at SEMICON West: booth highlights',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '04.07.2025',
		'title' => 'Field upgrade kits for legacy PVD platforms',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '20.06.2025',
		'title' => 'Safety milestone: one million incident-free hours',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '06.06.2025',
		'title' => 'Epitaxy process kit expands GaN coverage',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '23.05.2025',
		'title' => 'Investor update: capacity expansion plan',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '09.05.2025',
		'title' => 'White paper: reducing particle defects in ALD',
		'url'   => $ntronica_news_article_url,
	),
	array(
		'date'  => '25.04.2025',
		'title' => 'Community STEM grants for local schools',
		'url'   => $ntronica_news_article_url,
	),
);

$ntronica_media_items = array(
	array(
		'date'    => '10.03.2026',
		'title'   => 'How Indian toolmakers are closing the fab equipment gap',
		'excerpt' => 'Electronics Weekly covers Ntronica’s push into etch and deposition for domestic semiconductor lines.',
		'url'     => '#',
	),
	array(
		'date'    => '27.02.2026',
		'title'   => 'Interview: building full-cycle microelectronics gear from India',
		'excerpt' => 'Our CEO discusses R&D priorities, talent, and why process development labs matter for scale-up.',
		'url'     => '#',
	),
	array(
		'date'    => '12.02.2026',
		'title'   => 'Plasma etch advances for compound semiconductors',
		'excerpt' => 'A technical brief on low-damage sources and uniformity control for GaN and SiC device flows.',
		'url'     => '#',
	),
	array(
		'date'    => '30.01.2026',
		'title'   => 'Startup-to-scale: Ntronica’s manufacturing story',
		'excerpt' => 'Forbes India profiles the company’s path from prototype chambers to certified production tools.',
		'url'     => '#',
	),
	array(
		'date'    => '16.01.2026',
		'title'   => 'Atomic layer deposition enters the mainstream fab toolkit',
		'excerpt' => 'Industry analysts note growing demand for modular ALD platforms suited to pilot lines.',
		'url'     => '#',
	),
	array(
		'date'    => '08.12.2025',
		'title'   => 'Cleanroom open day draws researchers and students',
		'excerpt' => 'Local press reports on hands-on demos of deposition, etch, and metrology stations.',
		'url'     => '#',
	),
	array(
		'date'    => '21.11.2025',
		'title'   => 'Why metrology is the next frontier for equipment vendors',
		'excerpt' => 'Ntronica outlines plans to add in-line analytics alongside its process tool portfolio.',
		'url'     => '#',
	),
	array(
		'date'    => '05.11.2025',
		'title'   => 'Dual-chamber etch systems ship to European labs',
		'excerpt' => 'Export milestone highlights demand for flexible R&D platforms outside Asia.',
		'url'     => '#',
	),
	array(
		'date'    => '19.10.2025',
		'title'   => 'PEALD webinar recap: gate stacks and film stress',
		'excerpt' => 'Key takeaways from a session with process engineers on advanced dielectric stacks.',
		'url'     => '#',
	),
	array(
		'date'    => '02.10.2025',
		'title'   => 'Foundry collaboration targets SiC power devices',
		'excerpt' => 'Joint work focuses on etch selectivity and throughput for next-generation power modules.',
		'url'     => '#',
	),
	array(
		'date'    => '17.09.2025',
		'title'   => 'Patent watch: low-damage plasma source design',
		'excerpt' => 'IP coverage expands around chamber architecture that protects sensitive device layers.',
		'url'     => '#',
	),
	array(
		'date'    => '01.09.2025',
		'title'   => 'Remote diagnostics cut tool downtime in the field',
		'excerpt' => 'Software release 3.4 adds recipe libraries and predictive maintenance hooks for service teams.',
		'url'     => '#',
	),
	array(
		'date'    => '14.08.2025',
		'title'   => 'SEMICON West booth tour: deposition and etch highlights',
		'excerpt' => 'Trade media walk through live modules and customer use cases from the show floor.',
		'url'     => '#',
	),
	array(
		'date'    => '28.07.2025',
		'title'   => 'Legacy PVD platforms get a second life',
		'excerpt' => 'Field upgrade kits extend tool life while aligning chambers with newer process recipes.',
		'url'     => '#',
	),
	array(
		'date'    => '11.07.2025',
		'title'   => 'GaN epitaxy kit expands coverage for RF and power',
		'excerpt' => 'Process options broaden for research groups moving from silicon to wide-bandgap materials.',
		'url'     => '#',
	),
	array(
		'date'    => '25.06.2025',
		'title'   => 'Capacity expansion signals confidence in domestic fabs',
		'excerpt' => 'Investor notes point to new assembly lines and longer lead-time components stocked in-house.',
		'url'     => '#',
	),
	array(
		'date'    => '09.06.2025',
		'title'   => 'White paper: cutting particle defects in ALD cycles',
		'excerpt' => 'Practical guidance on purge strategies, chamber conditioning, and in-situ monitoring.',
		'url'     => '#',
	),
	array(
		'date'    => '22.05.2025',
		'title'   => 'STEM grants bring microfab demos into classrooms',
		'excerpt' => 'Community program funds kits and visits that introduce students to semiconductor careers.',
		'url'     => '#',
	),
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
