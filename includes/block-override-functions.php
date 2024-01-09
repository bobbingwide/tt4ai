<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 */

/**
 * Overrides a core block's render_callback method, if required.
 *
 * For the given block name, if the overriding function is available,
 * replace the render_callback with our own function.
 * Note: For WordPress 5.9, as Gutenberg is no longer a pre-requisite to FSE themes,
 * this no longer checks that the implementing render callback function is prefixed with `gutenberg_`
 *
 * @param array $args Block attributes.
 * @param string $blockname The block name to test for.
 * @param string $render_callback The common suffix for the block's callback function.
 * @return array Block attributes.
 */
function tt4ai_maybe_override_block( $args, $blockname, $render_callback ) {
	//echo $blockname . $args['name'];
	if ( $blockname == $args['name'] ) {

	}
	$tt4ai_render_callback = 'tt4ai_' . $render_callback;
	if ( $blockname == $args['name'] && function_exists( $tt4ai_render_callback ) ) {
		//if ( 'gutenberg_' . $render_callback == $args['render_callback'] ) {
		$args['render_callback'] = $tt4ai_render_callback;
		// }
	}
	return $args;
}

