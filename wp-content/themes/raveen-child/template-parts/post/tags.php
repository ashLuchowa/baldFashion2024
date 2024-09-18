<?php
/**
 * Template part for displaying single post tags
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if(!rivax_get_option('disable-tags') && get_the_tags($post->ID)) {
    ?>
    <div class="clear"></div>
    <div class="single-post-tags">
    <h4><?php esc_html_e('Tags:', 'raveen'); ?></h4>
    <?php the_tags('', '', ''); ?>
    </div>
    <?php
}