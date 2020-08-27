<?php
/**
 * Plugin Name: Authentication Plugin By Masha
 * Plugin URI:
 * Description: My custom plugin
 * Version: 1.0
 * Author: Masha
 * Author URI: https://www.linkedin.com/in/mariam-tigranyan-1a1067182/
 * License: GPLv2
 * Text Domain:  mt-auth
 * Domain Path:  /languages/
 */

/*If this file is called directly, abort.*/
if (!defined('WPINC')) {
    die;
}

if (!defined('MT_AUTH_PLUGIN_FILE_NAME')) {
    define('MT_AUTH_PLUGIN_FILE_NAME', plugin_basename(__FILE__));
}

if (!defined('MT_AUTH_PLUGIN_FOLDER_NAME')) {
    define('MT_AUTH_PLUGIN_FOLDER_NAME', plugin_basename(dirname(__FILE__)));
}

require_once(plugin_dir_path(__FILE__).'MtAuthInit.php');
