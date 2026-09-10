<?php

/**
 * Section: Open positions
 *
 * @package ntronica
 */

$vacancies = array(
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
	),
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
	),
	array(
		'date'    => '25.01.2023',
		'title'   => 'Lorem ipsum dolor consectetuer',
		'excerpt' => 'Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat nostrud exerci tation',
	),
);

?>
<section class="vacancies" id="careers">
	<div class="container">
		<h2 class="title vacancies__title">
			Open positions
		</h2>

		<div class="row vacancies__grid">
			<?php foreach ($vacancies as $ntronica_item) : ?>
				<div class="col-12 col-md-4">
					<a href="#" class="vacancy-card">
						<span class="text-block vacancy-card__date"><?php echo esc_html($ntronica_item['date']); ?></span>
						<span class="subtitle vacancy-card__title"><?php echo esc_html($ntronica_item['title']); ?></span>
						<span class="text-lead vacancy-card__excerpt"><?php echo esc_html($ntronica_item['excerpt']); ?></span>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>