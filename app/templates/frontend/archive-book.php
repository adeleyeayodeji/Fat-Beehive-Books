<?php

/**
 * The template for displaying the archive of book posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fat_Beehive_Books
 */

get_header();
?>

<div class="fat-beehive-books-archive">
	<h1><?php _e('Books', 'fat-beehive-books'); ?></h1>

	<div class="fat-beehive-books-filter">
		<form method="get">
			<?php
			$terms = get_terms(['taxonomy' => 'genre', 'hide_empty' => false]);
			if (!empty($terms)) {
				echo '<select name="genre">';
				echo '<option value="">' . __('Select Genre', 'fat-beehive-books') . '</option>';
				foreach ($terms as $term) {
					$selected = (isset($_GET['genre']) && $_GET['genre'] === $term->slug) ? 'selected' : '';
					echo '<option value="' . esc_attr($term->slug) . '" ' . esc_attr($selected) . '>' . esc_html($term->name) . '</option>';
				}
				echo '</select>';
			}
			?>
			<button type="submit"><?php _e('Filter', 'fat-beehive-books'); ?></button>
		</form>
	</div>

	<div class="fat-beehive-books-list">
		<?php
		$args = [
			'post_type' => 'book',
			'posts_per_page' => 10,
		];

		if (isset($_GET['genre']) && !empty($_GET['genre'])) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => sanitize_text_field($_GET['genre']),
				]
			];
		}

		$query = new WP_Query($args);

		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();
		?>
				<a href="<?php the_permalink(); ?>" class="fat-beehive-books-item">
					<h2>
						<?php the_title(); ?>
					</h2>
					<p>
						<?php the_excerpt(); ?>
					</p>
					<?php the_post_thumbnail(); ?>
					<p>
						<strong>
							<?php _e('Author', 'fat-beehive-books'); ?>
						</strong>
						<?php echo esc_html(get_post_meta(get_the_ID(), '_book_author_name', true)); ?>
					</p>
				</a>
		<?php
			endwhile;

			the_posts_pagination();
		else :
			echo '<p>' . __('No books found.', 'fat-beehive-books') . '</p>';
		endif;

		wp_reset_postdata();
		?>
	</div>
</div>

<?php get_footer(); ?>
