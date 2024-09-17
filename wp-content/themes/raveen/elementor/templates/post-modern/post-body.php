<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_attr($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>
        <?php if(has_post_thumbnail()): ?>
        <div class="image-outer-wrapper">
            <div class="image-wrapper">
                <?php
                $thumb_args = [ 'title' => get_the_title() ];
                if(0 <= $current_post_num && $current_post_num < intval($settings['skip_lazy_loading']) ) {
                    $thumb_args ['loading'] = 'eager'; // Defaults is 'lazy'
                }
                the_post_thumbnail($settings['thumbnail_size'], $thumb_args);
                ?>
		        <?php
		        if($settings['image_link']) {
			        echo '<a class="image-link rivax-position-cover" aria-label="Item Link" href="' . get_permalink() . '"></a>';
		        }
		        ?>
		        <?php $this->render_top_content(); ?>
		        <?php $this->render_post_format_icon(); ?>

		        <?php if($settings['author_position'] == 'inside-top'): ?>
                    <div class="content-wrapper-inside rivax-position-top">
				        <?php $this->render_author(); ?>
                    </div>
		        <?php endif; ?>

		        <?php if($settings['terms_position'] == 'inside'): ?>
                    <div class="terms-wrapper-inside rivax-position-bottom">
				        <?php $this->render_terms(); ?>
                    </div>
		        <?php endif; ?>

                <?php
                if($settings['show_image_svg_cover']) {
                    rivax_the_svg_cover ($settings['image_svg_cover']);
                }
                ?>

            </div>
            
	        <?php if($settings['counter_position'] == 'inside-image'): ?>
                <div class="post-counter-wrap counter-inside-image rivax-position-<?php echo esc_attr($settings['counter_inside_position']); ?>">
                    <span class="post-counter"></span>
                </div>
	        <?php endif; ?>

        </div>
        <?php endif; ?>
        <div class="content-wrapper">
	        <?php if($settings['counter_position'] == 'outside-image'): ?>
                <div class="post-counter-wrap counter-outside-image rivax-position-<?php echo esc_attr($settings['counter_inside_position']); ?>">
                    <span class="post-counter"></span>
                </div>
	        <?php endif; ?>
            <?php if($settings['terms_position'] == 'outside') { $this->render_terms(); } ?>
            <?php $this->render_title(); ?>
            <div class="meta-wrapper">
	            <?php if($settings['author_position'] == 'inline') { $this->render_author(); }; ?>
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