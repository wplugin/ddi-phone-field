=== DDI Phone Field ===
Contributors: wplugin
Tags: phone, ddi, international, elementor, contact-form-7, woocommerce, phone-number, country-code
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adiciona automaticamente DDI (Discagem Direta Internacional) com bandeiras de países aos campos de telefone dos principais formulários.

== Description ==

O **DDI Phone Field** é um plugin profissional para WordPress que adiciona automaticamente seletores de DDI (Discagem Direta Internacional) com bandeiras de países aos campos de telefone dos principais construtores de formulários.

**Módulo 1 - Elementor Pro (Atual)**

Esta versão inicial foca na integração básica e limpa com o Elementor Pro:

* ✅ **Detecção automática** de campos de telefone no Elementor Pro
* ✅ **Inserção de dropdown** com bandeiras de países + DDI  
* ✅ **Preservação do placeholder** original
* ✅ **Validação compatível** com regex do Elementor Pro
* ✅ **Configuração padrão**: apenas bandeira (código DDI opcional via admin)

**Características principais:**

* 🌍 Suporte a **240+ países** com bandeiras e códigos DDI
* 🎨 **Interface limpa** que não interfere na digitação do usuário
* ⚡ **Performance otimizada** com carregamento condicional de assets
* 🔧 **Configuração simples** via painel administrativo
* 📱 **Responsivo** e compatível com dispositivos móveis
* ♿ **Acessível** com suporte completo a leitores de tela
* 🛡️ **Seguro** com sanitização e validação de dados

**Funcionalidades do Módulo 1:**

O campo permanece **limpo para digitação livre**. Apenas **bandeira + DDI** são adicionados, com **zero interferência** na digitação do usuário. Foco na funcionalidade básica de seleção de país.

**Próximos Módulos (em desenvolvimento):**

* 📝 **Módulo 2**: Contact Form 7
* ⚙️ **Módulo 3**: Área administrativa avançada  
* 🛒 **Módulo 4**: WooCommerce
* 🎯 **Módulo 5**: Funcionalidades avançadas do Elementor Pro

== Installation ==

1. Faça o upload do plugin para o diretório `/wp-content/plugins/`
2. Ative o plugin através do menu 'Plugins' no WordPress
3. Acesse **Configurações > DDI Phone Field** para configurar
4. O plugin funcionará automaticamente nos formulários do Elementor Pro

**Requisitos:**

* WordPress 5.0 ou superior
* PHP 7.4 ou superior  
* Elementor Pro (para o Módulo 1)

== Frequently Asked Questions ==

= O plugin funciona com todos os temas? =

Sim, o plugin foi desenvolvido para ser compatível com qualquer tema do WordPress, preservando os estilos existentes.

= Posso personalizar as cores e estilos? =

Sim, você pode usar CSS personalizado para ajustar a aparência. Módulos futuros incluirão mais opções de customização.

= O plugin afeta a performance do site? =

Não, os assets são carregados apenas quando necessário e otimizados para performance máxima.

= Funciona em dispositivos móveis? =

Sim, o plugin é totalmente responsivo e otimizado para dispositivos móveis.

= Posso desabilitar para formulários específicos? =

Esta funcionalidade estará disponível nos próximos módulos.

== Screenshots ==

1. **Configurações do Plugin** - Painel administrativo simples e intuitivo
2. **Campo de Telefone** - Integração perfeita com Elementor Pro  
3. **Seletor de País** - Dropdown com bandeiras e códigos DDI
4. **Versão Mobile** - Interface otimizada para dispositivos móveis

== Changelog ==

= 1.0.0 =
* **Lançamento inicial** - Módulo 1: Integração básica com Elementor Pro
* Detecção automática de campos de telefone
* Seletor de país com 240+ bandeiras
* Configurações administrativas básicas
* Suporte completo à internacionalização
* Interface responsiva e acessível

== Upgrade Notice ==

= 1.0.0 =
Versão inicial do plugin com integração básica para Elementor Pro. Módulos adicionais serão lançados em breve.

== Developer Information ==

**Hooks disponíveis:**

* `ddiphonefield_countries` - Filtrar lista de países
* `ddiphonefield_default_country` - Definir país padrão  
* `ddiphonefield_before_field_render` - Antes da renderização do campo

**Exemplo de uso:**

```php
// Definir país padrão
add_filter('ddiphonefield_default_country', function($country) {
    return 'US'; // Estados Unidos
});

// Customizar lista de países
add_filter('ddiphonefield_countries', function($countries) {
    // Remover alguns países
    unset($countries['XX']);
    return $countries;
});
```

**Suporte técnico:** [www.wplugin.com.br](https://www.wplugin.com.br)

== Credits ==

* Desenvolvido por [Wplugin](https://www.wplugin.com.br)
* Bandeiras fornecidas por [flagcdn.com](https://flagcdn.com)
* Baseado na biblioteca [intl-tel-input](https://github.com/jackocnr/intl-tel-input)
