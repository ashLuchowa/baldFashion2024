<div class="rivax-divider-heading-wrap">
    <div class="rivax-divider-heading divider-style-<?php echo esc_attr($settings[ 'divider_style' ]) ; ?> ">
        <div class="divider divider-1"></div>
        <div class="divider divider-2"></div>
        <<?php echo esc_attr($settings['title_tag']); ?> class="title">
        <?php
        if($settings['title_url']['url']) {
            $this->add_link_attributes( 'link', $settings['title_url'] );

            echo '<a '; $this->print_render_attribute_string( 'link' );  echo '>';
        }
        ?>
        <span class="title-inner">
            <span class="title-text">
                <?php if($settings['title_icon']['value']): ?>
                    <span class="icon">
			            <?php \Elementor\Icons_Manager::render_icon( $settings['title_icon'] ); ?>
                    </span>
                <?php endif; ?>
                <?php echo esc_html($settings[ 'title' ]) ; ?>
            </span>
            <?php if($settings['subtitle']) echo '<span class="subtitle-text-wrap"><span class="subtitle-text">' . esc_html($settings['subtitle']) . '</span></span>'; ?>
        </span>
        <?php
        if($settings['title_url']['url']) {
            echo '</a>';;
        }
        ?>
        </<?php echo esc_attr($settings['title_tag']);  ?>>
        <div class="divider divider-3"></div>
        <div class="divider divider-4"></div>
    </div>
</div>