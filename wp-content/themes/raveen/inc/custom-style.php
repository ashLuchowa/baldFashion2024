<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$custom_css = '';

// Set Container Width
$site_width = absint(rivax_get_option('site-width')) ?: '1600';
$custom_css .= ".container { max-width: " . $site_width . "px; }";
$custom_css .= "body .e-con { --container-max-width: " . $site_width . "px; }";


// Accent Colors
if(rivax_get_option('accent-color')) {
    $custom_css .= ':root { --accent-color: ' . rivax_get_option('accent-color') . ';}';
}

if(rivax_get_option('second-color')) {
    $custom_css .= ':root { --second-color: ' . rivax_get_option('second-color') . ';}';
}

// Styling
if(rivax_get_option('body-bg')) {
    $custom_css .= ':root { --body-bg-color: ' . rivax_get_option('body-bg') . ';}';
}

if(rivax_get_option('site-bg')) {
    $custom_css .= ':root { --site-bg-color: ' . rivax_get_option('site-bg') . ';}';
}

if(rivax_get_option('body-color')) {
    $custom_css .= ':root { --body-color: ' . rivax_get_option('body-color') . ';}';
}

if(rivax_get_option('heading-color')) {
    $custom_css .= ':root { --headings-color: ' . rivax_get_option('heading-color') . ';}';
}

if(rivax_get_option('single-progress-bar-bg', 'from') && rivax_get_option('single-progress-bar-bg', 'to') ) {
    $from = rivax_get_option('single-progress-bar-bg', 'from');
    $to = rivax_get_option('single-progress-bar-bg', 'to');
    $custom_css .= '.post-reading-progress-indicator span { background: linear-gradient(90deg, ' . $from . ', ' . $to . ');}';
}

if(rivax_get_option('single-category-bg')) {
    $custom_css .= '.single-hero-title .category a { background: ' . rivax_get_option('single-category-bg') . ';}';
}

if(rivax_get_option('single-category-bg-hover')) {
    $custom_css .= '.single-hero-title .category a:hover { background: ' . rivax_get_option('single-category-bg-hover') . ';}';
}

if(rivax_get_option('button-bg-hover')) {
    $custom_css .= ':root { --button-bg-hover: ' . rivax_get_option('button-bg-hover') . ';}';
}


// Dark Mode style
if(rivax_get_option('accent-color-dark')) {
    $custom_css .= 'body.dark-mode { --accent-color: ' . rivax_get_option('accent-color-dark') . ';}';
}

if(rivax_get_option('second-color-dark')) {
    $custom_css .= 'body.dark-mode { --second-color: ' . rivax_get_option('second-color-dark') . ';}';
}

if(rivax_get_option('body-bg-dark')) {
    $custom_css .= 'body.dark-mode { --body-bg-color: ' . rivax_get_option('body-bg-dark') . ';}';
}

if(rivax_get_option('site-bg-dark')) {
    $custom_css .= 'body.dark-mode { --site-bg-color: ' . rivax_get_option('site-bg-dark') . ';}';
}

if(rivax_get_option('body-color-dark')) {
    $custom_css .= 'body.dark-mode { --body-color: ' . rivax_get_option('body-color-dark') . ';}';
}

if(rivax_get_option('heading-color-dark')) {
    $custom_css .= 'body.dark-mode { --headings-color: ' . rivax_get_option('heading-color-dark') . ';}';
}

if(rivax_get_option('single-category-bg-dark')) {
    $custom_css .= 'body.dark-mode .single-hero-title .category a { background: ' . rivax_get_option('single-category-bg-dark') . ';}';
}

if(rivax_get_option('single-category-bg-hover-dark')) {
    $custom_css .= 'body.dark-mode .single-hero-title .category a:hover { background: ' . rivax_get_option('single-category-bg-hover-dark') . ';}';
}

if(rivax_get_option('button-bg-hover-dark')) {
    $custom_css .= 'body.dark-mode { --button-bg-hover: ' . rivax_get_option('button-bg-hover-dark') . ';}';
}


/* Footer Elements */
if(rivax_get_option('back-to-top-bg')) {
    $custom_css .= '#back-to-top { background: ' . rivax_get_option('back-to-top-bg') . ';}';
}



/* Privacy Notice */
if(rivax_get_option('privacy-color')) {
    $custom_css .= '.privacy-notice { color: ' . rivax_get_option('privacy-color') . ';}';
}

if(rivax_get_option('privacy-color-dark')) {
    $custom_css .= 'body.dark-mode .privacy-notice { color: ' . rivax_get_option('privacy-color-dark') . ';}';
}

