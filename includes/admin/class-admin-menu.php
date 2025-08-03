<?php
/**
 * Admin menu class
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin menu class
 *
 * @since 1.0.0
 */
class DDI_Phone_Field_Admin_Menu {

    /**
     * Constructor
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    /**
     * Add admin menu
     *
     * @since 1.0.0
     * @return void
     */
    public function add_admin_menu() {
        add_options_page(
            __('DDI Phone Field', 'ddi-phone-field'),
            __('DDI Phone Field', 'ddi-phone-field'),
            'manage_options',
            'ddi-phone-field',
            array($this, 'admin_page')
        );
    }

    /**
     * Admin page callback
     *
     * @since 1.0.0
     * @return void
     */
    public function admin_page() {
        // Check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        // Get settings
        $settings = DDI_Phone_Field_Helper::get_settings();
        $countries = DDI_Phone_Field_Helper::get_countries();
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <form action="options.php" method="post">
                <?php
                settings_fields('ddiphonefield_settings');
                do_settings_sections('ddiphonefield_settings');
                ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="default_country"><?php _e('País Padrão', 'ddi-phone-field'); ?></label>
                        </th>
                        <td>
                            <select name="ddiphonefield_settings[default_country]" id="default_country">
                                <?php foreach ($countries as $code => $data) : ?>
                                    <option value="<?php echo esc_attr($code); ?>" <?php selected($settings['default_country'], $code); ?>>
                                        <?php echo esc_html($data['name'] . ' (' . $data['ddi'] . ')'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="description"><?php _e('Selecione o país que será exibido por padrão nos campos de telefone.', 'ddi-phone-field'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="show_ddi_code"><?php _e('Exibir Código DDI', 'ddi-phone-field'); ?></label>
                        </th>
                        <td>
                            <input type="checkbox" name="ddiphonefield_settings[show_ddi_code]" id="show_ddi_code" value="1" <?php checked($settings['show_ddi_code'], true); ?> />
                            <label for="show_ddi_code"><?php _e('Exibir o código DDI junto com a bandeira', 'ddi-phone-field'); ?></label>
                            <p class="description"><?php _e('Quando ativado, mostra o código do país (ex: +55) ao lado da bandeira.', 'ddi-phone-field'); ?></p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="ddi_position"><?php _e('Posição do DDI', 'ddi-phone-field'); ?></label>
                        </th>
                        <td>
                            <select name="ddiphonefield_settings[ddi_position]" id="ddi_position">
                                <option value="left" <?php selected($settings['ddi_position'], 'left'); ?>><?php _e('Esquerda', 'ddi-phone-field'); ?></option>
                                <option value="right" <?php selected($settings['ddi_position'], 'right'); ?>><?php _e('Direita', 'ddi-phone-field'); ?></option>
                            </select>
                            <p class="description"><?php _e('Escolha se o seletor de país ficará à esquerda ou direita do campo de telefone.', 'ddi-phone-field'); ?></p>
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
            </form>
            
            <hr>
            
            <h2><?php _e('Módulo 1 - Integração Básica com Elementor Pro', 'ddi-phone-field'); ?></h2>
            <p><?php _e('Esta versão inclui apenas a integração básica com o Elementor Pro:', 'ddi-phone-field'); ?></p>
            <ul>
                <li>✅ <?php _e('Detecção automática de campos de telefone no Elementor Pro', 'ddi-phone-field'); ?></li>
                <li>✅ <?php _e('Inserção de dropdown com bandeiras de países + DDI', 'ddi-phone-field'); ?></li>
                <li>✅ <?php _e('Preservação do placeholder original', 'ddi-phone-field'); ?></li>
                <li>✅ <?php _e('Validação compatível com regex do Elementor Pro', 'ddi-phone-field'); ?></li>
                <li>✅ <?php _e('Configuração padrão: apenas bandeira (código DDI opcional via admin)', 'ddi-phone-field'); ?></li>
            </ul>
            
            <div class="notice notice-info">
                <p><strong><?php _e('Informação:', 'ddi-phone-field'); ?></strong> <?php _e('O campo permanece limpo para digitação livre. Apenas bandeira + DDI são adicionados, com zero interferência na digitação do usuário.', 'ddi-phone-field'); ?></p>
            </div>
        </div>
        <?php
    }
}
