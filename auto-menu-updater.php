<?php
/**
 * Plugin Name: Automatic Menu Updater
 * Description: Updates WordPress menus automatically via API calls, supporting multi-level menus and all menu attributes.
 * Version: 1.1
 * Author: Vishnu Soman U S
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin path
define('AMU_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Include required files
require_once AMU_PLUGIN_PATH . 'includes/class-auto-menu-updater.php';
require_once AMU_PLUGIN_PATH . 'includes/class-settings-page.php';
require_once AMU_PLUGIN_PATH . 'includes/class-cron-handler.php';
require_once AMU_PLUGIN_PATH . 'includes/class-sample-api.php';

// Initialize the plugin
function amu_init_plugin() {
    new Auto_Menu_Updater();
    new AMU_Settings_Page();
    new AMU_Cron_Handler();
    new AMU_Sample_API();
}
add_action('plugins_loaded', 'amu_init_plugin');