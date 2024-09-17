<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$offcanvas_position = ( $settings['content_position'] == 'right' )? 'position-right' : 'position-left';

?>
<div class="rivax-offcanvas">
    <div class="offcanvas-opener-wrapper">
        <span class="offcanvas-opener">
            <?php
            if($settings['icon_type'] == 'custom') {
                echo '<span class="custom-text">';

	            if($settings['custom_icon']['value']) {
		            echo '<span class="icon">';
		            \Elementor\Icons_Manager::render_icon( $settings['custom_icon'] );
		            echo '</span>';
                }

	            if($settings['custom_text']) {
		            echo '<span class="text">';
		            echo esc_html($settings['custom_text']);
		            echo '</span>';
	            }

                echo '</span>';
            }
            else {
                ?>
                <span class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <?php
                }
            ?>
        </span>
    </div>
    <div class="offcanvas-wrapper <?php echo esc_attr($offcanvas_position); ?>">
        <div class="offcanvas-container">
            <div class="offcanvas-container-inner">
                <span class="offcanvas-closer"></span>
                <div class="offcanvas-content">
                    <?php
                    $template_id = !empty($settings['content_template'])? $settings['content_template'] : 0;
                    if($template_id) {
                        echo rivax_get_display_elementor_content($template_id);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
