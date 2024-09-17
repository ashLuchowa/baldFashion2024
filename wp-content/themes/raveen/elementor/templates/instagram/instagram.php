<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$instagram_url = "https://www.instagram.com/" . strtolower( trim( esc_html($settings['username']) ) );
?>
<div class="rivax-insta-wrapper layout-<?php echo esc_attr($settings['layout']);?>">
    <div class="rivax-insta-header">
        <?php if($settings['show_profile_image'] && $settings['profile_image']['id']): ?>
            <div class="rivax-insta-profile-img">
                <?php
                $image = wp_get_attachment_image_src($settings['profile_image']['id'], 'thumbnail');
                if($image) {
                    ?>
                    <a target="_blank" href="<?php echo esc_url($instagram_url); ?>">
                    <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="instagram profile">
                    </a>
                    <?php
                }
                ?>
            </div>
        <?php endif; ?>
        <div class="rivax-insta-info">
            <?php if($settings['show_username'] && $settings['username']): ?>
                <span class="username"><a target="_blank" href="<?php echo esc_url($instagram_url); ?>">@<?php echo esc_attr($settings['username']); ?></a></span>
            <?php endif; ?>
            <?php if($settings['show_tagline'] && $settings['tagline']): ?>
                <span class="tagline"><?php echo esc_html($settings['tagline']); ?></span>
            <?php endif; ?>
        </div>
        <?php if($settings['layout'] != 4 && $settings['show_button'] && $settings['button_text']): ?>
        <div class="rivax-insta-btn-wrap">
            <a target="_blank" class="rivax-insta-btn button" href="<?php echo esc_url($instagram_url); ?>">
                <?php if($settings['button_icon']['value']): ?>
                    <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'] ); ?>
                    </span>
                <?php endif; ?>
                <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <div class="rivax-insta-images layout-<?php echo esc_attr($settings['images_layout']); if($settings['image_hover_shape']) echo ' hover-shape'; ?>">
        <?php
        foreach ( $settings['images'] as $image_item ) {
            $image = wp_get_attachment_image_src($image_item['id'], $settings['thumbnail_size']);
            if($image) {
                ?>
                <div class="insta-item">
                    <a target="_blank" href="<?php echo esc_url($instagram_url); ?>">
                        <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="instagram image">
                        <?php if($settings['image_hover_shape']) { echo '<i class="ri-instagram-line"></i>';} ?>
                    </a>
                </div>
                <?php
            }
        }
        ?>
        <?php if($settings['layout'] == 4 && $settings['show_button'] && $settings['button_text']): ?>
            <div class="rivax-insta-btn-wrap">
                <a target="_blank" class="rivax-insta-btn button" href="<?php echo esc_url($instagram_url); ?>">
                    <?php if($settings['button_icon']['value']): ?>
                        <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_icon'] ); ?>
						</span>
                    <?php endif; ?>
                    <span class="btn-text"><?php echo esc_html($settings['button_text']); ?></span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
