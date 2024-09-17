<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly


class Rivax_Mega_Menu extends Walker_Nav_Menu {

    function __construct() {

        // Add meta to admin menu item
        add_action('wp_nav_menu_item_custom_fields', array( $this, 'add_meta_admin_menu_item' ), 10, 3 );
        add_action('wp_update_nav_menu_item', array( $this, 'update_meta_admin_menu_item' ), 10, 2 );
        add_action('wp_nav_menu_objects', array( $this, 'remove_default_submenu' ), 10, 2 );
        add_action('walker_nav_menu_start_el', array( $this, 'add_mega_menu_content' ), 10, 4 );
        add_action('nav_menu_css_class', array( $this, 'add_class_mega_menu_li' ), 10, 4 );

    }

    // Add meta to admin menu item
    function add_meta_admin_menu_item ($item_id, $item, $depth) {
        if( $depth != 0 )
            return;

        $current_template = get_post_meta($item_id, 'rivax_mega_menu_template', true);
        $templates = rivax_get_templates_list();

        $templates_default = [0 => $templates[0]]; // 0 => Default
        $new_templates = [
                'rivax-mega-menu-3-col' => esc_html__('Mega Menu 3 Columns', 'raveen'),
                'rivax-mega-menu-4-col' => esc_html__('Mega Menu 4 Columns', 'raveen'),
        ];
        unset($templates[0]);// remove 0 => Default

        $templates = $templates_default + $new_templates + $templates;

        ?>
        <p class="description description-wide">
            <label for="rivax_mega_menu_template-<?php echo esc_attr($item_id); ?>" >
                <?php esc_html_e('Mega Menu Template', 'raveen'); ?>
            </label><br>
            <select name="rivax_mega_menu_template[<?php echo esc_attr($item_id); ?>]" id="rivax_mega_menu_template-<?php echo esc_attr($item_id); ?>">
                <?php
                foreach ($templates as $id => $name) {
                    echo '<option value="' . $id . '" ' . selected($id, $current_template, false) . '>' . esc_html($name) . '</option>';
                }
                ?>
            </select>
        </p>
        <?php
    }


    // Update meta to admin menu item
    function update_meta_admin_menu_item ($menu_id, $menu_item_db_id) {
        $mega_menu_template_id = isset($_POST['rivax_mega_menu_template'][$menu_item_db_id])? esc_html($_POST['rivax_mega_menu_template'][$menu_item_db_id]) : 0;
        if( $mega_menu_template_id ) {
            update_post_meta($menu_item_db_id, 'rivax_mega_menu_template', $mega_menu_template_id );
        }
        else {
            delete_post_meta($menu_item_db_id, 'rivax_mega_menu_template');
        }
    }


    // Remove default sub-menu items from mega menu
    function remove_default_submenu ($sorted_menu_items, $args) {
        if($args->menu_class == 'rivax-header-nav') {
            $sorted_menu_items = array_values($sorted_menu_items); // Fix thirty party plugins for hide menu items
            $new_items = array();
            for($i=0; $i < count($sorted_menu_items); $i++) {
                if($sorted_menu_items[$i]->menu_item_parent == 0) {
                    $new_items[] = $sorted_menu_items[$i];
                    $has_mega_menu = get_post_meta($sorted_menu_items[$i]->ID, 'rivax_mega_menu_template', true);
                    if(intval($has_mega_menu)) { // Skip rivax-mega-menu-3-col, rivax-mega-menu-4-col
                        while(isset($sorted_menu_items[$i+1]) && $sorted_menu_items[$i+1]-> menu_item_parent) {
                            $i++;
                        }
                    }
                }
                else {
                    $new_items[] = $sorted_menu_items[$i];
                }
            }

            return $new_items;
        }

        return $sorted_menu_items;
    }


    // Add mega Menu Content
    function add_mega_menu_content($item_output, $item, $depth, $args) {

        if($args->menu_class == 'rivax-header-nav' && $depth == 0 ) {

            $mega_menu_template = intval(get_post_meta($item->ID, 'rivax_mega_menu_template', true));
            if($mega_menu_template) { // Skip rivax-mega-menu-3-col, rivax-mega-menu-4-col
                $mega_menu_template_content = rivax_get_display_elementor_content($mega_menu_template);
                if($mega_menu_template_content) {
                    $item_output .= '<div class="sub-menu mega-menu-content">';
                    $item_output .= $mega_menu_template_content;
                    $item_output .= '</div>';
                }
            }
        }

        return $item_output;
    }


    // Add class to li
    function add_class_mega_menu_li($classes, $item, $args, $depth) {

        if($args->menu_class == 'rivax-header-nav' && $depth == 0 ) {

            $mega_menu_template = get_post_meta($item->ID, 'rivax_mega_menu_template', true);

            if(in_array($mega_menu_template, ['rivax-mega-menu-3-col', 'rivax-mega-menu-4-col'])) {
                $classes[] = $mega_menu_template;
            }
            elseif($mega_menu_template) { // rivax template
                $classes[] = 'rivax-mega-menu-item';
            }
        }

        return $classes;

    }

}



// Call Rivax_Mega_menu
new Rivax_Mega_Menu();