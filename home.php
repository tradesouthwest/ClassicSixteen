<?php
/**
 * The blog template file
 *
 * It is used to display a page with blog as home page query.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0.3
 */

get_header(); ?>

	<div id="primary" class="content-area-wide">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

            <header>
                <h1 class="page-title screen-reader-text"><?php the_title(); ?></h1>
            </header>

			<?php
			// Start the loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the excerpt formatting 
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'excerpt' );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination(
				array()
			);

			// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
