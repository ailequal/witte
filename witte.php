<?php

/**
 * witte
 *
 * @package           witte
 * @author            ailequal
 * @copyright         2022 ailequal
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       witte
 * Plugin URI:        https://github.com/ailequal/witte
 * Description:       What is there to eat?
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.4
 * Author:            ailequal
 * Author URI:        https://www.ailequal.com
 * Text Domain:       witte
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

use Ailequal\Plugins\Witte\App;

// If this file is called directly, abort.
if ( ! defined('WPINC')) {
    die;
}

// Main plugin constants.
define('WITTE_VERSION', '1.0.0');
define('WITTE_SLUG', 'witte');
define('WITTE_FULL_PLUGIN_NAME', WITTE_SLUG.'/'.WITTE_SLUG.'.php');
define('WITTE_BASE_PATH', plugin_dir_path(__FILE__));
define('WITTE_BASE_URL', plugin_dir_url(__FILE__));

// Initialize Composer.
require_once WITTE_BASE_PATH.'vendor/autoload.php';

// Initialize the App class.
App::getInstance()->init();
