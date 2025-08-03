/**
 * DDI Phone Field - Frontend Scripts
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    // Global settings
    var settings = window.ddiphonefield_settings || {};
    var instances = [];
    
    /**
     * DDI Phone Field class
     */
    function DDIPhoneField(element, options) {
        this.element = element;
        this.$element = $(element);
        this.options = $.extend({}, {
            defaultCountry: settings.default_country || 'BR',
            showDDICode: settings.show_ddi_code || false,
            ddiPosition: settings.ddi_position || 'left',
            countries: settings.countries || {},
            flagBaseUrl: settings.flag_base_url || '',
            allowSearch: true,
            autoFormat: false // Module 1: No formatting
        }, options);
        
        this.isOpen = false;
        this.selectedCountry = this.options.defaultCountry;
        this.filteredCountries = [];
        
        this.init();
    }
    
    DDIPhoneField.prototype = {
        
        /**
         * Initialize the phone field
         */
        init: function() {
            this.createContainer();
            this.createCountrySelector();
            this.createDropdown();
            this.bindEvents();
            this.setInitialCountry();
            
            // Store instance
            instances.push(this);
            
            // Fire custom event
            this.$element.trigger('ddiphonefield:init', [this]);
        },
        
        /**
         * Create the main container
         */
        createContainer: function() {
            var positionClass = this.options.ddiPosition === 'right' ? 'position-right' : 'position-left';
            var showDDIClass = this.options.showDDICode ? 'show-ddi-code' : 'hide-ddi-code';
            
            this.$container = $('<div class="ddiphonefield-container ' + positionClass + ' ' + showDDIClass + '"></div>');
            
            // Wrap the input
            this.$element.wrap(this.$container);
            this.$container = this.$element.closest('.ddiphonefield-container');
            
            // Add class to input
            this.$element.addClass('ddiphonefield-tel-input');
            
            // Preserve original placeholder
            this.originalPlaceholder = this.$element.attr('placeholder') || '';
        },
        
        /**
         * Create country selector
         */
        createCountrySelector: function() {
            this.$selector = $('<div class="ddiphonefield-country-selector" tabindex="0" role="button" aria-haspopup="listbox" aria-expanded="false"></div>');
            this.$flag = $('<div class="ddiphonefield-flag"></div>');
            this.$ddiCode = $('<span class="ddiphonefield-ddi-code"></span>');
            this.$arrow = $('<div class="ddiphonefield-arrow"></div>');
            
            this.$selector.append(this.$flag);
            
            if (this.options.showDDICode) {
                this.$selector.append(this.$ddiCode);
            }
            
            this.$selector.append(this.$arrow);
            
            // Insert selector based on position
            if (this.options.ddiPosition === 'right') {
                this.$container.append(this.$selector);
            } else {
                this.$container.prepend(this.$selector);
            }
        },
        
        /**
         * Create dropdown list
         */
        createDropdown: function() {
            this.$dropdown = $('<div class="ddiphonefield-dropdown" role="listbox" aria-label="' + this.getTranslation('selectCountry') + '"></div>');
            
            if (this.options.allowSearch) {
                this.$search = $('<input type="text" class="ddiphonefield-search" placeholder="' + this.getTranslation('searchCountry') + '" aria-label="' + this.getTranslation('searchCountry') + '">');
                this.$dropdown.append(this.$search);
            }
            
            this.$dropdownList = $('<div class="ddiphonefield-dropdown-list"></div>');
            this.$dropdown.append(this.$dropdownList);
            
            this.$container.append(this.$dropdown);
            
            this.populateDropdown();
        },
        
        /**
         * Populate dropdown with countries
         */
        populateDropdown: function() {
            var self = this;
            this.filteredCountries = [];
            this.$dropdownList.empty();
            
            $.each(this.options.countries, function(code, data) {
                var $item = $('<div class="ddiphonefield-dropdown-item" data-country="' + code + '" role="option" tabindex="0"></div>');
                var $flag = $('<div class="ddiphonefield-flag flag-' + code.toLowerCase() + '"></div>');
                var $name = $('<span class="ddiphonefield-country-name">' + data.name + '</span>');
                var $ddi = $('<span class="ddiphonefield-ddi-code">' + data.ddi + '</span>');
                
                $item.append($flag).append($name).append($ddi);
                
                if (code === self.selectedCountry) {
                    $item.addClass('selected');
                }
                
                self.filteredCountries.push({
                    code: code,
                    data: data,
                    element: $item
                });
                
                self.$dropdownList.append($item);
            });
        },
        
        /**
         * Filter countries based on search
         */
        filterCountries: function(query) {
            var self = this;
            query = query.toLowerCase();
            
            this.$dropdownList.find('.ddiphonefield-dropdown-item').each(function() {
                var $item = $(this);
                var countryCode = $item.data('country');
                var countryData = self.options.countries[countryCode];
                
                if (!countryData) return;
                
                var name = countryData.name.toLowerCase();
                var ddi = countryData.ddi.toLowerCase();
                var visible = name.includes(query) || ddi.includes(query) || countryCode.toLowerCase().includes(query);
                
                $item.toggle(visible);
            });
            
            // Show no results message if needed
            var visibleItems = this.$dropdownList.find('.ddiphonefield-dropdown-item:visible');
            if (visibleItems.length === 0) {
                if (!this.$noResults) {
                    this.$noResults = $('<div class="ddiphonefield-no-results">' + this.getTranslation('noResults') + '</div>');
                }
                this.$dropdownList.append(this.$noResults);
            } else {
                if (this.$noResults) {
                    this.$noResults.remove();
                }
            }
        },
        
        /**
         * Bind events
         */
        bindEvents: function() {
            var self = this;
            
            // Selector click
            this.$selector.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                self.toggleDropdown();
            });
            
            // Selector keyboard navigation
            this.$selector.on('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    self.toggleDropdown();
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    self.openDropdown();
                    self.focusFirstItem();
                }
            });
            
            // Dropdown item click
            this.$dropdownList.on('click', '.ddiphonefield-dropdown-item', function(e) {
                e.preventDefault();
                var countryCode = $(this).data('country');
                self.selectCountry(countryCode);
                self.closeDropdown();
            });
            
            // Dropdown item keyboard navigation
            this.$dropdownList.on('keydown', '.ddiphonefield-dropdown-item', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    var countryCode = $(this).data('country');
                    self.selectCountry(countryCode);
                    self.closeDropdown();
                } else if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    var $next = $(this).next('.ddiphonefield-dropdown-item:visible');
                    if ($next.length) {
                        $next.focus();
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    var $prev = $(this).prev('.ddiphonefield-dropdown-item:visible');
                    if ($prev.length) {
                        $prev.focus();
                    } else {
                        self.$search && self.$search.focus();
                    }
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    self.closeDropdown();
                    self.$selector.focus();
                }
            });
            
            // Search functionality
            if (this.$search) {
                this.$search.on('input', function() {
                    self.filterCountries($(this).val());
                });
                
                this.$search.on('keydown', function(e) {
                    if (e.key === 'ArrowDown') {
                        e.preventDefault();
                        var $first = self.$dropdownList.find('.ddiphonefield-dropdown-item:visible').first();
                        if ($first.length) {
                            $first.focus();
                        }
                    } else if (e.key === 'Escape') {
                        e.preventDefault();
                        self.closeDropdown();
                        self.$selector.focus();
                    }
                });
            }
            
            // Click outside to close
            $(document).on('click.ddiphonefield', function(e) {
                if (!$(e.target).closest('.ddiphonefield-container').length) {
                    self.closeDropdown();
                }
            });
            
            // Phone input events
            this.$element.on('focus', function() {
                self.$container.addClass('focused');
            });
            
            this.$element.on('blur', function() {
                self.$container.removeClass('focused');
            });
            
            // Form validation events
            this.$element.on('input', function() {
                self.onPhoneInput();
            });
            
            // Preserve Elementor Pro events
            this.$element.on('elementor/form/validate', function(e, field) {
                self.onElementorValidate(e, field);
            });
        },
        
        /**
         * Handle phone input
         */
        onPhoneInput: function() {
            var value = this.$element.val();
            
            // Module 1: No formatting, just preserve value
            // Fire custom event
            this.$element.trigger('ddiphonefield:input', [value, this.selectedCountry]);
        },
        
        /**
         * Handle Elementor Pro validation
         */
        onElementorValidate: function(e, field) {
            // Ensure compatibility with Elementor Pro validation
            var value = this.$element.val();
            var fullNumber = this.getFullNumber();
            
            // Fire custom event for external validation
            this.$element.trigger('ddiphonefield:validate', [value, fullNumber, this.selectedCountry]);
        },
        
        /**
         * Set initial country
         */
        setInitialCountry: function() {
            this.selectCountry(this.selectedCountry);
        },
        
        /**
         * Select a country
         */
        selectCountry: function(countryCode) {
            if (!this.options.countries[countryCode]) {
                return;
            }
            
            var countryData = this.options.countries[countryCode];
            this.selectedCountry = countryCode;
            
            // Update flag
            this.$flag.removeClass().addClass('ddiphonefield-flag flag-' + countryCode.toLowerCase());
            
            // Update DDI code
            if (this.options.showDDICode) {
                this.$ddiCode.text(countryData.ddi);
            }
            
            // Update dropdown selection
            this.$dropdownList.find('.ddiphonefield-dropdown-item').removeClass('selected');
            this.$dropdownList.find('.ddiphonefield-dropdown-item[data-country="' + countryCode + '"]').addClass('selected');
            
            // Update ARIA labels
            this.$selector.attr('aria-label', this.getTranslation('selectedCountry') + ': ' + countryData.name);
            
            // Fire custom event
            this.$element.trigger('ddiphonefield:countrychange', [countryCode, countryData]);
        },
        
        /**
         * Get full phone number with DDI
         */
        getFullNumber: function() {
            var countryData = this.options.countries[this.selectedCountry];
            var phoneNumber = this.$element.val().trim();
            
            if (!phoneNumber || !countryData) {
                return phoneNumber;
            }
            
            // If number already starts with +, return as is
            if (phoneNumber.startsWith('+')) {
                return phoneNumber;
            }
            
            // If number starts with DDI without +, add +
            if (phoneNumber.startsWith(countryData.ddi.substring(1))) {
                return '+' + phoneNumber;
            }
            
            // Add full DDI
            return countryData.ddi + phoneNumber;
        },
        
        /**
         * Open dropdown
         */
        openDropdown: function() {
            if (this.isOpen) return;
            
            this.isOpen = true;
            this.$dropdown.addClass('open').show();
            this.$selector.addClass('open').attr('aria-expanded', 'true');
            this.$arrow.addClass('open');
            
            // Focus search if available
            if (this.$search) {
                setTimeout(function() {
                    this.$search.focus();
                }.bind(this), 100);
            }
            
            // Fire custom event
            this.$element.trigger('ddiphonefield:open');
        },
        
        /**
         * Close dropdown
         */
        closeDropdown: function() {
            if (!this.isOpen) return;
            
            this.isOpen = false;
            this.$dropdown.removeClass('open').hide();
            this.$selector.removeClass('open').attr('aria-expanded', 'false');
            this.$arrow.removeClass('open');
            
            // Clear search
            if (this.$search) {
                this.$search.val('');
                this.filterCountries('');
            }
            
            // Fire custom event
            this.$element.trigger('ddiphonefield:close');
        },
        
        /**
         * Toggle dropdown
         */
        toggleDropdown: function() {
            if (this.isOpen) {
                this.closeDropdown();
            } else {
                this.openDropdown();
            }
        },
        
        /**
         * Focus first visible item
         */
        focusFirstItem: function() {
            var $first = this.$dropdownList.find('.ddiphonefield-dropdown-item:visible').first();
            if ($first.length) {
                $first.focus();
            }
        },
        
        /**
         * Get translation
         */
        getTranslation: function(key) {
            var translations = {
                selectCountry: 'Selecionar país',
                searchCountry: 'Pesquisar país',
                noResults: 'Nenhum resultado encontrado',
                selectedCountry: 'País selecionado'
            };
            
            return translations[key] || key;
        },
        
        /**
         * Destroy instance
         */
        destroy: function() {
            // Remove events
            $(document).off('click.ddiphonefield');
            this.$element.off('.ddiphonefield');
            
            // Remove DOM elements
            if (this.$dropdown) {
                this.$dropdown.remove();
            }
            
            if (this.$selector) {
                this.$selector.remove();
            }
            
            // Unwrap element
            this.$element.removeClass('ddiphonefield-tel-input').unwrap();
            
            // Remove from instances
            var index = instances.indexOf(this);
            if (index > -1) {
                instances.splice(index, 1);
            }
            
            // Fire custom event
            this.$element.trigger('ddiphonefield:destroy');
        }
    };
    
    /**
     * jQuery plugin
     */
    $.fn.ddiPhoneField = function(options) {
        return this.each(function() {
            var $this = $(this);
            var instance = $this.data('ddiphonefield');
            
            if (!instance) {
                instance = new DDIPhoneField(this, options);
                $this.data('ddiphonefield', instance);
            }
            
            if (typeof options === 'string') {
                if (typeof instance[options] === 'function') {
                    instance[options].apply(instance, Array.prototype.slice.call(arguments, 1));
                }
            }
        });
    };
    
    /**
     * Auto-initialize on DOM ready
     */
    $(document).ready(function() {
        // Initialize Elementor Pro phone fields
        $('.elementor-field-type-tel input[type="tel"], input[type="tel"].ddiphonefield-tel-input').each(function() {
            if (!$(this).data('ddiphonefield')) {
                $(this).ddiPhoneField();
            }
        });
        
        // Re-initialize on Elementor Pro form updates
        $(document).on('elementor/popup/show elementor/frontend/init', function() {
            setTimeout(function() {
                $('.elementor-field-type-tel input[type="tel"]').each(function() {
                    if (!$(this).data('ddiphonefield')) {
                        $(this).ddiPhoneField();
                    }
                });
            }, 100);
        });
    });
    
    /**
     * Expose globally
     */
    window.DDIPhoneField = DDIPhoneField;
    
})(jQuery);
