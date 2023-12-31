<?php
/**
 * Classic Sixteen Customizer functionality
 *
 * @package ClassicSixteen
 * @since ClassicSixteen 1.0
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since ClassicSixteen 1.0
 *
 * @see classicsixteen_header_style()
 */
function classicsixteen_custom_header_and_background() {
	$default_background_color = '1b1b1b';

	/**
	 * Filter the arguments used when adding 'custom-background' support in Classic Sixteen.
	 *
	 * @since ClassicSixteen 1.0
	 *
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'classicsixteen_custom_background_args',
			array(
				'default-color' => $default_background_color,
			)
		)
	);

}
add_action( 'after_setup_theme', 'classicsixteen_custom_header_and_background' );

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Classic Sixteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function classicsixteen_customize_register( $wp_customize ) {
	//$color_scheme = 'default';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'classicsixteen_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'classicsixteen_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'classicsixteen_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Classic Sixteen 1.2
 * @see classicsixteen_customize_register()
 *
 * @return void
 */
function classicsixteen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Classic Sixteen 1.2
 * @see classicsixteen_customize_register()
 *
 * @return void
 */
function classicsixteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Classic Sixteen 1.0
 */
function classicsixteen_customize_preview_js() {
	wp_enqueue_script( 'classicsixteen-customize-preview', 
						get_template_directory_uri() . '/js/customize-preview.js', 
						array( 'customize-preview' ), 
						'20230610', 
						true 
					);
}
add_action( 'customize_preview_init', 'classicsixteen_customize_preview_js' ); 
