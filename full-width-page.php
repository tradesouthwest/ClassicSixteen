<?php
/**
 * Template Name: Full Width
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area-wide">
	<main id="main" class="site-main-wide">
		<?php
		// Start the loop.
		while ( have_posts() ) :
			the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
