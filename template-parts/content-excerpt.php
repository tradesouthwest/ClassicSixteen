<?php
/**
 * The template part for displaying content
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php esc_html_e( 'Featured', 'classicsixteen' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-content home-excerpt">
        <figure>
            <?php if (has_post_thumbnail()) { the_post_thumbnail(); }  ?>
        </figure>

        <div class="excerpt-content">
            <?php the_excerpt(); ?>
        </div>
		
    </div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php classicsixteen_entry_meta(); ?>
		<?php 
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'classicsixteen' ), //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped translator
					esc_html( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
