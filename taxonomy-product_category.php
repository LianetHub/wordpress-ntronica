<?php
/**
 * Product category: real products via WP_Query.
 *
 * @package ntronica
 */

get_header();
$ntronica_category = get_queried_object();

$ntronica_products_query = new WP_Query(
	array(
		'post_type'      => 'product',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_category',
				'field'    => 'slug',
				'terms'    => $ntronica_category->slug,
			),
		),
	)
);

$ntronica_intro_paragraphs = get_field('product_category_intro', 'product_category_' . $ntronica_category->term_id);
if (! is_array($ntronica_intro_paragraphs)) {
	$ntronica_intro_paragraphs = array();
}
?>
<section class="product-category" aria-labelledby="product-category-title">
	<div class="container">
		<h1 class="title product-category__title" id="product-category-title"><?php echo esc_html($ntronica_category->name); ?></h1>
		<?php if (! empty($ntronica_intro_paragraphs)) : ?>
			<div class="product-category__intro">
				<?php foreach ($ntronica_intro_paragraphs as $ntronica_row) : ?>
					<?php $ntronica_paragraph = is_array($ntronica_row) ? ($ntronica_row['paragraph'] ?? '') : ''; ?>
					<?php if ('' !== $ntronica_paragraph) : ?>
						<p class="text-block"><?php echo esc_html($ntronica_paragraph); ?></p>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ($ntronica_products_query->have_posts()) : ?>
			<div class="product-category__grid">
				<?php while ($ntronica_products_query->have_posts()) : $ntronica_products_query->the_post(); ?>
					<?php
					$ntronica_product_id    = get_the_ID();
					$ntronica_product_title = get_the_title();
					$ntronica_product_url   = get_permalink();
					$ntronica_product_image = get_the_post_thumbnail_url($ntronica_product_id, 'large');
					$ntronica_product_image = is_string($ntronica_product_image) ? $ntronica_product_image : '';
					?>
					<?php
					get_template_part('components/templates-parts/card', 'product', array(
						'title'    => $ntronica_product_title,
						'url'      => $ntronica_product_url,
						'image'    => $ntronica_product_image,
						'image_alt' => $ntronica_product_title,
						'width'    => 1351,
						'height'   => 1351,
						'modifier' => 'small',
					));
					?>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<div class="product-category__empty">
				<p class="text-block">No products found in this category.</p>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer();
