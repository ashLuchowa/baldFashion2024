<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( !empty($settings['menu']) ) {

    if( $settings['menu_type'] == 'vertical' ) { // Vertical Menu

        echo '<nav class="rivax-header-v-nav-wrapper">';
        wp_nav_menu( array(
            'menu' => $settings['menu'],
            'link_before' => '<span>',
            'link_after'=>'</span>',
            'fallback_cb' => false,
            'container' => false,
            'menu_class' => 'rivax-header-v-nav',
        ) );
        echo '</nav>';

    }
    else { // Horizontal Menu

        $hover_shape = $settings['h_menu_hover_shape'] ?: '';

        echo '<nav class="rivax-header-nav-wrapper ' . $hover_shape . '">';
        wp_nav_menu( array(
            'menu' => $settings['menu'],
            'link_before' => '<span>',
            'link_after'=>'</span>',
            'fallback_cb' => false,
            'container' => false,
            'menu_class' => 'rivax-header-nav',
        ) );
        echo '</nav>';

    }
}
