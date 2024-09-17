<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

$animation_types = [
    'clip' => 'clip',
    'rotate-1' => 'rotate-1',
    'rotate-2' => 'letters rotate-2',
    'rotate-3' => 'letters rotate-3',
    'type' => 'letters type',
    'bar-loading' => 'bar-loading',
    'slide' => 'slide',
    'zoom-out' => 'zoom-out',
    'zoom-fade' => 'zoom-fade',
    'scale' => 'letters scale',
    'push' => 'push',
    'color-effect' => 'color-effect',
    'bouncing' => 'letters bouncing'
];

$fancy_animation_type_class = $animation_types[$settings['fancy_animation_type']];

$title_tag = $settings['fancy_text_title_tag'];

$fancy_animation_settings = [
    'animationDelay' => !empty($settings['fancy_animation_delay']) ? (int) $settings['fancy_animation_delay'] : 2500 ,
    'loadingBar' => !empty($settings['fancy_loading_bar']) ? (int) $settings['fancy_loading_bar'] : 3800,
    'lettersDelay' => !empty($settings['fancy_letters_delay']) ? (int) $settings['fancy_letters_delay'] : 50,
    'typeLettersDelay' => !empty($settings['fancy_type_letters_delay']) ? (int) $settings['fancy_type_letters_delay'] :150,
    'duration' => !empty($settings['fancy_selection_duration']) ? (int) $settings['fancy_selection_duration'] : 500,
    'revealDuration' => !empty($settings['fancy_reveal_duration']) ? (int) $settings['fancy_reveal_duration'] : 600,
    'revealAnimationDelay' => !empty($settings['fancy_reveal_animation_delay']) ? (int) $settings['fancy_reveal_animation_delay'] : 1500,
];

$this->add_render_attribute( 'fancy-text-wrap', [
    'class' => [
        'rivax-fancy-text ' . esc_attr($fancy_animation_type_class)
    ],
    'data-animation-settings' => wp_json_encode($fancy_animation_settings),

] );

?>
<<?php echo esc_attr($title_tag); ?> <?php $this->print_render_attribute_string('fancy-text-wrap'); ?>>
    <?php

    if(!empty($settings['fancy_prefix_text'])) : ?>
        <span class="rivax-fancy-prefix-text"><?php echo esc_html($settings['fancy_prefix_text']); ?></span>
    <?php endif;

    $this->add_render_attribute('fancy-text-lists', 'class', ($settings['fancy_animation_type'] == 'type') ? 'rivax-fancy-text-list waiting' : 'rivax-fancy-text-list');
    if(!empty($settings['fancy_gradient'])) {
        $this->add_render_attribute('fancy-text-lists', 'class', 'gradient-list');
    }

    if(!empty($settings['fancy_text_lists'])) : ?>
        <span <?php $this->print_render_attribute_string('fancy-text-lists'); ?>>
            <?php foreach($settings['fancy_text_lists'] as $key => $fancy_text_list): ?>
                <b class="rivax-fancy-text-item elementor-repeater-item-<?php echo esc_attr($fancy_text_list['_id']) ?> <?php echo esc_attr(($key == 0) ? 'is-visible' : ''); ?>"><?php echo esc_html($fancy_text_list['fancy_text']); ?></b>
            <?php endforeach; ?>
        </span>
    <?php endif;

    if(!empty($settings['fancy_suffix_text'])) : ?>
        <span class="rivax-fancy-suffix-text"><?php echo esc_html($settings['fancy_suffix_text']); ?></span>
    <?php endif;

    ?>
</<?php echo esc_attr($title_tag); ?>>

