<?php

/**
 * File Description:
 * Admin Core class.
 *
 * @link    https://fatbeehive.com/
 * @since   1.0.0
 *
 * @author  Fat Beehive (https://fatbeehive.com)
 * @package Fat_Beehive_Books
 */

namespace Fat_Beehive_Books\App\Admin;

use Fat_Beehive_Books\Base;

// If this file is called directly, abort.
defined('WPINC') || die;

/**
 * Admin Core class.
 *
 * @since 1.0.0
 */
class Admin_Core extends Base
{
	/**
	 * Initializes the admin core.
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		add_action('init', [$this, 'register_book_post_type']);
		add_action('init', [$this, 'register_genre_taxonomy']);
		add_action('add_meta_boxes', [$this, 'add_book_meta_box']);
		add_action('save_post', [$this, 'save_book_meta_box']);
	}

	/**
	 * Register the Book Custom Post Type.
	 *
	 * @since 1.0.0
	 */
	public function register_book_post_type()
	{
		$labels = [
			'name'               => 'Books',
			'singular_name'      => 'Book',
			'menu_name'          => 'Books',
			'name_admin_bar'     => 'Book',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Book',
			'new_item'           => 'New Book',
			'edit_item'          => 'Edit Book',
			'view_item'          => 'View Book',
			'all_items'          => 'All Books',
			'search_items'       => 'Search Books',
			'not_found'          => 'No books found.',
			'not_found_in_trash' => 'No books found in Trash.',
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_menu'       => true,
			'menu_icon'          => 'dashicons-book-alt', // Menu icon
			'supports'           => ['title', 'editor', 'thumbnail'],
			'has_archive'        => true,
			'rewrite'            => ['slug' => 'books'],
			'show_in_rest'       => true,
		];

		register_post_type('book', $args); // Register the post type
	}

	/**
	 * Register the Genre Taxonomy.
	 *
	 * @since 1.0.0
	 */
	public function register_genre_taxonomy()
	{
		$labels = [
			'name'              => 'Genres',
			'singular_name'     => 'Genre',
			'search_items'      => 'Search Genres',
			'all_items'         => 'All Genres',
			'edit_item'         => 'Edit Genre',
			'update_item'       => 'Update Genre',
			'add_new_item'      => 'Add New Genre',
			'new_item_name'     => 'New Genre Name',
			'menu_name'         => 'Genres',
		];

		$args = [
			'labels'            => $labels,
			'public'            => true,
			'show_in_rest'      => true,
			'hierarchical'      => false, // Non-hierarchical taxonomy like tags
			'show_admin_column' => true,
			'rewrite'           => ['slug' => 'genre'],
		];

		register_taxonomy('genre', 'book', $args); // Register the taxonomy
	}

	/**
	 * Add a custom meta box for Author Name
	 *
	 * @since 1.0.0
	 */
	public function add_book_meta_box()
	{
		add_meta_box(
			'book_details_meta_box', // ID
			'Book Details',          // Title
			[$this, 'book_meta_box_html'], // Callback
			'book',                  // Post Type
			'normal',                // Context
			'high'                   // Priority
		);
	}

	/**
	 * Meta box HTML content.
	 *
	 * @since 1.0.0
	 */
	public function book_meta_box_html($post)
	{
		$author_name = get_post_meta($post->ID, '_book_author_name', true);
?>
		<label for="book_author_name">Author Name</label>
		<input type="text" name="book_author_name" id="book_author_name" value="<?php echo esc_attr($author_name); ?>" />
<?php
	}

	/**
	 * Save the meta box data.
	 *
	 * @since 1.0.0
	 */
	public function save_book_meta_box($post_id)
	{
		if (array_key_exists('book_author_name', $_POST)) {
			update_post_meta(
				$post_id,
				'_book_author_name',
				sanitize_text_field($_POST['book_author_name'])
			);
		}
	}
}
