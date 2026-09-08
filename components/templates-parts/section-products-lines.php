<?php

/**
 * Products: Wet process equipment and Process control
 *
 * @package ntronica
 */

$ntronica_products_img = IMG_PATH . '/products/';

$ntronica_lines_text = 'It may require more than one hundred tools to produce a single modern chip. Our goal is to cover at least half of those tools — whether you are performing research & development or running mass production. We are currently present across multiple stages of chip production, such as etching and deposition, epitaxy, thermal operations, and Chemical Mechanical Planarization (CMP).';

$ntronica_lines = array(
	array(
		'id'    => 'wet-process',
		'title' => 'Wet process equipment',
		'text'  => $ntronica_lines_text,
		'items' => array(
			array(
				'title' => 'Planarization',
				'file'  => 'planarization.webp',
				'alt'   => 'Planarization equipment close-up',
			),
		),
	),
	array(
		'id'    => 'process-control',
		'title' => 'Process control',
		'text'  => $ntronica_lines_text,
		'items' => array(
			array(
				'title' => 'Metrology',
				'file'  => 'metrology.webp',
				'alt'   => 'Optical sensor used in metrology',
			),
			array(
				'title' => 'Inspection & Analytics',
				'file'  => 'inspection.webp',
				'alt'   => 'Inspection and analytics optical equipment',
			),
		),
	),
);
?>
<section class="products-lines">
	<div class="container">
		<div class="row products-lines__layout">
			<?php foreach ($ntronica_lines as $ntronica_line) : ?>
				<div class="col-12 col-md-6 products-lines__col" id="<?php echo esc_attr($ntronica_line['id']); ?>">
					<h2 class="title products-lines__title"><?php echo esc_html($ntronica_line['title']); ?></h2>
					<div class="text-block products-lines__text">
						<p><?php echo esc_html($ntronica_line['text']); ?></p>
					</div>
					<div class="row products-lines__cards">
						<?php foreach ($ntronica_line['items'] as $ntronica_item) : ?>
							<div class="col-6">
								<?php
								get_template_part(
									'components/templates-parts/card',
									'product',
									array(
										'title'     => $ntronica_item['title'],
										'image'     => $ntronica_products_img . $ntronica_item['file'],
										'image_alt' => $ntronica_item['alt'],
										'width'     => 461,
										'height'    => 307,
									)
								);
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>