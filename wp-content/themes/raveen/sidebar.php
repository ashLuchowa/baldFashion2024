<?php
/**
 * Template part for displaying sidebar content
 */

$cls = '';

$template_id = rivax_get_layout_template_id('sidebar');


$sidebar = rivax_get_display_elementor_content($template_id);
if($sidebar) {
    $cls = 'elementor-sidebar';
}
elseif( is_active_sidebar( 'rivax_sidebar_widgets' ) ) {
    $cls = 'wp-sidebar';
}
?>
<div class="sidebar-container-inner <?php echo esc_attr($cls); ?>">
    <?php
    if($cls == 'elementor-sidebar') {
        echo apply_filters('rivax_print_sidebar_template', $sidebar);
    }
    elseif( $cls == 'wp-sidebar' ) {
        dynamic_sidebar( 'rivax_sidebar_widgets' );
    }

    ?>
</div>