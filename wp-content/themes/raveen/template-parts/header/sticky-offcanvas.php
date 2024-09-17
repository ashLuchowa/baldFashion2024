<?php
/**
 * Template part for displaying sticky offcanvas
 */

if(!rivax_get_option('disable-sticky-offcanvas')) {

    $offcanvas_id = rivax_get_layout_template_id('sticky_offcanvas');
    $opener_position = rivax_get_option('sticky-offcanvas-opener-position') ?: 'left';
    $offcanvas_position = rivax_get_option('sticky-offcanvas-position') ?: 'left';
    ?>
    <div id="site-sticky-offcanvas" class="opener-<?php echo esc_attr($opener_position); ?>">
        <div class="rivax-offcanvas">
            <div class="offcanvas-opener-wrapper">
                    <span class="offcanvas-opener">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </span>
            </div>
            <div class="offcanvas-wrapper position-<?php echo esc_attr($offcanvas_position); ?>">
                <div class="offcanvas-container">
                    <div class="offcanvas-container-inner">
                        <span class="offcanvas-closer"></span>
                        <div class="offcanvas-content">
                            <?php
                            if($offcanvas_id) {
                                echo rivax_get_display_elementor_content($offcanvas_id);
                            }
                            else {
                                ?>
                                <div class="default-offcanvas">
                                    <div class="default-offcanvas-logo-wrap">
                                        <a class="default-offcanvas-logo" href="<?php echo esc_url(home_url('/')); ?>">
                                            <?php bloginfo('name'); ?>
                                        </a>
                                    </div>
                                    <?php
                                    if ( has_nav_menu( 'primary_menu' ) ) {
                                        ?>
                                        <nav class="rivax-header-v-nav-wrapper">
                                            <?php    // Menu
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary_menu',
                                                'link_before' => '<span>',
                                                'link_after'=>'</span>',
                                                'fallback_cb' => false,
                                                'container' => false,
                                                'menu_class' => 'rivax-header-v-nav',
                                            ) );
                                            ?>
                                        </nav>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

