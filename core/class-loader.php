<?php

/**
 * Class to boot up plugin.
 *
 * @link    https://fatbeehive.com/
 * @since   1.0.0
 *
 * @author  Fat Beehive (https://fatbeehive.com)
 * @package Fat_Beehive_Books
 *
 * @copyright (c) 2024, Fat Beehive (https://fatbeehive.com)
 */

namespace Fat_Beehive_Books;

use Fat_Beehive_Books\App\Admin\Admin_Core;
use Fat_Beehive_Books\App\Frontend\Frontend_Core;
use Fat_Beehive_Books\Base;

// If this file is called directly, abort.
defined('WPINC') || die;

final class Loader extends Base
{
	/**
	 * Settings helper class instance.
	 *
	 * @since 1.0.0
	 * @var object
	 *
	 */
	public $settings;

	/**
	 * Minimum supported php version.
	 *
	 * @since  1.0.0
	 * @var float
	 *
	 */
	public $php_version = '7.4';

	/**
	 * Minimum WordPress version.
	 *
	 * @since  1.0.0
	 * @var float
	 *
	 */
	public $wp_version = '6.1';

	/**
	 * Initialize functionality of the plugin.
	 *
	 * This is where we kick-start the plugin by defining
	 * everything required and register all hooks.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function __construct()
	{
		if (!$this->can_boot()) {
			//log error
			error_log('Fat Beehive Books: Plugin could not boot, PHP version is less than ' . $this->php_version . ' and WP version is less than ' . $this->wp_version);
			return;
		}

		$this->init();
	}

	/**
	 * Main condition that checks if plugin parts should continue loading.
	 *
	 * @return bool
	 */
	private function can_boot()
	{
		/**
		 * Checks
		 *  - PHP version
		 *  - WP Version
		 * If not then return.
		 */
		global $wp_version;

		return (
			version_compare(PHP_VERSION, $this->php_version, '>') &&
			version_compare($wp_version, $this->wp_version, '>')
		);
	}

	/**
	 * Initialize the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function init()
	{
		//init admin core
		Admin_Core::instance()->init();
		//init frontend core
		Frontend_Core::instance()->init();
	}
}
