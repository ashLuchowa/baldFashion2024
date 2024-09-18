<?php
/**
 * Template part for displaying single post Video hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="single-hero-video">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/post/hero/title-section'); ?>
                <div class="single-hero-video-container">
                    <?php
                    $video_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_video_url', true));
                    if( $video_url ) echo wp_oembed_get($video_url , array('width' => '900'));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
