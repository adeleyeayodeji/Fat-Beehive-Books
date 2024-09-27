<?php

/**
 * File Description:
 * Helpers
 *
 * @link    https://fatbeehive.com/
 * @since   1.0.0
 *
 * @author  Fat Beehive (https://fatbeehive.com)
 * @package Fat_Beehive_Books
 *
 * @copyright (c) 2024, Fat Beehive (https://fatbeehive.com)
 */

// If this file is called directly, abort.
defined('WPINC') || die;

/**
 * Helpers
 * write all the helper functions here
 *
 * @since 1.0.0
 */


/**
 * Modify the books archive query
 *
 * @param WP_Query $query The query object
 * @return void
 */
function modify_books_archive_query($query)
{
	if (!is_admin() && $query->is_main_query() && is_post_type_archive('book')) {
		$tax_query = array(
			array(
				'taxonomy' => 'genre',
				'field'    => 'slug',
				'terms'    => 'science-fiction',
			),
		);
		$query->set('tax_query', $tax_query);
	}
}

add_action('pre_get_posts', 'modify_books_archive_query', PHP_INT_MAX);
