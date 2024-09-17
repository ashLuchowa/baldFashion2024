<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/* Shorthand constants for theme */
define('RIVAX_THEME_URI', get_template_directory_uri());
define('RIVAX_THEME_DIR', get_template_directory());

/* Admin Setup */
require_once RIVAX_THEME_DIR . '/admin/admin.php';

/* Theme Functions */
require_once RIVAX_THEME_DIR . '/inc/functions.php';

/* Mega Menu */
require_once RIVAX_THEME_DIR . '/inc/mega-menu.php';

/* Theme Hooks */
require_once RIVAX_THEME_DIR . '/inc/hooks.php';


/* Theme Setup */
require_once RIVAX_THEME_DIR . '/inc/theme-setup.php';

/* Woocommerce */
if( class_exists( 'WooCommerce' ) ) {
	require_once RIVAX_THEME_DIR . '/inc/woocommerce.php';
}

/* Breadcrumbs */
require_once RIVAX_THEME_DIR . '/inc/breadcrumbs.php';


/* Table of Content */
require_once RIVAX_THEME_DIR . '/inc/toc.php';


/* Elementor */
include_once RIVAX_THEME_DIR . '/elementor/helper.php';
include_once RIVAX_THEME_DIR . '/elementor/elementor.php';
include_once RIVAX_THEME_DIR . '/elementor/elementor-custom-settings.php';
