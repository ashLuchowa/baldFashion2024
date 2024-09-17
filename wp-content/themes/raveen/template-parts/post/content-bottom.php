<?php
/**
 * Template part for displaying under the single post
 */
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if (is_singular( 'post' )) {
	$template_id = rivax_get_layout_template_id('single_bottom_content');

	if($template_id) {
		$template = rivax_get_display_elementor_content($template_id);
		echo '<div class="single-post-bottom-content">' . $template . '</div>';
	}
}

