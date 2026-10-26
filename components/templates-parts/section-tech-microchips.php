<?php

/**
 * Technology: All about microchips
 *
 * @package ntronica
 */

$ntronica_topics = array(
	array(
		'title' => 'What a chip is',
		'text'  => 'An integrated circuit is a network of transistors and passive elements formed in and on a single-crystal silicon. The transistor is the switch; enough of them create logic and memory. The structure is built by repeating deposition, lithography, etching, and heat treatment across the wafer. A modern die packs tens of billions of switches into a few square centimeters.',
	),
	array(
		'title' => 'How chips are made',
		'text'  => 'A wafer enters the fab bare and leaves carrying hundreds of finished dies. Between those points lie epitaxy, deposition, lithography, etching, doping, annealing, planarization and cleaning — each repeated for every layer. An advanced device takes 500 to 1,000 steps to complete and the wafer travels tens of kilometers inside the fab before diced.',
	),
	array(
		'title' => 'Why nanometers matter',
		'text'  => 'Printed features are smaller than the wavelength of visible light: a transistor gate is a few dozen atoms across, while a human hair is 100,000 nm wide. At that scale, one particle, a fraction of a degree of drift, or a nanometer of misalignment turns a working die into scrap. Metrology is part of the process, and equipment is specified by how little it drifts rather than by how fast it runs.',
	),
	array(
		'title' => 'Moore’s law today',
		'text'  => 'In 1965, Gordon Moore noticed that transistor counts per chip were doubling every year, and the industry has tracked that curve ever since. Geometric shrink is slowing, so density now also comes from new architectures, materials, and stacking: 3D integration, GaN & SiC power devices, advanced packaging. Being first with a denser generation has always paid for the chipmakers.',
	),
);
?>
<section class="tech-microchips" id="microchips">
	<div class="container">
		<h2 class="tech-microchips__title title">All about microchips</h2>

		<div class="row tech-microchips__intro">
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>Microchips are the smallest structures humanity makes in volume — and the foundation of everything from a phone to a power grid. Here is what a chip is, how it is built layer by layer, and where our equipment fits into that flow.</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>A single die holds billions of transistors, formed through hundreds of steps on a wafer under a millimetre thick. Each step is spans the wafer with nanometre accuracy and needs dedicated equipment, process control and metrology.</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>Chips are classified in two ways: by what they do and by the circuitry inside them. By circuitry, a chip is analogue, digital, or mixed-signal. Digital circuits work with binary levels; analogue circuits handle continuous signals using resistors, capacitors, and inductors. By function, the main families are logic, memory, application-specific circuits (ASIC), and systems-on-chip (SoC), which combine analogue and digital blocks on one die. Power and RF devices on GaN and SiC form a class of their own — built on dedicated equipment and judged by breakdown voltage and thermal behaviour rather than by transistor count.</p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="text-block">
					<p>Manufacturing is a cycle repeated for every layer: deposit a film, print the pattern, etch it, clean, planarize, then measure. An advanced device stacks up to a hundred layers, each aligned to the one beneath it within a few nanometers. Several hundred steps and about three months separate a bare wafer from packaged chips — so yield depends less on any single tool than on how tightly the whole sequence is held. That is why metrology and inspection sit between the process steps rather than after them, and why a fab is kept thousands of times cleaner than outside air.</p>
				</div>
			</div>
		</div>

		<div class="row tech-microchips__cards" id="microchip-topics">
			<?php foreach ($ntronica_topics as $ntronica_topic) : ?>
				<div class="col-12 col-md-6">
					<div class="tech-microchips__card">
						<h3 class="subtitle fs-italic tech-microchips__heading"><?php echo esc_html($ntronica_topic['title']); ?></h3>
						<ul class="feature-list">
							<li><?php echo esc_html($ntronica_topic['text']); ?></li>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
