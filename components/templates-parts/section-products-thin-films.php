<?php

/**
 * Products: Thin films equipment
 *
 * @package ntronica
 */

$ntronica_title    = isset($args['title']) ? $args['title'] : 'Thin films equipment';
$ntronica_intro_c1 = isset($args['intro_c1']) ? $args['intro_c1'] : '';
$ntronica_intro_c2 = isset($args['intro_c2']) ? $args['intro_c2'] : '';
$ntronica_items    = isset($args['items']) && is_array($args['items']) ? $args['items'] : array();
?>
<section class="products-thin-films" id="thin-films">
	<div class="container">
		<h2 class="title products-thin-films__title"><?php echo esc_html($ntronica_title); ?></h2>

		<?php if ('' !== $ntronica_intro_c1 || '' !== $ntronica_intro_c2) : ?>
		<div class="row products-thin-films__intro">
			<?php if ('' !== $ntronica_intro_c1) : ?>
			<div class="col-12 col-md-6">
				<div class="text-block products-thin-films__text">
					<p><?php echo esc_html($ntronica_intro_c1); ?></p>
				</div>
			</div>
			<?php endif; ?>
			<?php if ('' !== $ntronica_intro_c2) : ?>
			<div class="col-12 col-md-6">
				<div class="text-block-alternate products-thin-films__text">
					<p><?php echo esc_html($ntronica_intro_c2); ?></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if (! empty($ntronica_items)) : ?>
		<div class="row products-thin-films__grid">
			<?php foreach ($ntronica_items as $ntronica_item) :
				$ntronica_title_text = isset($ntronica_item['title']) ? $ntronica_item['title'] : '';
				$ntronica_image      = isset($ntronica_item['image']) ? $ntronica_item['image'] : '';
				$ntronica_alt        = isset($ntronica_item['alt']) && '' !== $ntronica_item['alt'] ? $ntronica_item['alt'] : $ntronica_title_text;
			?>
				<div class="col-6 col-md-3">
					<?php
					get_template_part(
						'components/templates-parts/card',
						'product',
						array(
							'title'     => $ntronica_title_text,
							'url'       => ntronica_get_product_category_url($ntronica_title_text),
							'image'     => '' !== $ntronica_image ? $ntronica_image : IMG_PATH . '/products/' . sanitize_title($ntronica_title_text) . '.webp',
							'image_alt' => $ntronica_alt,
							'width'     => 461,
							'height'    => 307,
						)
					);
					?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>
</section>