<?php
/**
 * Section: Contact us (static form)
 *
 * @package ntronica
 */
?>
<section class="section-contact content-rail" id="contacts">
	<div class="content-rail__inner">
		<h2 class="section-title section-contact__title"><?php esc_html_e( 'Contact us', 'ntronica' ); ?></h2>

		<form class="home-form" action="#" method="post" enctype="multipart/form-data">
			<div class="row home-form__row home-form__row--primary">
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-name"><?php esc_html_e( 'Name*', 'ntronica' ); ?></label>
						<input class="home-form__input" type="text" id="contact-name" name="name" required autocomplete="name" placeholder="<?php esc_attr_e( 'Enter your name', 'ntronica' ); ?>">
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-email"><?php esc_html_e( 'E-mail*', 'ntronica' ); ?></label>
						<input class="home-form__input" type="email" id="contact-email" name="email" required autocomplete="email">
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field home-form__field--phone">
						<label class="home-form__label" for="contact-phone"><?php esc_html_e( 'Phone number', 'ntronica' ); ?></label>
						<input class="home-form__input" type="tel" id="contact-phone" name="phone" autocomplete="tel">
					</div>
				</div>
			</div>

			<div class="row home-form__row home-form__row--message">
				<div class="col-12 col-md-6 col-xl-8">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-message"><?php esc_html_e( 'Message', 'ntronica' ); ?></label>
						<textarea class="home-form__textarea" id="contact-message" name="message" rows="1"></textarea>
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__file" for="contact-file">
							<span><?php esc_html_e( 'ADD FILE', 'ntronica' ); ?></span>
							<input type="file" id="contact-file" name="file">
						</label>
					</div>
				</div>
			</div>

			<div class="home-form__actions">
				<button class="home-form__submit" type="submit"><?php esc_html_e( 'SEND REQUEST', 'ntronica' ); ?></button>
				<label class="home-form__consent">
					<input class="home-form__checkbox" type="checkbox" name="consent" value="1" required>
					<span><?php esc_html_e( 'By submitting this form, I agree to the Privacy Policy & Terms of Service', 'ntronica' ); ?></span>
				</label>
			</div>
		</form>
	</div>
</section>
