<?php

/**
 * @copyright (C) Copyright Bobbing Wide 2024
 * Implements block overrides as required.
 *
 */
require_once __DIR__ . '/block-override-functions.php';

/**
 * Here we include the blocks we want to override.
 *
 * Either comment out the ones that aren't needed any more,
 * when Gutenberg/core satisfies the requirement,
 * or find another way to automatically determine whether to include the file.
 */
require_once __DIR__ . '/post-template.php';

/**
 * Hook into register_block_types_args before WP_Block_Supports
 */
add_filter( 'register_block_type_args', 'tt4ai_register_block_type_args', 9 );

/**
 * Implements overrides for core blocks which we need to improve.
 *
 * @param array $args Block attributes.
 * @return array
 */
function tt4ai_register_block_type_args( $args ) {
	$args = tt4ai_maybe_override_block( $args, 'core/post-template', 'render_block_core_post_template');
	return $args;
}