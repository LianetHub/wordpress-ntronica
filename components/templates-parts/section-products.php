<?php

/**
 * Section: Products — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title      = get_field('products_title');
$ntronica_lead       = get_field('products_lead');
$ntronica_items      = get_field('products_items');
$ntronica_link_url   = get_field('products_link_url');
$ntronica_link_text  = get_field('products_link_text');

$ntronica_title     = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : 'Products';
$ntronica_lead      = is_string($ntronica_lead) ? $ntronica_lead : '';
$ntronica_link_url  = is_string($ntronica_link_url) && '' !== $ntronica_link_url ? $ntronica_link_url : home_url('/products/');
$ntronica_link_text = is_string($ntronica_link_text) && '' !== $ntronica_link_text ? $ntronica_link_text : 'LEARN MORE';
?>
<section class="products" id="products">
	<div class="container">
		<h2 class="title products__title"><?php echo esc_html($ntronica_title); ?></h2>
		<?php if ('' !== $ntronica_lead) : ?>
		<p class="text-block products__lead"><?php echo esc_html($ntronica_lead); ?></p>
		<?php endif; ?>

		<?php if (! empty($ntronica_items) && is_array($ntronica_items)) : ?>
		<div class="row products__grid">
			<?php foreach ($ntronica_items as $ntronica_item) : ?>
				<?php
				$ntronica_item_title = isset($ntronica_item['title']) ? (string) $ntronica_item['title'] : '';
				$ntronica_item_url   = isset($ntronica_item['url']) ? (string) $ntronica_item['url'] : '';
				$ntronica_item_image = isset($ntronica_item['image']) ? (string) $ntronica_item['image'] : '';

				if ('' === $ntronica_item_title || '' === $ntronica_item_url) {
					continue;
				}
				?>
				<div class="col-12 col-md-4">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'  => $ntronica_item_title,
							'url'    => $ntronica_item_url,
							'image'  => '' !== $ntronica_item_image ? $ntronica_item_image : IMG_PATH . '/home/product-thin-films.webp',
							'width'  => 622,
							'height' => 414,
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<div class="products__more">
			<a class="link-more" href="<?php echo esc_url($ntronica_link_url); ?>" data-title="<?php echo esc_attr($ntronica_link_text); ?>">
				<span><?php echo esc_html($ntronica_link_text); ?></span>
			</a>
		</div>
	</div>
</section>
