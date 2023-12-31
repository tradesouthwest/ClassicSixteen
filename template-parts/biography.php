<?php
/**
 * The template part for displaying an Author biography
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0.4
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the Classic Sixteen author bio avatar size.
		 *
		 * @since ClassicSixteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'classicsixteen_author_bio_avatar_size', 42 );

		echo get_avatar( esc_html( get_the_author_meta( 'user_email' ) ), 
						absint( $author_bio_avatar_size ) 
					);
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title"><span class="author-heading"><?php esc_html_e( 'Author:', 'classicsixteen' ); ?></span> <?php echo esc_html( get_the_author() ); ?></h2>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php
				/* translators: %s: The post author display name */
				printf( esc_html__( 'View all posts by %s', 'classicsixteen' ), 
					esc_html( get_the_author() ) //author name
				);
				?>
			</a>
		</p>
	</div>
</div><!-- .author-info -->
