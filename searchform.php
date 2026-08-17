<?php

/**
 * Search form
 *
 * @package ntronica
 *
 * @var array $args Arguments from get_search_form().
 */

if (! isset($args) || ! is_array($args)) {
	$args = array();
}

$ntronica_variant = ! empty($args['ntronica_variant']) ? $args['ntronica_variant'] : '';
$ntronica_is_page = 'page' === $ntronica_variant;
$ntronica_search_id = wp_unique_id('search-');
$ntronica_form_class = 'search-form';
if ($ntronica_is_page) {
	$ntronica_form_class .= ' search-form--page';
} elseif ('footer' === $ntronica_variant) {
	$ntronica_form_class .= ' search-form--footer';
}
$ntronica_label_class = $ntronica_is_page ? 'search-form__label screen-reader-text' : 'search-form__label';
$ntronica_query = get_search_query(false);
$ntronica_has_value = '' !== $ntronica_query;
?>
<form
	role="search"
	method="get"
	class="<?php echo esc_attr($ntronica_form_class); ?>"
	action="<?php echo esc_url(home_url('/')); ?>">
	<label class="<?php echo esc_attr($ntronica_label_class); ?>" for="<?php echo esc_attr($ntronica_search_id); ?>">Search</label>
	<div class="search-form__field">
		<input
			type="search"
			id="<?php echo esc_attr($ntronica_search_id); ?>"
			class="search-form__input"
			name="s"
			value="<?php echo esc_attr($ntronica_query); ?>"
			autocomplete="off">
		<button type="button" class="search-form__clear" <?php echo $ntronica_has_value ? '' : ' hidden'; ?>>
			<span class="screen-reader-text">Clear</span>
			<?php ntronica_icon('clear', 'search-form__clear-icon'); ?>
		</button>
	</div>
	<button type="submit" class="search-form__submit screen-reader-text">Search</button>
</form>