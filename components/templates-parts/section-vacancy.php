<?php

/**
 * Single vacancy: hero facts and two lists.
 *
 * Mock copy lives in the template. It is not loaded from fields.
 *
 * @package ntronica
 */

$ntronica_facts = array(
	array(
		'label' => 'TEAM',
		'value' => 'Customer support',
	),
	array(
		'label' => 'WORK EXPERIENCE',
		'value' => '2-3 years',
	),
	array(
		'label' => 'EDUCATION BACKGROUND',
		'value' => 'Physics, Computer Science, Chemical Engineering, Materials Science',
	),
);

$ntronica_lists = array(
	array(
		'title' => 'Responsibilities',
		'items' => array(
			'Evaluate and diagnose problems and make appropriate repairs',
			'Work with co-workers, customer & field support in isolating and solving problems',
			'Maintain and optimize equipment on a daily basis to enhance functionality and prevent problems',
			'Customer interface: daily machine status, PM status, machine time, P/T in/out communication with customer',
			'Perform administrative and coordination duties, including pass-downs, work orders, field service reports, system problem reports, and monthly reports',
			'Prepare written technical reports on an independent basis',
			'Handling tool/parts for service actions with high quality',
			'Should expect to spend more than 50% of the time inside the clean room working with mechanical and electrical equipment',
			'Can work flexibly, can accept overtime working',
			'Have initiative to communicate with colleagues and learn from them',
			'Can accept manager/leader’s flexible arrangement based on company business needs',
		),
	),
	array(
		'title' => 'Requirements',
		'items' => array(
			'Bachelor degree in an engineering field or equivalent experience, mechanical aptitude, and knowledge of pneumatics, hydraulics, electronics, semiconductor processes, relevant software, and related',
			'Knowledge of safety procedures required',
			'Sufficient oral and written English level',
			'Good communication skill - Good cooperation with team members',
			'Flexibility for OT , working in holidays',
			'Strong ownership and commitment level',
			'Active in learning, eager to dig into technical detail',
		),
	),
);
?>
<article class="vacancy">
	<div class="vacancy__hero">
		<div class="container">
			<h1 class="title vacancy__title"><?php the_title(); ?></h1>

			<div class="row vacancy__facts">
				<?php foreach ($ntronica_facts as $ntronica_fact) : ?>
					<div class="col-12 col-md-4">
						<p class="text-block vacancy__label"><?php echo esc_html($ntronica_fact['label']); ?></p>
						<p class="text-block vacancy__value"><?php echo esc_html($ntronica_fact['value']); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="vacancy__body">
		<div class="container">
			<div class="row vacancy__lists">
				<?php foreach ($ntronica_lists as $ntronica_list) : ?>
					<div class="col-12 col-md-6">
						<h2 class="subtitle fs-italic vacancy__subtitle"><?php echo esc_html($ntronica_list['title']); ?></h2>
						<ul class="feature-list">
							<?php foreach ($ntronica_list['items'] as $ntronica_item) : ?>
								<li><?php echo esc_html($ntronica_item); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</article>