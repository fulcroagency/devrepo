<?
if ( ! defined( 'ABSPATH' ) ) exit;

// Define default filter priority
if ( ! defined( 'EE_FILTER_PRIORITY' ) ) {
	define( 'EE_FILTER_PRIORITY', 1000 );
}

// Register filters to encode email addresses in various content areas
foreach ( array( 'the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt' ) as $filter ) {
	add_filter( $filter, 'ee_encode_emails', EE_FILTER_PRIORITY );
}

// Register the [encode] shortcode
add_action( 'init', 'ee_register_shortcode', 1000 );

function ee_register_shortcode() {
	if ( ! shortcode_exists( 'encode' ) ) {
		add_shortcode( 'encode', 'ee_shortcode' );
	}
}

// Shortcode callback to encode text
function ee_shortcode( $attributes, $content = '' ) {
    return ee_encode_str( $content );
}

// Encode email addresses in a given string
function ee_encode_emails( $string ) {

	if ( ! is_string( $string ) ) {
		return $string; // Skip if not a string
	}

	if ( apply_filters( 'ee_at_sign_check', true ) && strpos( $string, '@' ) === false ) {
		return $string; // Skip if no @ sign is found
	}

	$method = apply_filters( 'ee_method', 'ee_encode_str' );
	$regexp = apply_filters(
		'ee_regexp',
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
function ee_encode_str( $string ) {

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