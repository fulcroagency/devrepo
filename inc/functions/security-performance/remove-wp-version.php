<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// remove WP version info from styles and scripts
function devops_remove_wp_version( $src ) {
	global $wp_version;

	$version_str = '?ver='.$wp_version;
	$offset = strlen( $src ) - strlen( $version_str );

	if ( $offset >= 0 && strpos($src, $version_str, $offset) !== FALSE )
		return substr( $src, 0, $offset );

	return $src;
}
add_filter( 'script_loader_src', 'devops_remove_wp_version' );
add_filter( 'style_loader_src', 'devops_remove_wp_version' );