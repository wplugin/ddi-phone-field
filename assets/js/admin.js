/**
 * DDI Phone Field - Admin Scripts
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    /**
     * Admin functionality
     */
    var DDIPhoneFieldAdmin = {
        
        /**
         * Initialize
         */
        init: function() {
            this.bindEvents();
            this.updatePreview();
        },
        
        /**
         * Bind events
         */
        bindEvents: function() {
            var self = this;
            
            // Settings form changes
            $('#default_country, #show_ddi_code, #ddi_position').on('change', function() {
                self.updatePreview();
            });
            
            // Form validation
            $('.ddiphonefield-admin-form').on('submit', function(e) {
                return self.validateForm(e);
            });
        },
        
        /**
         * Update preview
         */
        updatePreview: function() {
            var $preview = $('.ddiphonefield-preview-field');
            if (!$preview.length) return;
            
            var defaultCountry = $('#default_country').val() || 'BR';
            var showDDICode = $('#show_ddi_code').is(':checked');
            var ddiPosition = $('#ddi_position').val() || 'left';
            
            // Get country data (simplified for preview)
            var countryNames = {
                'BR': 'Brasil',
                'US': 'Estados Unidos',
                'GB': 'Reino Unido',
                'DE': 'Alemanha',
                'FR': 'França',
                'ES': 'Espanha',
                'IT': 'Itália',
                'CA': 'Canadá',
                'AR': 'Argentina',
                'MX': 'México'
            };
            
            var countryDDI = {
                'BR': '+55',
                'US': '+1',
                'GB': '+44',
                'DE': '+49',
                'FR': '+33',
                'ES': '+34',
                'IT': '+39',
                'CA': '+1',
                'AR': '+54',
                'MX': '+52'
            };
            
            // Update preview
            var $selector = $preview.find('.ddiphonefield-preview-selector');
            var $flag = $preview.find('.ddiphonefield-preview-flag');
            var $ddi = $preview.find('.ddiphonefield-preview-ddi');
            
            // Update flag color based on country
            var flagColors = {
                'BR': 'linear-gradient(135deg, #28a745, #ffc107)',
                'US': 'linear-gradient(135deg, #dc3545, #007bff)',
                'GB': 'linear-gradient(135deg, #dc3545, #007bff)',
                'DE': 'linear-gradient(135deg, #000, #ffc107)',
                'FR': 'linear-gradient(135deg, #007bff, #dc3545)',
                'ES': 'linear-gradient(135deg, #ffc107, #dc3545)',
                'IT': 'linear-gradient(135deg, #28a745, #dc3545)',
                'CA': 'linear-gradient(135deg, #dc3545, #fff)',
                'AR': 'linear-gradient(135deg, #87ceeb, #fff)',
                'MX': 'linear-gradient(135deg, #28a745, #dc3545)'
            };
            
            $flag.css('background', flagColors[defaultCountry] || flagColors['BR']);
            
            // Show/hide DDI code
            if (showDDICode) {
                $ddi.text(countryDDI[defaultCountry] || '+55').show();
            } else {
                $ddi.hide();
            }
            
            // Update position
            $preview.removeClass('position-left position-right').addClass('position-' + ddiPosition);
            
            if (ddiPosition === 'right') {
                $selector.appendTo($preview);
            } else {
                $selector.prependTo($preview);
            }
        },
        
        /**
         * Validate form
         */
        validateForm: function(e) {
            var isValid = true;
            var errors = [];
            
            // Validate default country
            var defaultCountry = $('#default_country').val();
            if (!defaultCountry) {
                errors.push('Por favor, selecione um país padrão.');
                isValid = false;
            }
            
            // Validate DDI position
            var ddiPosition = $('#ddi_position').val();
            if (!ddiPosition || !['left', 'right'].includes(ddiPosition)) {
                errors.push('Por favor, selecione uma posição válida para o DDI.');
                isValid = false;
            }
            
            // Show errors
            if (!isValid) {
                this.showErrors(errors);
                e.preventDefault();
                return false;
            }
            
            return true;
        },
        
        /**
         * Show errors
         */
        showErrors: function(errors) {
            // Remove existing error notices
            $('.ddiphonefield-error-notice').remove();
            
            // Create error notice
            var $notice = $('<div class="notice notice-error ddiphonefield-error-notice"><p><strong>Erro:</strong></p><ul></ul></div>');
            var $list = $notice.find('ul');
            
            $.each(errors, function(index, error) {
                $list.append('<li>' + error + '</li>');
            });
            
            // Insert after page title
            $('.wrap h1').after($notice);
            
            // Scroll to top
            $('html, body').animate({ scrollTop: 0 }, 300);
        },
        
        /**
         * Show success message
         */
        showSuccess: function(message) {
            // Remove existing notices
            $('.ddiphonefield-success-notice').remove();
            
            // Create success notice
            var $notice = $('<div class="notice notice-success ddiphonefield-success-notice is-dismissible"><p>' + message + '</p></div>');
            
            // Insert after page title
            $('.wrap h1').after($notice);
            
            // Auto-hide after 5 seconds
            setTimeout(function() {
                $notice.fadeOut();
            }, 5000);
        }
    };
    
    /**
     * Integration status checker
     */
    var IntegrationChecker = {
        
        /**
         * Initialize
         */
        init: function() {
            this.checkIntegrations();
        },
        
        /**
         * Check integrations
         */
        checkIntegrations: function() {
            // Check Elementor Pro
            this.checkElementorPro();
            
            // Note: Other integrations will be added in future modules
        },
        
        /**
         * Check Elementor Pro
         */
        checkElementorPro: function() {
            var $status = $('.ddiphonefield-integration-elementor');
            if (!$status.length) return;
            
            // Simple check - in real implementation, this would be server-side
            var isActive = $('body').hasClass('elementor-editor-active') || 
                          $('.elementor-element').length > 0 ||
                          window.elementorFrontend !== undefined;
            
            var $icon = $status.find('.ddiphonefield-integration-icon');
            var $name = $status.find('.ddiphonefield-integration-name');
            var $desc = $status.find('.ddiphonefield-integration-description');
            
            if (isActive) {
                $icon.removeClass('inactive').addClass('active').text('✓');
                $name.text('Elementor Pro - Ativo');
                $desc.text('Integração funcionando corretamente.');
            } else {
                $icon.removeClass('active').addClass('inactive').text('✗');
                $name.text('Elementor Pro - Inativo');
                $desc.text('Plugin não detectado ou inativo.');
            }
        }
    };
    
    /**
     * Initialize when document is ready
     */
    $(document).ready(function() {
        DDIPhoneFieldAdmin.init();
        IntegrationChecker.init();
        
        // Handle dismiss notices
        $(document).on('click', '.notice-dismiss', function() {
            $(this).closest('.notice').fadeOut();
        });
    });
    
})(jQuery);
