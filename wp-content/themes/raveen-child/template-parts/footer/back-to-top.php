<?php
/**
 * Template part for displaying footer
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if( rivax_get_option('back-to-top') ):
?>
    <div id="back-to-top">
        <i class="ri-arrow-up-s-line"></i>
    </div>
<?php
endif;