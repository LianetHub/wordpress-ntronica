<?php
/**
 * Theme helpers
 *
 * @package ntronica
 */

/**
 * Estimate reading time in minutes.
 *
 * @param int|null $post_id            Post ID.
 * @param int      $wpm                Words per minute.
 * @param int      $seconds_per_image  Extra seconds per image.
 * @return int
 */
function ntronica_get_reading_time( $post_id = null, $wpm = 200, $seconds_per_image = 5 ) {
	$post_id = $post_id ? (int) $post_id : get_the_ID();
	$html    = apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) );
	$words   = str_word_count( wp_strip_all_tags( $html ) );

	preg_match_all( '/<img\b[^>]*>/i', $html, $matches );
	$images = count( $matches[0] );
	$words += ( $images * $seconds_per_image ) * $wpm / 60;

	return max( 1, (int) ceil( $words / $wpm ) );
}

/**
 * Print reading time string.
 *
 * @param int|null $post_id Post ID.
 * @param string   $before  Prefix.
 * @param string   $after   Suffix.
 */
function ntronica_the_reading_time( $post_id = null, $before = '', $after = ' мин. читать' ) {
	printf(
		'%s%d%s',
		$before,
		ntronica_get_reading_time( $post_id ),
		$after
	);
}
