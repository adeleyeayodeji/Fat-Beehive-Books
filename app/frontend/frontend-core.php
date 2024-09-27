<?php

/**
 * File Description:
 * Frontend Core class.
 *
 * @link    https://fatbeehive.com/
 * @since   1.0.0
 *
 * @author  Fat Beehive (https://fatbeehive.com)
 * @package Fat_Beehive_Books
 */

namespace Fat_Beehive_Books\App\Frontend;

use Fat_Beehive_Books\Base;

// If this file is called directly, abort.
defined('WPINC') || die;

class Frontend_Core extends Base
{
	/**
	 * Initialize the frontend core.
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		// Add custom template for all book archive pages.
		add_filter('template_include', [$this, 'include_custom_template']);
		//add custom styles
		add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
	}

	/**
	 * Enqueue the styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style('fat-beehive-books-style', FAT_BEEHIVE_BOOKS_URL . 'assets/css/frontend.css', [], FAT_BEEHIVE_BOOKS_VERSION);
	}

	/**
	 * Include the custom template for book archive pages.
	 *
	 * @param string $template The original template path.
	 * @return string The custom template path.
	 */
	public function include_custom_template($template)
	{
		//check if the template is a book archive
		if (is_post_type_archive('book')) {
			//check if the template exists
			if (file_exists(FAT_BEEHIVE_BOOKS_TEMPLATES_PATH . 'frontend/archive-book.php')) {
				//return the template
				return FAT_BEEHIVE_BOOKS_TEMPLATES_PATH . 'frontend/archive-book.php';
			}
		}
		//check if the template is a single book
		if (is_singular('book')) {
			//check if the template exists
			if (file_exists(FAT_BEEHIVE_BOOKS_TEMPLATES_PATH . 'frontend/single-book.php')) {
				//return the template
				return FAT_BEEHIVE_BOOKS_TEMPLATES_PATH . 'frontend/single-book.php';
			}
		}
		//if the template does not exist, return the original template
		return $template;
	}
}
