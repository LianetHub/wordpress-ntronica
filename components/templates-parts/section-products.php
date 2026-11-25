<?php

/**
 * Section: Products
 *
 * @package ntronica
 */

$ntronica_title      = get_field('products_title');
$ntronica_lead       = get_field('products_lead');
$ntronica_link_url   = get_field('products_link_url');
$ntronica_link_text  = get_field('products_link_text');

$ntronica_title     = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_lead      = is_string($ntronica_lead) ? $ntronica_lead : '';
$ntronica_link_url  = is_string($ntronica_link_url) && '' !== $ntronica_link_url ? $ntronica_link_url : '';
$ntronica_link_text = is_string($ntronica_link_text) && '' !== $ntronica_link_text ? $ntronica_link_text : '';

$ntronica_products_query = new WP_Query(
	array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)
);
$ntronica_has_products = $ntronica_products_query->have_posts();
?>
<section class="products" id="products">
	<div class="container">
		<h2 class="title products__title"><?php echo esc_html($ntronica_title); ?></h2>
		<?php if ('' !== $ntronica_lead) : ?>
		<p class="text-block products__lead"><?php echo esc_html($ntronica_lead); ?></p>
		<?php endif; ?>

		<?php if ($ntronica_has_products) : ?>
		<div class="row products__grid">
			<?php while ($ntronica_products_query->have_posts()) : $ntronica_products_query->the_post(); ?>
				<?php
				$ntronica_product_id    = get_the_ID();
				$ntronica_product_title = get_the_title();
				$ntronica_product_url   = get_permalink();
				$ntronica_product_image = get_the_post_thumbnail_url($ntronica_product_id, 'large');
				$ntronica_product_image = is_string($ntronica_product_image) ? $ntronica_product_image : '';
				?>
				<div class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'  => $ntronica_product_title,
							'url'    => $ntronica_product_url,
							'image'  => '' !== $ntronica_product_image ? $ntronica_product_image : IMG_PATH . '/home/product-thin-films.webp',
							'width'  => 622,
							'height' => 414,
						)
					);
					?>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php endif; ?>

		<div class="products__more">
			<a class="link-more" href="<?php echo esc_url($ntronica_link_url); ?>" data-title="<?php echo esc_attr($ntronica_link_text); ?>">
				<span><?php echo esc_html($ntronica_link_text); ?></span>
			</a>
		</div>
	</div>
</section>
