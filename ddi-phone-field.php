<?php
/**
 * Plugin Name: DDI Phone Field
 * Plugin URI: https://www.wplugin.com.br
 * Description: Adiciona automaticamente DDI com bandeiras de países aos campos de telefone dos principais formulários: Elementor Pro, Contact Form 7 e WooCommerce.
 * Version: 1.0.0
 * Author: Wplugin
 * Author URI: https://www.wplugin.com.br
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ddi-phone-field
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * Requires PHP: 7.4
 * Network: false
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('DDIPHONEFIELD_VERSION', '1.0.0');
define('DDIPHONEFIELD_PLUGIN_FILE', __FILE__);
define('DDIPHONEFIELD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DDIPHONEFIELD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DDIPHONEFIELD_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('DDIPHONEFIELD_TEXT_DOMAIN', 'ddi-phone-field');

/**
 * Main plugin class
 *
 * @since 1.0.0
 */
final class DDI_Phone_Field {

    /**
     * Plugin instance
     *
     * @since 1.0.0
     * @var DDI_Phone_Field
     */
    private static $instance = null;

    /**
     * Get plugin instance
     *
     * @since 1.0.0
     * @return DDI_Phone_Field
     */
    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    private function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize hooks
     *
     * @since 1.0.0
     * @return void
     */
    private function init_hooks() {
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        add_action('init', array($this, 'init'));
        
        // Plugin activation/deactivation hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    /**
     * Load plugin textdomain
     *
     * @since 1.0.0
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            DDIPHONEFIELD_TEXT_DOMAIN,
            false,
            dirname(DDIPHONEFIELD_PLUGIN_BASENAME) . '/languages/'
        );
    }

    /**
     * Initialize plugin
     *
     * @since 1.0.0
     * @return void
     */
    public function init() {
        // Include required files
        $this->includes();
        
        // Initialize components
        $this->init_components();
    }

    /**
     * Include required files
     *
     * @since 1.0.0
     * @return void
     */
    private function includes() {
        // Core classes
        require_once DDIPHONEFIELD_PLUGIN_DIR . 'includes/core/class-helper.php';
        require_once DDIPHONEFIELD_PLUGIN_DIR . 'includes/core/class-loader.php';
        
        // Admin classes
        require_once DDIPHONEFIELD_PLUGIN_DIR . 'includes/admin/class-admin-menu.php';
        require_once DDIPHONEFIELD_PLUGIN_DIR . 'includes/admin/class-admin-settings.php';
        
        // Integration classes - Module 1: Only Elementor
        if (class_exists('Elementor\Plugin')) {
            require_once DDIPHONEFIELD_PLUGIN_DIR . 'includes/integrations/class-elementor.php';
        }
    }

    /**
     * Initialize components
     *
     * @since 1.0.0
     * @return void
     */
    private function init_components() {
        // Initialize loader
        $loader = new DDI_Phone_Field_Loader();
        
        // Initialize admin
        if (is_admin()) {
            new DDI_Phone_Field_Admin_Menu();
            new DDI_Phone_Field_Admin_Settings();
        }
        
        // Initialize integrations - Module 1: Only Elementor
        if (class_exists('Elementor\Plugin')) {
            new DDI_Phone_Field_Elementor();
        }
        
        // Run loader
        $loader->run();
    }

    /**
     * Plugin activation
     *
     * @since 1.0.0
     * @return void
     */
    public function activate() {
        // Set default options
        $default_options = array(
            'default_country' => 'BR',
            'show_ddi_code' => false,
            'ddi_position' => 'left'
        );
        
        add_option('ddiphonefield_settings', $default_options);
        
        // Flush rewrite rules
        flush_rewrite_rules();
        
        do_action('ddiphonefield_activated');
    }

    /**
     * Plugin deactivation
     *
     * @since 1.0.0
     * @return void
     */
    public function deactivate() {
        // Flush rewrite rules
        flush_rewrite_rules();
        
        do_action('ddiphonefield_deactivated');
    }
}

/**
 * Initialize plugin
 *
 * @since 1.0.0
 * @return DDI_Phone_Field
 */
function ddiphonefield_wplugin() {
    return DDI_Phone_Field::instance();
}

// Start the plugin
ddiphonefield_wplugin();
