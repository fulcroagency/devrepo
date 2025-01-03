<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;


function devops_users_security() {
    // get options
    $options = devops_security_performance_options();
    $config = $options['users_security']['config'] ?? 'all'; // default to "all" if not set
    
    // enable all options
    if ($config === 'all') {
        add_action('init', 'devops_prevent_user_enumeration', 25); // prevent enumeration
        add_filter('rest_endpoints', 'devops_restrict_rest_api_users_endpoints'); // restrict REST API
        add_action('template_redirect', 'devops_disable_author_pages'); // disable author pages
        
        // start remove author links
        add_filter('author_link', 'devops_remove_wp_author_link', 10, 2); // default WP
        /*
         * Function not used because the 'core/post-author-name' block is unregistered by the devops_unregister_core_block_post_author function and not used
         * add_filter('render_block', 'devops_remove_core_block_author_link', 10, 2 ); // Gutenberg core block
        */
        add_filter('generate_post_author_link', '__return_false'); // GeneratePress
        add_filter('generateblocks_dynamic_url_output', 'devops_remove_generateblocks_author_link', 10, 3 ); // GenerateBlocks
        
        add_filter('wp_sitemaps_users_query_args', 'devops_remove_users_sitemap'); // remove authors from sitemap
        // end remove author links
        
        // start remove author emails
        add_filter('get_the_author_meta', 'devops_wp_remove_author_email', 10, 2 ); // default WP
        add_filter('generateblocks_dynamic_content_output', 'devops_remove_generateblocks_email_content_output', 10, 3 ); // GenerateBlocks Content Type output
        add_filter('generateblocks_dynamic_url_output', 'devops_remove_generateblocks_email_url_output', 10, 3 ); // GenerateBlocks Link Type output
        // end remove author emails end
        
        // start remove author names
        add_filter('the_author', '__return_empty_string'); // default WP
        add_action('init', 'devops_unregister_core_block_post_author', 25); // Gutenberg core block
        add_filter('generate_post_author_output', '__return_empty_string'); // GeneratePress
        add_filter('generateblocks_dynamic_content_output', 'devops_remove_generateblocks_name_content_output', 10, 3 ); // GenerateBlocks Content Type output
        // end remove author names
        return;
    }
    
    // enable selected custom options
    if ($config === 'custom') {
        
        // prevent enumeration
        if (($options['users_security']['enumeration'] ?? 0) == 1) {
            add_action('init', 'devops_prevent_user_enumeration', 25);
        }
        
        // restrict REST API
        if (($options['users_security']['restrict_rest_api'] ?? 0) == 1) {
            add_filter('rest_endpoints', 'devops_restrict_rest_api_users_endpoints');
        }
        
        // disable author pages
        if (($options['users_security']['disable_author_pages'] ?? 0) == 1) {
            add_action('template_redirect', 'devops_disable_author_pages');
        }
        
        // remove author links
        if (($options['users_security']['remove_author_links'] ?? 0) == 1) {
            add_filter('author_link', 'devops_remove_wp_author_link', 10, 2); // default WP
            add_filter('render_block', 'devops_remove_core_block_author_link', 10, 2 ); // Gutenberg core block
            add_filter('generate_post_author_link', '__return_false' ); // GeneratePress
            add_filter('generateblocks_dynamic_url_output', 'devops_remove_generateblocks_author_link', 10, 3 ); // GenerateBlocks
            
            add_filter('wp_sitemaps_users_query_args', 'devops_remove_users_sitemap'); // remove authors from sitemap
        }
        
        // remove author emails
        if (($options['users_security']['remove_author_emails'] ?? 0) == 1) {
            add_filter('get_the_author_meta', 'devops_wp_remove_author_email', 10, 2 ); // default WP
            add_filter('generateblocks_dynamic_content_output', 'devops_remove_generateblocks_email_content_output', 10, 3 ); // GenerateBlocks Content Type output
            add_filter('generateblocks_dynamic_url_output', 'devops_remove_generateblocks_email_url_output', 10, 3 ); // GenerateBlocks Link Type output
        }
        
        // remove author names
        if (($options['users_security']['remove_author_names'] ?? 0) == 1) {
            add_filter('the_author', '__return_empty_string'); // default WP
            add_action('init', 'devops_unregister_core_block_post_author', 25); // Gutenberg core block
            add_filter('generate_post_author_output', '__return_empty_string'); // GeneratePress
            add_filter('generateblocks_dynamic_content_output', 'devops_remove_generateblocks_name_content_output', 10, 3 ); // GenerateBlocks Content Type output
        }
    }
}
add_action('init', 'devops_users_security', 20);
    
