<?php
/**
 * Template part for displaying single post author box
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('single-post-author-box') ) {
    ?>
    <div class="single-author-box-container">
        <div class="single-author-box">
            <div class="single-author-box-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
            </div>
            <div class="single-author-box-desc">
                <span class="written-by"><?php esc_html_e('Written By', 'raveen'); ?></span>
                <p class="author-name"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ))); ?>"><?php echo esc_html(get_the_author()); ?></a></p>
                <p class="author-bio"><?php the_author_meta( 'description' ); ?></p>
                <div class="author-social-links">
                    <?php
                    if(function_exists('rivax_author_social')) {
                        rivax_author_social(get_the_author_meta( 'ID' ));
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}