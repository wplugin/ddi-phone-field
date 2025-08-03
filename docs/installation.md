# Instalação - DDI Phone Field

## Requisitos Mínimos

- **WordPress:** 5.0 ou superior
- **PHP:** 7.4 ou superior  
- **Elementor Pro:** Versão atual (para Módulo 1)

## Instalação via WordPress Admin

1. Acesse **Plugins > Adicionar Novo** no painel administrativo
2. Clique em **Enviar Plugin**
3. Selecione o arquivo `ddi-phone-field.zip`
4. Clique em **Instalar Agora**
5. Ative o plugin após a instalação

## Instalação Manual (FTP)

1. Extraia o arquivo `ddi-phone-field.zip`
2. Faça upload da pasta `ddi-phone-field` para `/wp-content/plugins/`
3. Acesse **Plugins** no painel administrativo
4. Ative o plugin **DDI Phone Field**

## Instalação via WP-CLI

```bash
wp plugin install ddi-phone-field.zip --activate
```

## Configuração Inicial

1. Acesse **Configurações > DDI Phone Field**
2. Selecione o **País Padrão** (Brasil por padrão)
3. Configure se deseja **Exibir Código DDI** (desabilitado por padrão)
4. Escolha a **Posição do DDI** (esquerda ou direita)
5. Clique em **Salvar Alterações**

## Verificação da Integração

### Elementor Pro

1. Crie ou edite uma página com Elementor
2. Adicione um widget **Form**
3. Adicione um campo **Telephone**
4. Visualize a página - o campo deve ter o seletor de país

### Verificação de Funcionamento

- ✅ Campo de telefone mostra bandeira do país padrão
- ✅ Dropdown abre ao clicar na bandeira
- ✅ Lista de países está disponível
- ✅ Seleção de país funciona corretamente
- ✅ Campo de telefone permanece limpo para digitação

## Solução de Problemas

### Plugin não aparece no admin
- Verifique se o WordPress atende aos requisitos mínimos
- Confirme que o arquivo foi extraído corretamente
- Verifique permissões da pasta plugins

### Integração não funciona no Elementor
- Confirme que o Elementor Pro está ativo
- Limpe o cache do Elementor
- Verifique se há conflitos com outros plugins

### Bandeiras não aparecem
- Verifique se as imagens estão na pasta `assets/images/flags/`
- Confirme que o servidor permite carregamento de imagens
- Teste com diferentes navegadores

## Próximos Passos

1. **Configure** as opções básicas
2. **Teste** a funcionalidade em formulários
3. **Aguarde** os próximos módulos (CF7, WooCommerce, etc.)

Para suporte técnico, acesse: [www.wplugin.com.br](https://www.wplugin.com.br)
