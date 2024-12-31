<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Sanitize uploaded filenames
function devops_sanitize_filenames( $filename ) {

	// Convert to ASCII
	$sanitized_filename = remove_accents( $filename );

	// Replace invalid characters
	$invalid = array(
		' '   => '-',
		'%20' => '-',
		'_'   => '-',
	);
	$sanitized_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_filename );

	$sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); // Remove all non-alphanumeric except .
	$sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); // Remove all but last .
	$sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); // Replace any more than one - in a row
	$sanitized_filename = str_replace('-.', '.', $sanitized_filename); // Remove last - if at the end
	$sanitized_filename = strtolower( $sanitized_filename ); // Lowercase

	// Allow further customization via filter
	return apply_filters( 'devops_sanitize_filenames', $sanitized_filename, $filename );
}
add_filter( 'sanitize_file_name', 'devops_sanitize_filenames', 10, 1 );