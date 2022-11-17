<?php
/**
 * Plugin Name: Graph Rank Math
 * Author: Renan Lima
 * Author URI: https://renandevlima.github.io
 * Version: 1.0.0
 * Description: A plugin requested by Team Rank Math released by Renan Lima.
 * Text-Domain: graph-rank-math
 */

if (!defined('ABSPATH')) exit();

define('GRM_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('GRM_URL', trailingslashit(plugins_url('/', __FILE__)));

require_once GRM_PATH . "includes/functions.php";
require_once GRM_PATH . 'classes/class-create-settings-routes.php';

add_action('admin_enqueue_scripts', 'load_scripts');
add_action('wp_dashboard_setup', 'grm_add_dashboard_widgets');

register_activation_hook(__FILE__, 'grm_create_db');
register_deactivation_hook( __FILE__, 'grm_remove_db' );
