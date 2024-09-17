<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_attr($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>

	    <?php if($settings['counter_position'] == 'outside-image'): ?>
            <div class="post-counter-wrap counter-outside-image">
                <span class="post-counter"></span>
            </div>
	    <?php endif; ?>

        <?php if ( 'yes' == $settings['show_image'] && has_post_thumbnail() ) : ?>
            <div class="image-outer-wrapper">

	            <?php if($settings['counter_position'] == 'inside-image'): ?>
                    <div class="post-counter-wrap counter-inside-image rivax-position-<?php echo esc_attr($settings['counter_inside_image_position']); ?>">
                        <span class="post-counter"></span>
                    </div>
	            <?php endif; ?>

	            <?php if($settings['terms_position'] == 'inside'): ?>
                    <div class="terms-wrapper-inside rivax-position-bottom">
			            <?php $this->render_terms(); ?>
                    </div>
	            <?php endif; ?>

                <div class="image-wrapper">
                    <a class="rivax-position-cover rivax-z-index-10" href="<?php the_permalink(); ?>" aria-label="Item Link"></a>
                    <?php
                    $thumb_args = [ 'title' => get_the_title() ];
                    if(0 <= $current_post_num && $current_post_num < intval($settings['skip_lazy_loading']) ) {
                        $thumb_args ['loading'] = 'eager'; // Defaults is 'lazy'
                    }
                    the_post_thumbnail($settings['thumbnail_size'], $thumb_args);
                    ?>
		            <?php $this->render_post_format_icon(); ?>
                </div>

            </div>
        <?php endif; ?>

        <div class="content-wrapper">
	        <?php if($settings['terms_position'] == 'inline') { $this->render_terms(); } ?>
            <?php $this->render_title(); ?>
            <div class="meta-wrapper">
                <?php $this->render_author(); ?>
                <?php $this->render_date(); ?>
                <?php $this->render_comments(); ?>
                <?php $this->render_views_count(); ?>
                <?php $this->render_reading_time(); ?>
            </div>
            <?php $this->render_excerpt(); ?>
            <?php $this->render_read_more(); ?>
        </div>
    </article>
</div>