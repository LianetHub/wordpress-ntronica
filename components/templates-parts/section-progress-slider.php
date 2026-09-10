<?php

/**
 * Section: Technological Processes (Progress Slider)
 *
 * @package ntronica
 */

$ntronica_home_img = IMG_PATH . '/home/';

$ntronica_processes = array(
	array(
		'title'  => 'Epitaxy',
		'index'  => '1',
		'image'  => $ntronica_home_img . 'process-epitaxy.jpg',
		'text_1' => 'Epitaxy is the process of growing a crystalline layer on a substrate, where the new layer inherits the crystal orientation of the wafer. In GaN MOCVD (Metal-Organic Chemical Vapor Deposition), metalorganic precursors and hydride gases like ammonia react on heated substrate to form thin films of gallium nitride and III-N compounds.',
		'text_2' => 'Metalorganic precursors and ammonia react on a heated substrate to form thin films. This process is essential for manufacturing high-frequency and high-power devices, including HEMTs, UHF transistors, LEDs, and laser diodes. The quality of the epitaxial layer directly determines the electrical and optical performance of the final device.',
	),
	array(
		'title'  => 'Deposition',
		'index'  => '2',
		'image'  => $ntronica_home_img . 'process-deposition.jpg',
		'text_1' => 'Deposition refers to the application of thin films of dielectric, semiconductor, or metal materials onto a wafer surface. Techniques such as PECVD, ICP-CVD, and sputtering are commonly used to deposit layers like SiO₂, Si₃N₄, and various metals.',
		'text_2' => 'Deposition refers to the application of thin films of dielectric, semiconductor, or metal materials onto a wafer surface. Techniques such as PECVD, ICP-CVD, and sputtering are commonly used to deposit layers like SiO₂, Si₃N₄, and various metals.',
	),
	array(
		'title'  => 'Etching',
		'index'  => '3',
		'image'  => $ntronica_home_img . 'process-etching.jpg',
		'text_1' => 'Etching is the selective removal of material from the wafer surface to transfer patterns defined by lithography. It is broadly classified into wet (chemical) and dry (plasma-based) etching. Dry etching, including RIE (Reactive Ion Etching) and ICP (Inductively Coupled Plasma), provides directional (anisotropic) profiles essential for fine feature definition.',
		'text_2' => 'Etching is the selective removal of material from the wafer surface to transfer patterns defined by lithography. It is broadly classified into wet (chemical) and dry (plasma-based) etching. Dry etching, including RIE (Reactive Ion Etching) and ICP (Inductively Coupled Plasma), provides directional (anisotropic) profiles essential for fine feature definition.',
	),
	array(
		'title'  => 'Thermal processing',
		'index'  => '4',
		'image'  => $ntronica_home_img . 'process-thermal.jpg',
		'text_1' => 'Thermal operations use controlled heating to modify material properties without melting the wafer. Rapid Thermal Annealing (RTA) heats the wafer quickly (typically >50°C/s) to activate dopants after ion implantation, repair crystal damage, or form silicides and ohmic contacts.',
		'text_2' => 'It is also used for rapid thermal oxidation (RTO) and nitridation (RTN). The short, precisely controlled thermal cycles minimize dopant diffusion and thermal budget, which is critical for maintaining shallow junctions and small feature geometries.',
	),
	array(
		'title'  => 'Planarization',
		'index'  => '5',
		'image'  => $ntronica_home_img . 'process-planarization.jpg',
		'text_1' => 'Chemical Mechanical Planarization (CMP) is a process that combines chemical etching with mechanical polishing to flatten the wafer surface. It removes topographic variations caused by previous process steps, such as deposition or etching, creating a globally flat surface.',
		'text_2' => 'Planarization is critical for multilevel interconnects, as uneven surfaces cause photolithography focus issues and poor step coverage. Post-CMP cleaning removes slurry residues and particles, restoring a clean surface for the next step.',
	),
	array(
		'title'  => 'Metrology',
		'index'  => '6',
		'image'  => $ntronica_home_img . 'process-metrology.jpg',
		'text_1' => 'Metrology, inspection, and analytics encompass all measurements and tests used to verify that a wafer meets specifications before proceeding to the next process step. Metrology measures physical properties such as film thickness, refractive index, and line width.',
		'text_2' => '',
	),
	array(
		'title'  => 'Inspection & Analytics',
		'index'  => '7',
		'image'  => $ntronica_home_img . 'process-inspection.jpg',
		'text_1' => 'Inspection detects defects (particles, scratches, pattern anomalies) using optical or electron beam tools. Analytics includes spectroscopic and imaging techniques to identify contamination or process drift. These processes are distributed throughout the manufacturing flow to monitor quality, control yields, and enable rapid feedback to upstream equipment.',
		'text_2' => '',
	),
);
?>
<section class="progress-slider" id="processes">
	<div class="container">
		<h2 class="title-md progress-slider__header">Technological processes</h2>

		<div class="swiper progress-slider__slider">
			<div class="swiper-wrapper">
				<?php foreach ($ntronica_processes as $ntronica_item) : ?>
					<div class="swiper-slide progress-slider__slide" background-image="<?php echo esc_url($ntronica_item['image']); ?>">

						<div class="progress-slider__body">
							<h3 class="subtitle progress-slider__process-title">
								<?php echo esc_html($ntronica_item['title']); ?>
							</h3>

							<div class="row progress-slider__text-row">
								<div class="col-12 col-md-6">
									<p class="text-block">
										<?php echo esc_html($ntronica_item['text_1']); ?>
									</p>
								</div>
								<?php if (! empty($ntronica_item['text_2'])) : ?>
									<div class="col-12 col-md-6">
										<p class="text-block">
											<?php echo esc_html($ntronica_item['text_2']); ?>
										</p>
									</div>
								<?php endif; ?>
							</div>

							<div class="progress-slider__footer">
								<button
									type="button"
									class="swiper-button-prev"
									aria-label="Previous process"></button>
								<span class="progress-slider__index"><?php echo esc_html($ntronica_item['index']); ?></span>
								<button
									type="button"
									class="swiper-button-next"
									aria-label="Next process"></button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>