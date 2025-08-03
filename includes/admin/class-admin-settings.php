<?php
/**
 * Admin settings class
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin settings class
 *
 * @since 1.0.0
 */
class DDI_Phone_Field_Admin_Settings {

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action('admin_init', array($this, 'settings_init'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Initialize settings
     *
     * @since 1.0.0
     * @return void
     */
    public function settings_init() {
        register_setting(
            'ddiphonefield_settings',
            'ddiphonefield_settings',
            array($this, 'sanitize_settings')
        );
    }

    /**
     * Sanitize settings
     *
     * @since 1.0.0
     * @param array $input Settings input
     * @return array
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        // Sanitize default country
        if (isset($input['default_country']) && !empty($input['default_country'])) {
            $countries = DDI_Phone_Field_Helper::get_countries();
            if (array_key_exists($input['default_country'], $countries)) {
                $sanitized['default_country'] = sanitize_text_field($input['default_country']);
            } else {
                $sanitized['default_country'] = 'BR';
            }
        } else {
            $sanitized['default_country'] = 'BR';
        }
        
        // Sanitize show DDI code
        $sanitized['show_ddi_code'] = isset($input['show_ddi_code']) && $input['show_ddi_code'] === '1';
        
        // Sanitize DDI position
        if (isset($input['ddi_position']) && in_array($input['ddi_position'], array('left', 'right'))) {
            $sanitized['ddi_position'] = sanitize_text_field($input['ddi_position']);
        } else {
            $sanitized['ddi_position'] = 'left';
        }
        
        return $sanitized;
    }

    /**
     * Enqueue admin scripts and styles
     *
     * @since 1.0.0
     * @param string $hook Current admin page hook
     * @return void
     */
    public function enqueue_admin_scripts($hook) {
        // Only load on our settings page
        if ($hook !== 'settings_page_ddi-phone-field') {
            return;
        }
        
        wp_enqueue_style(
            'ddiphonefield-admin',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/css/admin.css',
            array(),
            DDIPHONEFIELD_VERSION
        );
        
        wp_enqueue_script(
            'ddiphonefield-admin',
            DDIPHONEFIELD_PLUGIN_URL . 'assets/js/admin.js',
            array('jquery'),
            DDIPHONEFIELD_VERSION,
            true
        );
    }
}