/*** Functions ***/

// Prevent enumeration
function devops_prevent_user_enumeration() {
    if (isset($_GET['author']) && is_numeric($_GET['author'])) {
        wp_redirect(home_url()); // Redirect to home
        exit;
    }
}


// Disable REST API user endpoints
function devops_restrict_rest_api_users_endpoints($endpoints) {
    
    if (!is_user_logged_in()) {
        if (isset($endpoints['/wp/v2/users'])) {
            unset($endpoints['/wp/v2/users']);
        }
        if (isset($endpoints['/wp/v2/users/(?P<id>[\\d]+)'])) {
            unset($endpoints['/wp/v2/users/(?P<id>[\\d]+)']);
        }
    }
    return $endpoints;
}


// Disable author pages
function devops_disable_author_pages() {
    if (is_author()) {
        wp_redirect(home_url()); // Redirect to home
        exit;
    }
}


/*** 
 * 
 * START
 * 
 * Remove Author Links 
 * 
 * ***/

// WP Default
function devops_remove_wp_author_link($url, $author_id) {
    return '#'; // add # instead of link to author's page
}

// Gutenberg Core Block
function devops_remove_core_block_author_link( $block_content, $block ) {
    if ( $block['blockName'] === 'core/post-author-name' ) {
        $block_content = preg_replace(
            '/<a[^>]*>(.*?)<\/a>/i',
            '$1',
            $block_content
        );
    }
    return $block_content;
}

// GenerateBlocks
function devops_remove_generateblocks_author_link( $url, $attributes, $block ) {
    // Check if the link type is 'author-archives'
    if (isset($attributes['dynamicLinkType']) && $attributes['dynamicLinkType'] === 'author-archives') {
        return ''; // Return an empty value for 'author-archives'
    }
    return $url;
}

/*** END ***/


/*** 
 * 
 * START
 * 
 * Disable Author Emails 
 * 
 * ***/

// Default WP
function devops_wp_remove_author_email( $value, $field ) {
    if ( $field === 'user_email' ) {
        return ''; // return empty
    }
    return $value;
}

// GenerateBlocks - Content Type
function devops_remove_generateblocks_email_content_output($content, $attributes, $block) {
    // Check if the dynamic content type is 'author-email'
    if (isset($attributes['dynamicContentType']) && $attributes['dynamicContentType'] === 'author-email') {
        return ''; // Remove dynamic content of type 'author-email'
    }
    return $content;
}
// GenerateBlocks - Link Type
function devops_remove_generateblocks_email_url_output($url, $attributes, $block) {
    // Check if the link type is 'author-email'
    if (isset($attributes['dynamicLinkType']) && $attributes['dynamicLinkType'] === 'author-email') {
        return ''; // Remove URL for 'author-email' link type
    }
    return $url;
}

/*** END ***/


/*** 
 * 
 * START
 * 
 * Disable Author Names
 * 
 * ***/


// Gutenberg Core Block
function devops_unregister_core_block_post_author() {
    // unregister block
    unregister_block_type( 'core/post-author' );
    unregister_block_type( 'core/post-author-name' );
}

// GenerateBlocks - Remove Author Name and Nickname form Conent Type
function devops_remove_generateblocks_name_content_output($content, $attributes, $block) {
    // Check if the dynamic content type is 'author-name'
    if (isset($attributes['dynamicContentType']) && $attributes['dynamicContentType'] === 'author-name') {
        return ''; // Remove dynamic content for 'author-name'
    }

    // Check if the dynamic content type is 'author-nickname'
    if (isset($attributes['dynamicContentType']) && $attributes['dynamicContentType'] === 'author-nickname') {
        return ''; // Remove dynamic content for 'author-nickname'
    }

    return $content;
}

/*** END ***/