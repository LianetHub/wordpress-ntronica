<?php
/**
 * Product category: responsive mock catalogue.
 *
 * @package ntronica
 */

get_header();
$ntronica_category = get_queried_object();
$ntronica_catalog = array(
	array('title' => 'plasma 200-01', 'image' => 'plasma'),
	array('title' => 'tuman 200-02', 'image' => 'tuman'),
	array('title' => 'tuman 200 W', 'image' => 'tuman-w'),
	array('title' => 'magna 200-01', 'image' => 'plasma'),
	array('title' => 'magna 200-04', 'image' => 'plasma'),
	array('title' => 'cluster', 'image' => 'tuman'),
	array('title' => 'изофаз', 'image' => 'tuman-w'),
);
$ntronica_intro = ntronica_get_product_category_intro($ntronica_category->slug);
?>
<section class="product-category" aria-labelledby="product-category-title">
	<div class="container">
		<h1 class="title product-category__title" id="product-category-title"><?php echo esc_html(ntronica_get_product_category_display_name($ntronica_category)); ?></h1>
		<?php if ($ntronica_intro) : ?>
			<div class="product-category__intro">
				<?php foreach ($ntronica_intro as $ntronica_paragraph) : ?>
					<p class="text-block"><?php echo esc_html($ntronica_paragraph); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="product-category__grid">
			<?php foreach ($ntronica_catalog as $ntronica_item) : ?>
				<?php get_template_part('components/templates-parts/card', 'product', array(
					'title' => $ntronica_item['title'],
					'url' => home_url('/products/etching/plasma-200-01/'),
					'image' => IMG_PATH . '/products/catalog/' . $ntronica_item['image'] . '.webp',
					'image_alt' => $ntronica_item['title'] . ' semiconductor manufacturing equipment',
					'width' => 1351,
					'height' => 1351,
					'modifier' => 'small',
				)); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php get_footer();
