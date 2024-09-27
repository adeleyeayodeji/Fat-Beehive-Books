<?php

/**
 * The template for displaying the single book post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fat_Beehive_Books
 */

get_header();
?>

<div class="fat-beehive-books-single">
	<h1><?php the_title(); ?></h1>
	<?php the_post_thumbnail(); ?>
	<p>
		<?php the_content(); ?>
	</p>
	<p>
		<strong>
			<?php _e('Author', 'fat-beehive-books'); ?>
		</strong>
		<?php echo esc_html(get_post_meta(get_the_ID(), '_book_author_name', true)); ?>
	</p>
</div>

<?php get_footer(); ?>
