<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_dark_mode_enabled() && !rivax_get_option('always-dark-mode') ) {
    ?>
    <div class="dark-mode-switcher-wrap">
        <div class="dark-mode-switcher">
            <span class="dark-mode-switcher-state"></span>
            <span class="dark-mode-switcher-light">
                <i class="ri-sun-fill"></i>
            </span>
            <span class="dark-mode-switcher-dark">
                <i class="ri-moon-stars"></i>
            </span>
        </div>
    </div>
    <?php
}