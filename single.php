<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area-wide">
	<main id="main" class="site-main">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				the_post_navigation(
					array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'classicsixteen' ), //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped in array
					)
				);
			} elseif ( is_singular( 'post' ) ) {
				the_post_navigation(
					array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'classicsixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'classicsixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'classicsixteen' ) . '</span> ' .
							'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'classicsixteen' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					)
				);
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
