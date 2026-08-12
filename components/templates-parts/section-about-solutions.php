<?php
/**
 * About: Technological processes / solutions
 *
 * @package ntronica
 */

$ntronica_about_img = IMG_PATH . '/about/';
?>
<section class="section-about-solutions content-rail" id="solutions">
	<div class="content-rail__inner">
		<p class="section-about-solutions__lead"><?php esc_html_e( 'We develop and manufacture solutions for the following technological processes.', 'ntronica' ); ?></p>

		<div class="row section-about-solutions__grid">
			<div class="col-12 col-md-4">
				<article class="section-about-solutions__item">
					<div class="section-about-solutions__media">
						<img
							class="section-about-solutions__img"
							src="<?php echo esc_url( $ntronica_about_img . 'thin-films.png' ); ?>"
							alt=""
							width="622"
							height="412"
						>
					</div>
					<h3 class="section-about-solutions__caption"><?php esc_html_e( 'Thin films equipment', 'ntronica' ); ?></h3>
				</article>
			</div>

			<div class="col-12 col-md-4">
				<article class="section-about-solutions__item">
					<div class="section-about-solutions__media">
						<img
							class="section-about-solutions__img"
							src="<?php echo esc_url( $ntronica_about_img . 'wet-process.png' ); ?>"
							alt=""
							width="622"
							height="413"
						>
					</div>
					<h3 class="section-about-solutions__caption"><?php esc_html_e( 'Wet process equipment', 'ntronica' ); ?></h3>
				</article>
			</div>

			<div class="col-12 col-md-4">
				<article class="section-about-solutions__item">
					<div class="section-about-solutions__media">
						<img
							class="section-about-solutions__img"
							src="<?php echo esc_url( $ntronica_about_img . 'process-control.png' ); ?>"
							alt=""
							width="622"
							height="413"
						>
					</div>
					<h3 class="section-about-solutions__caption"><?php esc_html_e( 'Process control', 'ntronica' ); ?></h3>
				</article>
			</div>
		</div>
	</div>
</section>
