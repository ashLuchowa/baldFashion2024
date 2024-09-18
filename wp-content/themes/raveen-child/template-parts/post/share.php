<?php
/**
 * Template part for displaying single post share box
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('single-post-share-box') ) {
    ?>
    <div class="single-share-box-container">
        <?php
        $social = rivax_get_option('single-post-share-box-options');
        $share_summary = wp_strip_all_tags(get_the_excerpt());
        $share_url = get_permalink();
        $share_title = htmlspecialchars(get_the_title(), ENT_COMPAT, 'UTF-8');
        $share_media = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
        ?>
        <p class="title"><?php esc_html_e('Please share this article if you like it!', 'raveen'); ?></p>
        <div class="single-share-box">
            <?php if( $social['facebook'] ): ?>
                <a class="facebook" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-facebook-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['twitter'] ): ?>
                <a class="twitter" rel="nofollow"  href="https://twitter.com/intent/tweet?text=<?php echo urlencode($share_title); ?>&url=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-twitter-x-line"></i></a>
            <?php endif; ?>
            <?php if( $social['linkedin'] ): ?>
                <a class="linkedin" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>" target="_blank"><i class="ri-linkedin-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['pinterest'] ): ?>
                <a class="pinterest" rel="nofollow"  href="https://pinterest.com/pin/create/link/?url=<?php echo esc_url($share_url); ?>&media=<?php echo esc_url($share_media); ?>&description=<?php echo urlencode($share_title); ?>" target="_blank"><i class="ri-pinterest-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['telegram'] ): ?>
                <a class="telegram" rel="nofollow" href="https://t.me/share/?url=<?php echo esc_url($share_url); ?>&text=<?php echo urlencode($share_title); ?>" target="_blank"><i class="ri-telegram-fill"></i></a>
            <?php endif; ?>
            <?php if( $social['email'] ): ?>
                <a class="email" rel="nofollow"  href="mailto:?subject=<?php echo urlencode($share_title); ?>&body=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-mail-line"></i></a>
            <?php endif; ?>
            <?php if( $social['whatsapp'] ): ?>
                <a class="whatsapp" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php echo esc_url($share_url); ?>" target="_blank"><i class="ri-whatsapp-line"></i></a>
            <?php endif; ?>
            <div class="single-share-box-cover"><?php esc_html_e('Share It!', 'raveen'); ?></div>
        </div>
    </div>
    <?php
}