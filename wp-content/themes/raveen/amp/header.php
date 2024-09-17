<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
        <?php
        // Note: The following two <style> tags are combined into <style amp-custom> via AMP_Style_Sanitizer.
        // Splitting up the styles into two stylesheets allows for plugin-supplied styles via the amp_post_template_css action
        // to be excluded from the styles in the style template part, which are more important given they style the overall page.

        /**
         * Fires when rendering <head> in Reader mode templates.
         *
         * @since 0.2
         *
         * @param AMP_Post_Template $this
         */
        do_action( 'amp_post_template_head', $this );
        ?>
        <style class="style-template-part">
            <?php $this->load_parts( [ 'style' ] ); ?>
        </style>
        <style class="amp-post-template-css-action">
            <?php
             do_action( 'amp_post_template_css', $this );
             ?>
        </style>
    </head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">
<?php
do_action( 'amp_post_template_body_open', $this );
?>
<amp-sidebar id="sidebar-left" class="sidebar-left" layout="nodisplay" side="left">
    <button class="side-nav-closer" on="tap:sidebar-left.close"><span></span><span></span></button>

    <?php if(rivax_get_option('amp-sidebar-search')): ?>
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-form">
            <input type="text" name="s" id="s" value="" class="search-field" placeholder="<?php esc_attr_e('Search ...', 'raveen'); ?>" aria-label="<?php esc_attr_e('Search ...', 'raveen'); ?>" required>
            <button type="submit" class="submit" aria-label="Submit"><?php esc_html_e('Go', 'raveen'); ?></button>
            <input name="amp" value="" type="hidden">
        </form>
    <?php endif; ?>

    <nav class="amp-nav-wrapper">
        <?php    // Menu
        wp_nav_menu( array(
            'theme_location' => 'amp_menu',
            'link_before' => '<span>',
            'link_after'=>'</span>',
            'fallback_cb' => false,
            'container' => false,
            'menu_class' => 'amp-nav',
        ) );
        ?>
    </nav>
</amp-sidebar>
<header id="top" class="amp-wp-header">
    <div class="container">
        <div class="amp-wp-header-wrap">
            <div class="site-logo-wrap">
                 <a id="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                    <?php
                    $logo = rivax_get_option('amp-logo');
                    
                    if( !empty($logo['url']) ) {
                        ?>
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="<?php echo esc_attr($logo['width']); ?>" height="<?php echo esc_attr($logo['height']); ?>">
                        <?php
                    }
                    else {
                        bloginfo('name');
                    }
                    ?>
                </a>
            </div>
            <?php if(rivax_get_option('amp-sidebar-search') || has_nav_menu( 'amp_menu' ) ): ?>
                <div class="side-nav-opener-wrap">
                    <button class="side-nav-opener" on="tap:sidebar-left.toggle"><span></span><span></span><span></span></button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</header>
