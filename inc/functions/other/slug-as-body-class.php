<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Add Page Slug as Body Class
function devops_slug_as_body_class( $classes ) {
    global $post;
        if ( isset( $post ) ) {
                $classes[] = $post->post_name;
                     }
                return $classes;
             }
add_filter( 'body_class', 'devops_slug_as_body_class' );