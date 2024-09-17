<?php

namespace RivaxStudio\Controls;

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

use \Elementor\Base_Data_Control;

class Ajax_Select2 extends Base_Data_Control
{
    public function get_type()
    {
        return 'rivax-select2';
    }

    public function enqueue()
    {
        wp_register_script('rivax-select2', RIVAX_THEME_URI . '/elementor/controls/assets/js/ajax-select2.js',
            ['jquery-elementor-select2'], '1.0.0', true);
        wp_localize_script(
            'rivax-select2',
            'rivax_select2_localize',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'search_text' => esc_html__('Search', 'raveen'),
            ]
        );
        wp_enqueue_script('rivax-select2');
    }

    protected function get_default_settings()
    {
        return [
            'multiple' => false,
            'posts_source' => 'post',
            'source_type' => 'post',
        ];
    }

    public function content_template()
    {
        $control_uid = $this->get_control_uid();
        ?>
        <# var controlUID = '<?php echo esc_attr($control_uid); ?>'; #>
        <# var currentID = elementor.panel.currentView.currentPageView.model.attributes.settings.attributes[data.name]; #>
        <div class="elementor-control-field">
            <# if ( data.label ) { #>
            <label for="<?php echo esc_attr($control_uid); ?>" class="elementor-control-title">{{{data.label }}}</label>
            <# } #>
            <div class="elementor-control-input-wrapper elementor-control-unit-5">
                <# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
                <select id="<?php echo esc_attr($control_uid); ?>" {{ multiple }} class="rivax-select2" data-setting="{{ data.name }}"></select>
            </div>
        </div>
        <#
        ( function( $ ) {
        $( document.body ).trigger( 'rivax_select2_init',{currentID:data.controlValue,data:data,controlUID:controlUID,multiple:data.multiple} );
        }( jQuery ) );
        #>
        <?php
    }
}
