<?php
/**
 * Template part for displaying default header
 */
?>
<div class="header-default">
    <div class="header-default-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="header-default-tagline"><?php bloginfo('description'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="header-default-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2">
                    <a id="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>
                <div class="col-8">
                    <?php
                    if ( has_nav_menu( 'primary_menu' ) ) {
                        ?>
                            <div class="d-none d-md-flex justify-content-center">
                                <nav class="rivax-header-nav-wrapper">
                                    <?php    // Menu
                                    wp_nav_menu( array(
                                        'theme_location' => 'primary_menu',
                                        'link_before' => '<span>',
                                        'link_after'=>'</span>',
                                        'fallback_cb' => false,
                                        'container' => false,
                                        'menu_class' => 'rivax-header-nav',
                                    ) );
                                    ?>
                                </nav>
                            </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <?php get_template_part('elementor/templates/search/search'); ?>
                </div>
                <div class="col-12">
                    <span class="header-default-sep"></span>
                </div>
            </div>
        </div>
    </div>
</div>
