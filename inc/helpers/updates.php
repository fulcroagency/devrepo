<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Require the Plugin Update Checker library
require 'vendors/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Configure the update checker
$updateChecker = PucFactory::buildUpdateChecker(
    'https://storage.googleapis.com/cloud_eu/plugins/dev-options/update-info.json',
    __FILE__,
    'dev-options'
);