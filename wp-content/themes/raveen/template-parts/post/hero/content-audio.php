<?php
/**
 * Template part for displaying single post Audio hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
?>
<div class="single-hero-audio">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/post/hero/title-section'); ?>
                <div class="single-hero-audio-container">
                    <?php
                    $audio_url = esc_url(get_post_meta( get_the_ID(), 'rivax_single_audio_url', true));
                    if($audio_url) echo wp_oembed_get($audio_url);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

