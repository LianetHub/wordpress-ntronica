<?php

/**
 * About: Technological processes / solutions
 *
 * @package ntronica
 */

$ntronica_lead = get_field('about_solutions_lead');

$ntronica_lead = is_string($ntronica_lead) ? $ntronica_lead : '';

$ntronica_categories = get_terms(array(
	'taxonomy'   => 'product_category',
	'hide_empty' => false,
	'orderby'    => 'name',
	'order'      => 'ASC',
));
?>
<section class="about-solutions" id="solutions">
	<div class="container">
		<div class="row about-solutions__intro">
			<div class="col-md-6">
				<h2 class="about-solutions__lead"><?php echo esc_html($ntronica_lead); ?></h2>
			</div>
		</div>

		<?php if (! empty($ntronica_categories) && ! is_wp_error($ntronica_categories)) : ?>
		<ul class="row about-solutions__grid">
			<?php foreach ($ntronica_categories as $ntronica_cat) : ?>
				<?php
				$ntronica_cat_url   = get_term_link($ntronica_cat);
				$ntronica_cat_title = $ntronica_cat->name;
				$ntronica_cat_image = '';
				?>
				<li class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'  => $ntronica_cat_title,
							'url'    => is_string($ntronica_cat_url) ? $ntronica_cat_url : '',
							'image'  => '' !== $ntronica_cat_image ? $ntronica_cat_image : IMG_PATH . '/home/product-thin-films.webp',
							'width'  => 622,
							'height' => 414,
						)
					);
					?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>
</section>