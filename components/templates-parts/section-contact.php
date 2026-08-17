<?php

/**
 * Section: Contact us (static form)
 *
 * @package ntronica
 */
?>
<section class="contact" id="contacts">
	<div class="container">
		<h2 class="section-title contact__title">Contact us</h2>

		<form class="home-form" action="#" method="post" enctype="multipart/form-data">
			<div class="row home-form__row home-form__row--primary">
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-name">Name*</label>
						<input class="home-form__input" type="text" id="contact-name" name="name" required autocomplete="name" placeholder="Enter your name">
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-email">E-mail*</label>
						<input class="home-form__input" type="email" id="contact-email" name="email" required autocomplete="email">
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field home-form__field--phone">
						<label class="home-form__label" for="contact-phone">Phone number</label>
						<input class="home-form__input" type="tel" id="contact-phone" name="phone" autocomplete="tel">
					</div>
				</div>
			</div>

			<div class="row home-form__row home-form__row--message">
				<div class="col-12 col-md-6 col-xl-8">
					<div class="home-form__field">
						<label class="home-form__label" for="contact-message">Message</label>
						<textarea class="home-form__textarea" id="contact-message" name="message" rows="1"></textarea>
					</div>
				</div>
				<div class="col-12 col-md-6 col-xl-4">
					<div class="home-form__field">
						<label class="home-form__file" for="contact-file">
							<span>ADD FILE</span>
							<input type="file" id="contact-file" name="file">
						</label>
					</div>
				</div>
			</div>

			<div class="home-form__actions">
				<button class="home-form__submit" type="submit">SEND REQUEST</button>
				<label class="home-form__consent">
					<input class="home-form__checkbox" type="checkbox" name="consent" value="1" required>
					<span>By submitting this form, I agree to the Privacy Policy &amp; Terms of Service</span>
				</label>
			</div>
		</form>
	</div>
</section>