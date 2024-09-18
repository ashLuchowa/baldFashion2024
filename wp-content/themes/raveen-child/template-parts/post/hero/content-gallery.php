<?php
/**
 * Template part for displaying single post Gallery hero content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$gallery_images = get_post_meta( get_the_ID(), 'rivax_single_gallery_images', true);
?>

<div class="single-hero-gallery">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <?php get_template_part('template-parts/post/hero/title-section'); ?>
            </div>
        </div>
    </div>

    <?php
    if(is_array($gallery_images)) {
        ?>
    <div class="single-hero-gallery-container">
        <div class="swiper">
            <div class="swiper-wrapper">
            <?php
            foreach ($gallery_images as $id => $gallery_image) {

                $image_url = wp_get_attachment_image_url($id, 'rivax-medium');
                if($image_url) {
                    echo '<div class="single-hero-gallery-item swiper-slide">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '">';
                    echo '</div>';
                }
            }
            ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
        <?php
    }
    ?>

</div>