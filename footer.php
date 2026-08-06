<?php
/**
 * Footer
 *
 * @package ntronica
 */
?>
		</main>
		<footer class="site-footer band-full">
			<div class="band-full__inner">
				<div class="row site-footer__grid g-4">
					<div class="col-12 col-xxl-3 site-footer__copy">
						<div class="row">
							<div class="col-12 col-md-4 col-xxl-12">
								<p class="site-footer__year"><?php esc_html_e( 'Copyright (c) 2025-2026', 'ntronica' ); ?></p>
							</div>
							<div class="col-12 col-md-8 col-xxl-12">
								<p class="site-footer__company"><?php esc_html_e( 'Nanotronica India Private Limited', 'ntronica' ); ?></p>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-4 col-xxl-3">
						<div class="site-footer__block site-footer__block--mail">
							<div class="site-footer__labels">
								<p>
									<span class="site-footer__label-full"><?php esc_html_e( 'Mail', 'ntronica' ); ?></span>
									<span class="site-footer__label-short"><?php esc_html_e( 'Eml', 'ntronica' ); ?></span>
								</p>
								<p>&nbsp;</p>
								<p><?php esc_html_e( 'Tel', 'ntronica' ); ?></p>
								<p><?php esc_html_e( 'Web', 'ntronica' ); ?></p>
							</div>
							<div class="site-footer__markers" aria-hidden="true">
								<span class="site-footer__marker site-footer__marker--mail"></span>
								<span class="site-footer__marker site-footer__marker--tel"></span>
								<span class="site-footer__marker site-footer__marker--web"></span>
							</div>
							<div class="site-footer__values">
								<p>contact@ntronica.com</p>
								<p>business@ntronica.com</p>
								<p>+91 221-234-5678</p>
								<p>www.ntronica.com</p>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-4 col-xxl-3">
						<div class="site-footer__block site-footer__block--add">
							<div class="site-footer__labels">
								<p><?php esc_html_e( 'Add', 'ntronica' ); ?></p>
							</div>
							<div class="site-footer__markers" aria-hidden="true">
								<span class="site-footer__marker site-footer__marker--add"></span>
							</div>
							<div class="site-footer__values">
								<p>8 Ulsoor Road, Yellapa</p>
								<p>Chetty Layout, Ulsoor,</p>
								<p>Bangaluru, Karnataka,</p>
								<p>560042, India</p>
							</div>
						</div>
					</div>

					<div class="col-12 col-md-4 col-xxl-3">
						<div class="site-footer__links">
							<a class="site-footer__search site-footer__link" href="#"><?php esc_html_e( 'Search', 'ntronica' ); ?></a>
							<div class="site-footer__policies">
								<a class="site-footer__link" href="#"><?php esc_html_e( 'Privacy policy', 'ntronica' ); ?></a>
								<a class="site-footer__link" href="#"><?php esc_html_e( 'Terms of use', 'ntronica' ); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div><!-- .site-body -->
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
