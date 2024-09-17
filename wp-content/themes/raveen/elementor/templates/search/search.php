<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$search_type = ( isset($settings['search_type']) && $settings['search_type'] == 'inline' )? 'inline' : 'popup';
?>
<?php if($search_type == 'popup'): ?>
<div class="popup-search-wrapper">
    <div class="popup-search-opener-wrapper">
        <span class="popup-search-opener"><i class="ri-search-2-line"></i></span>
    </div>
    <?php get_template_part("elementor/templates/search/popup-search-content"); ?>
</div>

<?php else: ?>
<div class="inline-search-form-wrapper">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="inline-search-form">
        <input type="text" name="s" value="" class="search-field" placeholder="<?php esc_attr_e('Search ...', 'raveen'); ?>" aria-label="Search" required>
        <button type="submit" class="submit" aria-label="Submit">
            <?php if($settings['inline_btn_title']): ?><span class="title"><?php echo esc_html($settings['inline_btn_title']); ?></span><?php endif; ?>
            <?php if($settings['inline_show_icon'] == 'yes'): ?><i class="ri-search-2-line"></i><?php endif; ?>
        </button>
    </form>
</div>
<?php endif; ?>