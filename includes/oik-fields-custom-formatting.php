<?php

/**
 * @copyright (C) Copyright Bobbing Wide 2024
 * @package tt4ai
 */

/**
 * Custom formatting for post_excerpt field
 *
 */
function tt4ai_render_block_core_post_excerpt( $content, $parsed_block, $block ) {
	bw_trace2($content, "content", false);
	bw_trace2( $parsed_block, "parsed_block", false );
	//get_the_excerpt();
	global $excerpt_word_count;
	$words = '<p class="words">';
	$words .= $excerpt_word_count;
	$words .= ' words</p></p>';
	$content = str_replace( '</p>', $words, $content );
	return $content;
}

function tt4ai_get_the_excerpt( $content, $post ) {
	//bw_trace2();
	$count = tt4ai_count_words( $content );
	//$content .= '<span class="count">';
	//$content .= $count;
	//$content .= ' words</span>';
	return $content;
}

function tt4ai_count_words( $content ) {
	global $excerpt_word_count;
	$word_array = explode(' ', $content );
	$excerpt_word_count = count( $word_array );
	return $excerpt_word_count;
}


/**
 * Custom formatting for SEO Meta Description
 * _yoast_wpseo_metadesc
 */
function bw_theme_field_text__yoast_wpseo_metadesc( $key, $value, $field ) {
	span( "value $key");
	e( $value[0] );
	epan();
	//br();
	span( "chars");
	e( strlen( $value[0]));
	e( ' chars');
	epan();
}