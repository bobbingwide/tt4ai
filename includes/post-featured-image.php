<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 */

/**
 *
 * Overrides core/post-featured-image
 *
 */
function tt4ai_render_block_core_post_featured_image( $attributes, $content, $block ) {
	$html = render_block_core_post_featured_image( $attributes, $content, $block );
	bw_trace2( $html,'html', false);
	bw_trace2( $attributes, 'attributes', false );
	bw_trace2( $content, 'content', false );
	if ( '' !== $html ) {
		$caption=tt4ai_get_figure_caption( $attributes, $content, $block );
		$html   =str_replace( '</figure>', $caption . '</figure>', $html );
	}
	return $html;
}

function tt4ai_get_figure_caption( $attributes, $content, $block ) {
	$post_ID = $block->context['postId'];
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	$post = get_post( $post_thumbnail_id );
	$figcaption = tt4ai_get_caption( $post );
	bw_trace2( $post, "post", false );
	$caption="<figcaption>";
	$caption .= $figcaption;
	$caption .= "</figcaption>";
	return $caption;
}

function tt4ai_get_caption( $post ) {
	$figcaption = tt4ai_div( 'post_title', $post->post_title);
	$figcaption .= tt4ai_div( 'post_excerpt', $post->post_excerpt );
	$figcaption .= tt4ai_div( 'post_content', $post->post_content );
	//$figcaption .= tt4ai_div( 'alttext',
	return $figcaption;
}

function tt4ai_div( $class, $value, $tag='div') {
	return sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $tag, $class, $value );
}

function tt4ai_alttext( $attachment_id ) {
    $alttext = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
 return $alttext;
}