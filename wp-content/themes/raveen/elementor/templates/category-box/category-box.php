<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$cls = ($settings['item_animation'] != 'none')? 'cat-animation-' . $settings['item_animation'] : '';
$v_align = $settings['content_v_align']? ' rivax-position-' . $settings['content_v_align'] : '';
?>
<div class="rivax-categories-box <?php echo esc_attr($cls); ?>">
<?php
foreach (  $settings['category_items'] as $category_item ) {

    if(!$category_item['category'] || !$category_item['category_image']['id'])
        continue;

    $category = get_category($category_item['category']);

    if(!$category)
        continue;
    ?>
    <div class="cat-item term-id-<?php echo intval($category->cat_ID); ?>">
        <div class="image-wrapper">
            <?php
            echo wp_get_attachment_image( $category_item['category_image']['id'], $settings['thumbnail_size'] );
            ?>
            <a class="img-link rivax-position-cover" aria-label="Item Link" <?php if( $settings['open_link_new_tab'] ) echo 'target="_blank"'; ?> href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>"></a>
        </div>
        <div class="content-wrapper<?php echo esc_attr($v_align); ?>">
            <div class="title-wrapper">
                <<?php echo esc_attr($settings['title_tag']); ?> class="title">
                <a <?php if( $settings['open_link_new_tab'] ) echo 'target="_blank"'; ?> href="<?php echo esc_url(get_category_link($category->cat_ID)); ?>" class="title-animation-<?php echo esc_attr($settings['title_hover_style']); ?>" title="<?php echo esc_attr($category->name); ?>">
	                <?php echo esc_html($category->name); ?>
                </a>
            </<?php echo esc_attr($settings['title_tag']); ?>>
            </div>
            <?php if( $settings['show_count'] ): ?>
                <div class="count-wrapper">
                    <span class="count"><?php echo intval($category->count) .  esc_html($settings['category_count_text']); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
?>
</div>
