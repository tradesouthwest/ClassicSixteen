<?php
/**
 * Custom ClassicSixteen template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0.10
 */
if ( ! function_exists( 'classicsixteen_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * Create your own classicsixteen_entry_meta() function to override in a child theme.
	 *
	 * @since ClassicSixteen 1.0.4
	 */
	function classicsixteen_entry_meta() {
		if ( 'post' === get_post_type() ) {
			$author             = get_the_author();
			$author_avatar_size = apply_filters( 'classicsixteen_author_avatar_size', 49 );
			printf(
				'<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
				get_avatar( get_the_author_meta( 'user_email' ), absint( $author_avatar_size ) ),
				esc_html_x( 'Author', 'Used before post author name.', 'classicsixteen' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( $author )
			);
		}

		if ( in_array( get_post_type(), array( 'post', 'attachment' ), true ) ) {
			classicsixteen_entry_date();
		}
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			printf(
				'<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
					sprintf( '<span class="screen-reader-text">%s </span>', 
						esc_html_x( 'Format', 'Used before post format.', 'classicsixteen' ) ), 
						esc_url( get_post_format_link( $format ) ),
						esc_html( get_post_format_string( esc_html( $format ) ) )
			);
		}
		if ( 'post' === get_post_type() ) {
			classicsixteen_entry_taxonomies();
		}
		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			/* translators: %s: Name of current post */ 
			comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'classicsixteen' ), 
				get_the_title()         //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped function
				) 
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'classicsixteen_entry_date' ) ) :
	/**
	 * Prints HTML with date information for current post.
	 * Create your own classicsixteen_entry_date() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 */
	function classicsixteen_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>  <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ), //integer and presented as a binary number. 
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		
		printf(	'<span class="posted-on"><span class="screen-reader-text">%1$s </span>
			<a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'Used before publish date.', 'classicsixteen' ),
				esc_url( get_permalink() ),
				$time_string         //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		); 
	}
endif;

if ( ! function_exists( 'classicsixteen_entry_taxonomies' ) ) :
	/**
	 * Prints HTML with category and tags for current post.
	 *
	 * Create your own classicsixteen_entry_taxonomies() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 */
	function classicsixteen_entry_taxonomies() {
		$categories_list = wp_kses_post( get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'classicsixteen' ) ) );
		if ( $categories_list && classicsixteen_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Categories', 'Used before category names.', 'classicsixteen' ),
				wp_kses_post( $categories_list )
			);
		}
									
		$tags_list = wp_kses_post( get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'classicsixteen' ) ) );
		if ( $tags_list && ! is_wp_error( $tags_list ) ) {
			printf(
				'<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Tags', 'Used before tag names.', 'classicsixteen' ),
				wp_kses_post( $tags_list )
			);
		}
	}
endif;

if ( ! function_exists( 'classicsixteen_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * Create your own classicsixteen_post_thumbnail() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 */
	function classicsixteen_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

	<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

		<?php
	endif; // End is_singular()
	}
endif;

if ( ! function_exists( 'classicsixteen_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own classicsixteen_excerpt() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function classicsixteen_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) :
			?>
			<div class="<?php echo esc_attr( $class ); ?>">
		    	<?php the_excerpt(); ?>
			</div>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'classicsixteen_excerpt_more' ) && ! is_admin() ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
	 * a 'Continue reading' link.
	 *
	 * Create your own classicsixteen_excerpt_more() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 *
	 * @return string 'Continue reading' link prepended with an ellipsis.
	 */
	function classicsixteen_excerpt_more() {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( wp_kses_post( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'classicsixteen' ) ), 
				esc_html( get_the_title( get_the_ID() ) ) ) 
		);
		return ' &hellip; ' . wp_kses_post( $link );
	}
	add_filter( 'excerpt_more', 'classicsixteen_excerpt_more' );
endif;

if ( ! function_exists( 'classicsixteen_categorized_blog' ) ) :
	/**
	 * Determines whether blog/site has more than one category.
	 *
	 * Create your own classicsixteen_categorized_blog() function to override in a child theme.
	 *
	 * @since Classic Sixteen 1.0
	 *
	 * @return bool True if there is more than one category, false otherwise.
	 */
	function classicsixteen_categorized_blog() {
		$all_the_cool_cats = get_transient( 'classicsixteen_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields' => 'ids',
					// We only need to know if there is more than one category.
					'number' => 2,
				)
			);

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'classicsixteen_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 || is_preview() ) {
			// This blog has more than 1 category so classicsixteen_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so classicsixteen_categorized_blog should return false.
			return false;
		}
	}
endif;

/**
 * Flushes out the transients used in classicsixteen_categorized_blog().
 *
 * @since Classic Sixteen 1.0
 */
function classicsixteen_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'classicsixteen_categories' );
}
add_action( 'edit_category', 'classicsixteen_category_transient_flusher' );
add_action( 'save_post', 'classicsixteen_category_transient_flusher' );

if ( ! function_exists( 'classicsixteen_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Classic Sixteen 1.2
	 */
	function classicsixteen_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;
