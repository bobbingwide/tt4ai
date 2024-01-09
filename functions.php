<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2023-2024
 * tt4ai functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tt4ai
 * @since tt4ai v0.0.1
 */

/**
 * Register block styles.
 */


	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function tt4ai_block_styles() {

		register_block_style(
			'core/paragraph',
			array(
				'name'        =>'aiprompt',
				'label'       =>__( 'AI prompt', 'tt4ai' ),
				/*
				 * Styles for

				'inline_style'=>"
				.is-style-aiprompt:before {
			content: '';
			width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}"
				*/
			)
		);
		register_block_style(
			'core/paragraph',
			array(
				'name'        =>'airesponse',
				'label'       =>__( 'AI response', 'tt4ai' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */

			)
		);
		register_block_style(
			'core/group',
			array(
				'name'        =>'aiprompt',
				'label'       =>__( 'AI prompt', 'tt4ai' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */

			)
		);
		register_block_style(
			'core/group',
			array(
				'name'        =>'airesponse',
				'label'       =>__( 'AI response', 'tt4ai' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */

			)
		);
	}


add_action( 'init', 'tt4ai_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'tt4ai_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function tt4ai_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/paragraph',
			array(
				'handle' => 'tt4ai-paragraph-style-aiprompt',
				'src'    => get_theme_file_uri( 'css/paragraph-aiprompt.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_theme_file_path( 'css/paragraph-aiprompt.css' ),
			)
		);
	}
endif;

add_action( 'init', 'tt4ai_block_stylesheets' );

/**
 * Expand shortcodes in the Query loop.
 */
/**
 * Filters the rendered shortcode block.
 *
 * @param $content
 * @param $parsed_block
 * @param $block
 * @return mixed|string
 */
function tt4ai_render_block_core_shortcode( $content, $parsed_block, $block ) {
	//echo $content;
	bw_trace2();
	$content = do_shortcode( $content );

	return $content;
}
add_filter( 'render_block_core/shortcode', 'tt4ai_render_block_core_shortcode', 10, 3, );
add_filter( 'render_block_core/paragraph', 'tt4ai_render_block_core_shortcode', 10, 3, );

require_once __DIR__ . '/includes/block-overrides.php';

