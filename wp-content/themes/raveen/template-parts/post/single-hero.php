<?php
/**
 * Template part for displaying single post hero content - outside content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_format = get_post_format() ? : 'standard';
$selected_standard_layout = intval( get_post_meta(get_the_ID(), 'rivax_single_post_layout', true ) );
$global_standard_layout = intval(rivax_get_option('single-layout'));
$standard_post_layout = $selected_standard_layout?: $global_standard_layout;
$standard_post_layout = ( $standard_post_layout && has_post_thumbnail() )? $standard_post_layout : 1;

echo '<div class="single-hero">';

if( $post_format == 'gallery') {
    get_template_part('template-parts/post/hero/content-gallery');
}
elseif( $post_format == 'video') {
    get_template_part('template-parts/post/hero/content-video');
}
elseif( $post_format == 'audio') {
    get_template_part('template-parts/post/hero/content-audio');
}
elseif( $post_format == 'link') {
    get_template_part('template-parts/post/hero/content-link');
}
elseif( $post_format == 'quote') {
    get_template_part('template-parts/post/hero/content-quote');
}
else {
    get_template_part('template-parts/post/hero/content-' . $standard_post_layout);
}

echo '</div>';