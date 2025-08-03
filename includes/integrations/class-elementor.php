<?php
/**
 * Elementor Pro integration
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Elementor Pro integration class
 *
 * @since 1.0.0
 */
class DDI_Phone_Field_Elementor {

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        // Check if Elementor Pro is active
        if (!$this->is_elementor_pro_active()) {
            return;
        }
        
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('elementor_pro/forms/render_field/tel', array($this, 'render_phone_field'), 10, 3);
        add_filter('elementor_pro/forms/field_types', array($this, 'add_phone_field_type'));
    }

    /**
     * Check if Elementor Pro is active
     *
     * @since 1.0.0
     * @return bool
     */
    private function is_elementor_pro_active() {
        return class_exists('ElementorPro\Plugin');
    }

    /**
     * Enqueue frontend scripts and styles
     *
     * @since 1.0.0
     * @return void
     */
    public function enqueue_scripts() {
        // Only load on pages with Elementor content
        if (!$this->has_elementor_content()) {
            return;
        }
        
        // Enqueue styles
        wp_enqueue_style(
            'ddiphonefield-frontend',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/css/frontend.css',
            array(),
            DDIPHONEFIELD_VERSION
        );
        
        wp_enqueue_style(
            'ddiphonefield-flags',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/css/flags.css',
            array(),
            DDIPHONEFIELD_VERSION
        );
        
        // Enqueue scripts
        wp_enqueue_script(
            'ddiphonefield-intl-tel-input',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/js/intl-tel-input.min.js',
            array(),
            DDIPHONEFIELD_VERSION,
            true
        );
        
        wp_enqueue_script(
            'ddiphonefield-frontend',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/js/frontend.js',
            array('jquery', 'ddiphonefield-intl-tel-input'),
            DDIPHONEFIELD_VERSION,
            true
        );
        
        // Localize script
        $settings = DDI_Phone_Field_Helper::get_settings();
        wp_localize_script('ddiphonefield-frontend', 'ddiphonefield_settings', array(
            'default_country' => $settings['default_country'],
            'show_ddi_code' => $settings['show_ddi_code'],
            'ddi_position' => $settings['ddi_position'],
            'countries' => DDI_Phone_Field_Helper::get_countries(),
            'flag_base_url' => DDIPHONEFIELD_PLUGIN_URL . 'assets/images/flags/',
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ddiphonefield_nonce')
        ));
    }

    /**
     * Check if current page has Elementor content
     *
     * @since 1.0.0
     * @return bool
     */
    private function has_elementor_content() {
        global $post;
        
        if (!$post) {
            return false;
        }
        
        return \Elementor\Plugin::$instance->db->is_built_with_elementor($post->ID);
    }

    /**
     * Render phone field with DDI functionality
     *
     * @since 1.0.0
     * @param array $item Field item
     * @param int $item_index Field index
     * @param object $form Form object
     * @return void
     */
    public function render_phone_field($item, $item_index, $form) {
        $form->add_render_attribute(
            'input' . $item_index,
            'class',
            'ddiphonefield-tel-input'
        );
        
        // Add data attributes for phone field
        $form->add_render_attribute(
            'input' . $item_index,
            'data-ddiphonefield',
            'true'
        );
        
        do_action('ddiphonefield_before_field_render', $item, $item_index, $form);
    }

    /**
     * Add phone field type to Elementor Pro
     *
     * @since 1.0.0
     * @param array $field_types Field types
     * @return array
     */
    public function add_phone_field_type($field_types) {
        // Enhance existing tel field type with our functionality
        if (isset($field_types['tel'])) {
            $field_types['tel']['title'] = __('Telefone (com DDI)', 'ddi-phone-field');
        }
        
        return $field_types;
    }
}
