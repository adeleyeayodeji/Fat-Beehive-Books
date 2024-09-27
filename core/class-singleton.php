<?php

/**
 * File Description:
 * Singleton abstract class to be inherited by other classes
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

// Abort if called directly.
defined('WPINC') || die;

/**
 * Class Singleton
 *
 * @package Fat_Beehive_Books
 */
abstract class Singleton
{

	/**
	 * Singleton constructor.
	 *
	 * Protect the class from being initiated multiple times.
	 *
	 * @param array $props Optional properties array.
	 *
	 * @since 1.0.0
	 */
	protected function __construct($props = array())
	{
		// Protect class from being initiated multiple times.
	}

	/**
	 * Instance obtaining method.
	 *
	 * @return static Called class instance.
	 * @since 1.0.0
	 */
	public static function instance()
	{
		static $instances = array();

		// @codingStandardsIgnoreLine Plugin-backported
		$called_class_name = get_called_class();

		if (! isset($instances[$called_class_name])) {
			$instances[$called_class_name] = new $called_class_name();
		}

		return $instances[$called_class_name];
	}
}
