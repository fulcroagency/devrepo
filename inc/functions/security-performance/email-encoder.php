<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Define default filter priority
if ( ! defined( 'DEE_FILTER_PRIORITY' ) ) {
	define( 'DEE_FILTER_PRIORITY', 1000 );
}

// Register filters to encode email addresses in various content areas
foreach ( array( 'the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt' ) as $filter ) {
	add_filter( $filter, 'devops_ee_encode_emails', DEE_FILTER_PRIORITY );
}

// Check if shortcocde option is enabled
function devops_ee_shortcode_is_enabled() {
    $options = devops_security_performance_options(); // get options
    return ($options['email_encoder']['shortcode'] ?? 0) == 1; // default to 0
} 
// if enabled add action
if (devops_ee_shortcode_is_enabled()) {
	// Register the [encode] shortcode
	add_action( 'init', 'devops_ee_register_shortcode', 1000 );
}


/*** Functions ***/

// Register the [encode] shortcode
function devops_ee_register_shortcode() {
	if ( ! shortcode_exists( 'encode' ) ) {
		add_shortcode( 'encode', 'devops_ee_shortcode' );
	}
}

// Shortcode callback to encode text
function devops_ee_shortcode( $attributes, $content = '' ) {
    return devops_ee_encode_str( $content );
}

// Encode email addresses in a given string
function devops_ee_encode_emails( $string ) {

	if ( ! is_string( $string ) ) {
		return $string; // Skip if not a string
	}

	if ( apply_filters( 'devops_ee_at_sign_check', true ) && strpos( $string, '@' ) === false ) {
		return $string; // Skip if no @ sign is found
	}

	$method = apply_filters( 'devops_ee_method', 'devops_ee_encode_str' );
	$regexp = apply_filters(
		'devops_ee_regexp',
		'{
			(?:mailto:)?
			(?:
				[-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
			|
				".*?"
			)
			\@
			(?:
				[-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
			|
				\[[\d.a-fA-F:]+\]
			)
		}xi'
	);

	return preg_replace_callback( $regexp, function ( $matches ) use ( $method ) {
		return $method( $matches[0] );
	}, $string );
}

// Encode string by converting characters to HTML entities
function devops_ee_encode_str( $string ) {

	$chars = str_split( $string );
	$seed = mt_rand( 0, (int) abs( crc32( $string ) / strlen( $string ) ) );

	foreach ( $chars as $key => $char ) {

		$ord = ord( $char );

		if ( $ord < 128 ) { // Ignore non-ASCII chars

			$r = ( $seed * ( 1 + $key ) ) % 100; // Pseudo-random function

			if ( $r > 60 && $char !== '@' && $char !== '.' ) ; // Keep plain for some chars
			else if ( $r < 45 ) $chars[ $key ] = '&#x' . dechex( $ord ) . ';'; // Hexadecimal
			else $chars[ $key ] = '&#' . $ord . ';'; // Decimal
		}
	}
	return implode( '', $chars );
}