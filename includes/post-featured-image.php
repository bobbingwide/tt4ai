<?php
/**
 * @copyright (C) Copyright Bobbing Wide 2024
 * @package tt4ai
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
		if ( $attributes['isLink'] ) {
			$html=str_replace( '</a></figure>', $caption . '</a></figure>', $html );
		} else {
			$html=str_replace( '</figure>', $caption . '</figure>', $html );
		}
	}
	return $html;
}

function tt4ai_get_figure_caption( $attributes, $content, $block ) {
	//bw_trace2( $attributes, 'attributes', false );
	$post_ID = $block->context['postId'];
	$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
	$post = get_post( $post_thumbnail_id );
	$figcaption = tt4ai_get_caption( $post );
	//bw_trace2( $post, "post", false );
	$caption="<figcaption>";
	$caption .= $figcaption;
	$caption .= "</figcaption>";
	//if ( $attributes)
	return $caption;
}

function tt4ai_get_caption( $post ) {
	$figcaption = tt4ai_div( 'post_title', $post->post_title);
	if (strlen( trim( $post->post_excerpt ) ) ){
		$figcaption.=tt4ai_div( 'post_excerpt', $post->post_excerpt );
	}
	$figcaption .= tt4ai_div( 'post_content', $post->post_content );
	//$figcaption .= tt4ai_div( 'alttext',
	// Get dimensions
	$figcaption .= tt4ai_get_dimensions( $post->ID );
	return $figcaption;
}

function tt4ai_div( $class, $value, $tag='div') {
	return sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $tag, $class, $value );
}

function tt4ai_alttext( $attachment_id ) {
    $alttext = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
 return $alttext;
}

function tt4ai_get_dimensions( $post ) {
	$wp_attachment_metadata = get_post_meta( $post, '_wp_attachment_metadata', true );
	$dimensions = tt4ai_bw_fields_get_dimensions( $wp_attachment_metadata );
	if ( $dimensions !== '772 x 250' ) {
		$dimensions = tt4ai_div('dimensions', $dimensions );
	} else {
		$dimensions = '';
	}
	return $dimensions;
}

/**
 * Return the size of an attached image
 *
 * When it's an image we return the dimensions of the original image.
 * ie. the width and height from the deserialized array from _wp_attachment_metadata
 *
 * @param array $wp_attachment_metadata - attachment metadata
 * @return string Either width x height or null if width and height are not defined
 *
 */
function tt4ai_bw_fields_get_dimensions( $wp_attachment_metadata ) {
	//bw_trace2();
	$width = bw_array_get( $wp_attachment_metadata, "width", null );
	$height = bw_array_get( $wp_attachment_metadata, "height", null );
	if ( $width && $height ) {
		$dimensions = "$width x $height";
	} else {
		$dimensions = null;
	}
	return $dimensions;
}