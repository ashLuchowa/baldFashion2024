<?php
/**
 * Template part for displaying single post Standard hero content - Layout 6
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_layout_meta = rivax_get_option('single-layout-6-meta');
if($post_layout_meta) {
    $meta_args = array(
        'category' => $post_layout_meta['category'],
        'author-name' => $post_layout_meta['author-name'],
        'author-avatar' => $post_layout_meta['author-avatar'],
        'date' => $post_layout_meta['date'],
        'date-updated' => $post_layout_meta['date-updated'],
        'reading-time' => $post_layout_meta['reading-time'],
        'views' => $post_layout_meta['views'],
        'comments' => $post_layout_meta['comments'],
    );
}
else {
    $meta_args = [];
}

?>
<div class="single-hero-layout-6" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(NULL, 'full')); ?>);">
    <div class="single-hero-layout-6-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-container">
                    <?php get_template_part('template-parts/post/hero/title-section', '', $meta_args); ?>
                </div>
            </div>
        </div>
    </div>
</div>