if(rivax_get_option('privacy-bg')) {
    $custom_css .= '.privacy-notice { background: ' . rivax_get_option('privacy-bg') . ';}';
}

if(rivax_get_option('privacy-bg-dark')) {
    $custom_css .= 'body.dark-mode .privacy-notice { background: ' . rivax_get_option('privacy-bg-dark') . ';}';
}



/* Typography */
if(rivax_get_option('typography-body', 'font-family')) {
    $custom_css .= 'body {';

	$custom_css .= 'font-family: ' . rivax_get_option('typography-body', 'font-family') . ',sans-serif;';

	if(rivax_get_option('typography-body', 'font-weight')) {
		$custom_css .= 'font-weight: ' . rivax_get_option('typography-body', 'font-weight') . ';';
	}
	if(rivax_get_option('typography-body', 'font-style')) {
		$custom_css .= 'font-style: ' . rivax_get_option('typography-body', 'font-style') . ';';
	}

	$custom_css .= '}';
}

if(rivax_get_option('typography-body', 'font-size')) {
    $custom_css .= 'html { font-size: ' . rivax_get_option('typography-body', 'font-size') . ';}';
}

if(rivax_get_option('typography-heading', 'font-family')) {
    $custom_css .= 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {';

	$custom_css .= 'font-family: ' . rivax_get_option('typography-heading', 'font-family') . ',sans-serif;';

	if(rivax_get_option('typography-heading', 'font-weight')) {
		$custom_css .= 'font-weight: ' . rivax_get_option('typography-heading', 'font-weight') . ';';
	}
	if(rivax_get_option('typography-heading', 'font-style')) {
		$custom_css .= 'font-style: ' . rivax_get_option('typography-heading', 'font-style') . ';';
	}

	$custom_css .= '}';
}

if(rivax_get_option('typography-terms', 'font-family')) {
	$custom_css .= '.term-item {';

	$custom_css .= 'font-family: ' . rivax_get_option('typography-terms', 'font-family') . ',sans-serif;';

	if(rivax_get_option('typography-terms', 'font-weight')) {
		$custom_css .= 'font-weight: ' . rivax_get_option('typography-terms', 'font-weight') . ';';
	}
	if(rivax_get_option('typography-terms', 'font-style')) {
		$custom_css .= 'font-style: ' . rivax_get_option('typography-terms', 'font-style') . ';';
	}

	$custom_css .= '}';
}

if(rivax_get_option('h1-font-size')) {
    $custom_css .= 'h1, .h1 { font-size: ' . rivax_get_option('h1-font-size') . ';}';
}

if(rivax_get_option('h2-font-size')) {
    $custom_css .= 'h2, .h2 { font-size: ' . rivax_get_option('h2-font-size') . ';}';
}

if(rivax_get_option('h3-font-size')) {
    $custom_css .= 'h3, .h3 { font-size: ' . rivax_get_option('h3-font-size') . ';}';
}

if(rivax_get_option('h4-font-size')) {
    $custom_css .= 'h4, .h4 { font-size: ' . rivax_get_option('h4-font-size') . ';}';
}

if(rivax_get_option('h5-font-size')) {
    $custom_css .= 'h5, .h5 { font-size: ' . rivax_get_option('h5-font-size') . ';}';
}

if(rivax_get_option('h6-font-size')) {
    $custom_css .= 'h6, .h6 { font-size: ' . rivax_get_option('h6-font-size') . ';}';
}


$custom_css .='@media screen and (max-width: 1024px) {';

if(rivax_get_option('h1-font-size-responsive')) {
    $custom_css .= 'h1, .h1 { font-size: ' . rivax_get_option('h1-font-size-responsive') . ';}';
}

if(rivax_get_option('h2-font-size-responsive')) {
    $custom_css .= 'h2, .h2 { font-size: ' . rivax_get_option('h2-font-size-responsive') . ';}';
}

if(rivax_get_option('h3-font-size-responsive')) {
    $custom_css .= 'h3, .h3 { font-size: ' . rivax_get_option('h3-font-size-responsive') . ';}';
}

if(rivax_get_option('h4-font-size-responsive')) {
    $custom_css .= 'h4, .h4 { font-size: ' . rivax_get_option('h4-font-size-responsive') . ';}';
}

if(rivax_get_option('h5-font-size-responsive')) {
    $custom_css .= 'h5, .h5 { font-size: ' . rivax_get_option('h5-font-size-responsive') . ';}';
}

if(rivax_get_option('h6-font-size-responsive')) {
    $custom_css .= 'h6, .h6 { font-size: ' . rivax_get_option('h6-font-size-responsive') . ';}';
}

$custom_css .='}';