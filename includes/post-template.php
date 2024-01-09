<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 */

/**
 *
 * Overrides core/post-template
 *
 * Hack until a solution is delivered in Gutenberg.
 *
 */
function tt4ai_render_block_core_post_template( $attributes, $content, $block ) {
	$block = tt4ai_post_template_fiddle( $attributes, $content, $block );
	$html = render_block_core_post_template( $attributes, $content, $block );
	return $html;
}

/**
 * Fiddles the query to support orderby=$className when the className is "menu_order" or "rand".
 *
 */
function tt4ai_post_template_fiddle( $attributes, $content, $block ) {
	$className = isset( $attributes['className'])  ? $attributes['className'] : null;
	if ( $className && ( 'menu_order' === $className || 'rand' === $className)  ) {
		$block->context['query']['orderBy'] = $className;
		$block->context['query']['order'] = 'ASC';
	}
	//bw_trace2( $block, 'block', false);
	return $block;
}