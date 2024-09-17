<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$post_item_cls = 'post-item';
if( $settings['layout'] == 'carousel' ) {
    $post_item_cls .= ' swiper-slide';
}

?>
<div class="<?php echo esc_attr($post_item_cls); ?>">
    <article <?php post_class( 'post-wrapper' ); ?>>
        <?php
        if($settings['link_wrapper']) {
            echo '<a class="item-link rivax-position-cover" aria-label="Item Link" href="' . get_permalink() . '"></a>';
        }
        ?>
        <div class="image-wrapper">
            <?php
            $thumb_args = [ 'title' => get_the_title() ];
            if(0 <= $current_post_num && $current_post_num < intval($settings['skip_lazy_loading']) ) {
                $thumb_args ['loading'] = 'eager'; // Defaults is 'lazy'
            }
            the_post_thumbnail($settings['thumbnail_size'], $thumb_args);
            ?>
        </div>
	    <?php if($settings['author_position'] == 'top' || $settings['terms_position'] == 'top'): ?>
		    <div class="top-content-wrapper rivax-position-top">
                <?php if($settings['author_position'] == 'top') { $this->render_author(); }; ?>
			    <?php if($settings['terms_position'] == 'top') { $this->render_terms(); }; ?>
            </div>
	    <?php endif; ?>
        <div class="content-wrapper rivax-position-<?php echo esc_attr($settings['content_position']) . ' ' . esc_attr($settings['content_style']); ?>">
            <div class="content-wrapper-inner">
	            <?php if($settings['terms_position'] != 'top') { $this->render_terms(); }; ?>
                <?php $this->render_title(); ?>
	            <?php $this->render_excerpt(); ?>
                <div class="meta-wrapper">
	                <?php if($settings['author_position'] == 'inline') { $this->render_author(); }; ?>
                    <?php $this->render_date(); ?>
                    <?php $this->render_comments(); ?>
                    <?php $this->render_views_count(); ?>
                    <?php $this->render_reading_time(); ?>
                </div>
                <?php if($settings['content_style'] == 'style-3'): ?>
                    <div class="read-more-wrap">
                        <a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html($settings['read_more_text']) ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $this->render_post_format_icon(); ?>
    </article>
</div>