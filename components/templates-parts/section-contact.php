<?php

/**
 * Section: Contact us — powered by ACF
 *
 * @package ntronica
 */

$ntronica_title       = get_field('ntronica_contact_title', 'option');
$ntronica_form_id     = get_field('ntronica_contact_form_id', 'option');

$ntronica_title   = is_string($ntronica_title) && '' !== $ntronica_title ? $ntronica_title : '';
$ntronica_form_id = is_string($ntronica_form_id) && '' !== $ntronica_form_id ? $ntronica_form_id : '';
?>
<section class="contact" id="contacts">
    <div class="container">
        <h2 class="title contact__title"><?php echo esc_html($ntronica_title); ?></h2>
        <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($ntronica_form_id) . '" title="Contact us form"]'); ?>
    </div>
</section>
