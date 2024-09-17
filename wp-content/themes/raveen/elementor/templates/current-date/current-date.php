<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="current-date-wrapper">
    <div class="current-date">
        <?php if($settings['date_icon']['value']): ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['date_icon'] ); ?>
            </div>
        <?php endif; ?>
        <?php if($settings['date_title']): ?>
            <div class="title">
                <?php echo esc_html($settings['date_title']); ?>
            </div>
        <?php endif; ?>
        <div class="date">
            <?php echo current_time($settings['date_format'], true); ?>
        </div>
    </div>
</div>
