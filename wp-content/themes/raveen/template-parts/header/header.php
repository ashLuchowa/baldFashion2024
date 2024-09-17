<?php
/**
 * Template part for displaying header
 */
?>
<header id="site-header">
<?php
// Singular Custom Header
$header_id = rivax_get_layout_template_id('header');
$header = rivax_get_display_elementor_content($header_id);

if($header) {
    echo apply_filters('rivax_print_header_template', $header);
}
else { // Default header
    get_template_part('template-parts/header/header-default');
}
?>
</header>
