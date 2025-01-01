<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_filter( 'generate_schema_type', '__return_false' );