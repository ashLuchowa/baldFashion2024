<?php
/**
 * Template part for displaying single post next/prev posts
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('single-post-next-prev-posts') ) {
    $previous_post = get_previous_post();
    $next_post = get_next_post();

    if( $next_post || $previous_post ) {
        ?>
        <div class="single-next-prev-posts-container">
            <h4 class="single-next-prev-posts-title">
                <?php echo esc_attr(rivax_get_option('single-next-prev-posts-title')); ?>
            </h4>
            <div class="single-next-prev-posts">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if( $previous_post ) {
                            ?>
                            <div class="post-wrapper prev-post">
                                <div class="image">
                                    <a href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>">
                                        <?php echo get_the_post_thumbnail($previous_post->ID, 'thumbnail', array( 'title' => get_the_title() )); ?>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="next-prev-label">
                                        <span class="icon"><i class="ri-arrow-left-line"></i></span>
                                        <span class="text"><?php esc_html_e('Previous', 'raveen'); ?></span>
                                    </div>
                                    <h3 class="title">
                                        <a class="title-animation-underline" href="<?php echo esc_url(get_permalink($previous_post->ID)); ?>"><?php echo esc_html(get_the_title($previous_post->ID)); ?></a>
                                    </h3>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if( $next_post ) {
                            ?>
                            <div class="post-wrapper next-post">
                                <div class="image">
                                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                                        <?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail', array( 'title' => get_the_title() )); ?>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="next-prev-label">
                                        <span class="text"><?php esc_html_e('Next', 'raveen'); ?></span>
                                        <span class="icon"><i class="ri-arrow-right-line"></i></span>
                                    </div>
                                    <h3 class="title">
                                        <a class="title-animation-underline" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html(get_the_title($next_post->ID)); ?></a>
                                    </h3>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}