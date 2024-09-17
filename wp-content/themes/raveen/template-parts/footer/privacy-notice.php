<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('privacy-notice') ) {
    ?>
    <div class="privacy-notice-wrap <?php echo esc_attr( rivax_get_option('privacy-position') ); ?>">
        <div class="privacy-notice">
            <div class="privacy-content-wrap">
                <?php echo wpautop(wp_kses_post( rivax_get_option('privacy-text') )); ?>
            </div>
            <div class="privacy-btn-wrap">
                <a id="privacy-btn" class="privacy-btn button" href="#"><?php echo esc_html( rivax_get_option('privacy-btn-text') ); ?></a>
            </div>
        </div>
    </div>
    <?php
}