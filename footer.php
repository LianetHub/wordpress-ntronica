<?php

/**
 * Footer
 *
 * @package ntronica
 */
?>
</main>
<footer class="footer band-full">
	<div class="container">
		<div class="row footer__grid g-4">
			<div class="col-12 col-xxl-3 footer__copy">
				<div class="row">
					<div class="col-12 col-md-4 col-xxl-12">
						<p class="footer__year">Copyright (c) 2025-2026</p>
					</div>
					<div class="col-12 col-md-8 col-xxl-12">
						<p class="footer__company">Nanotronica India
							<span class="footer__company--desktop-text">Private Limited Company</span>
							<span class="footer__company--tablet-text">Pvt Ltd</span>
							<span class="footer__company--mobile-text">Private Limited</span>
						</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<ul class="feature-list">
					<li data-label="Mail" data-label-short="Eml">
						<a href="mailto:contact@ntronica.com">contact@ntronica.com</a> <br>
						<a href="mailto:business@ntronica.com">business@ntronica.com</a>
					</li>
					<li data-label="Tel">
						<a href="tel:+912212345678">+91 221-234-5678</a>
					</li>
					<li data-label="Web">
						<a href="https://www.ntronica.com">www.ntronica.com</a>
					</li>
				</ul>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<address class="footer__address" data-label="Add">
					8 Ulsoor Road, Yellapa Chetty Layout, Ulsoor, Bangaluru, Karnataka, 560042,&nbsp;India
				</address>
			</div>

			<div class="col-12 col-md-4 col-xxl-3">
				<div class="footer__links">
					<div class="footer__search">
						<?php get_search_form(array('ntronica_variant' => 'footer')); ?>
					</div>
					<div class="footer__policies">
						<a class="footer__link" href="#">Privacy policy</a>
						<a class="footer__link" href="#">Terms of use</a>
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