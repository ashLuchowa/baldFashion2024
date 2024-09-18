<?php
/**
 * Template part for displaying single post Link hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$link_url = get_post_meta( get_the_ID(),'rivax_single_link_url', true);
$link_title = get_post_meta( get_the_ID(),'rivax_single_link_title', true);
$link_url_text = preg_replace('/https?:\/\/(www.)?/', '', $link_url);; // Remove http / www
?>
<div class="single-hero-link">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/post/hero/title-section'); ?>
                <div class="single-hero-link-container">
                    <div class="link-content">
                        <div class="icon">
                            <span class="link-icon"><i class="ri-link-solid"></i></span>
                        </div>
                        <div class="content">
                            <a class="link" target="_blank" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_url_text); ?></a>
                            <p class="title"><?php echo esc_html($link_title); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

