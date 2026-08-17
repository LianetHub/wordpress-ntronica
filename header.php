<?php

/**
 * Header — fixed left sidebar shell
 *
 * @package ntronica
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div class="wrapper">
		<?php get_template_part('components/templates-parts/sidebar'); ?>
		<div class="site-body">
			<main class="main<?php echo is_front_page() ? ' main--home' : (is_page('about') ? ' main--about' : (is_page('careers') ? ' main--careers' : (is_page('contacts') ? ' main--contacts' : (is_404() ? ' main--error' : '')))); ?>">