<?php

/**
 * Products: Wet process equipment and Process control
 *
 * @package ntronica
 */

$ntronica_lines = isset($args['lines']) && is_array($args['lines']) ? $args['lines'] : array();
?>
<?php if (! empty($ntronica_lines)) : ?>
<section class="products-lines">
	<div class="container">
		<div class="row products-lines__layout">
			<?php foreach ($ntronica_lines as $ntronica_line) :
				$ntronica_line_id    = isset($ntronica_line['anchor_id']) ? $ntronica_line['anchor_id'] : '';
				$ntronica_line_title = isset($ntronica_line['title']) ? $ntronica_line['title'] : '';
				$ntronica_line_text  = isset($ntronica_line['text']) ? $ntronica_line['text'] : '';
				$ntronica_line_items = isset($ntronica_line['items']) && is_array($ntronica_line['items']) ? $ntronica_line['items'] : array();
			?>
				<div class="col-12 col-md-6 products-lines__col" id="<?php echo esc_attr($ntronica_line_id); ?>">
					<h2 class="title products-lines__title"><?php echo esc_html($ntronica_line_title); ?></h2>
					<div class="text-block products-lines__text">
						<p><?php echo esc_html($ntronica_line_text); ?></p>
					</div>
					<?php if (! empty($ntronica_line_items)) : ?>
					<div class="row products-lines__cards">
						<?php foreach ($ntronica_line_items as $ntronica_item) :
							$ntronica_item_title = isset($ntronica_item['title']) ? $ntronica_item['title'] : '';
							$ntronica_item_image = isset($ntronica_item['image']) ? $ntronica_item['image'] : '';
							$ntronica_item_alt   = isset($ntronica_item['alt']) && '' !== $ntronica_item['alt'] ? $ntronica_item['alt'] : $ntronica_item_title;
						?>
							<div class="col-6">
								<?php
								get_template_part(
									'components/templates-parts/card',
									'product',
									array(
										'title'     => $ntronica_item_title,
										'url'       => ntronica_get_product_category_url($ntronica_item_title),
										'image'     => '' !== $ntronica_item_image ? $ntronica_item_image : IMG_PATH . '/products/' . sanitize_title($ntronica_item_title) . '.webp',
										'image_alt' => $ntronica_item_alt,
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
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>
