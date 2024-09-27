<?php

/**
 * Plugin Name:     Fat Beehive Books
 * Plugin URI:      https://fatbeehive.com
 * Description:     A plugin to manage books
 * Author:          Fat Beehive
 * Author URI:      https://fatbeehive.com
 * Text Domain:     fat-beehive-books
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Fat_Beehive_Books
 */

//check for security
if (! defined('ABSPATH')) {
	die("You are not allowed to access this file directly.");
}

//define constants
define('FAT_BEEHIVE_BOOKS_VERSION', '0.1.0');
define('FAT_BEEHIVE_BOOKS_PATH', plugin_dir_path(__FILE__));
define('FAT_BEEHIVE_BOOKS_URL', plugin_dir_url(__FILE__));
//template path
define('FAT_BEEHIVE_BOOKS_TEMPLATES_PATH', plugin_dir_path(__FILE__) . 'app/templates/');

// Support for site-level autoloading.
require_once __DIR__ . '/vendor/autoload.php';

//init Loader
Fat_Beehive_Books\Loader::instance();
