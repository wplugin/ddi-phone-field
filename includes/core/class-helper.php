<?php
/**
 * Helper functions
 *
 * @package DDI_Phone_Field
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper class for utility functions
 *
 * @since 1.0.0
 */
class DDI_Phone_Field_Helper {

    /**
     * Get country list with DDI codes
     *
     * @since 1.0.0
     * @return array
     */
    public static function get_countries() {
        $countries = array(
            'AD' => array('name' => __('Andorra', 'ddi-phone-field'), 'ddi' => '+376'),
            'AE' => array('name' => __('Emirados Árabes Unidos', 'ddi-phone-field'), 'ddi' => '+971'),
            'AF' => array('name' => __('Afeganistão', 'ddi-phone-field'), 'ddi' => '+93'),
            'AG' => array('name' => __('Antígua e Barbuda', 'ddi-phone-field'), 'ddi' => '+1268'),
            'AI' => array('name' => __('Anguilla', 'ddi-phone-field'), 'ddi' => '+1264'),
            'AL' => array('name' => __('Albânia', 'ddi-phone-field'), 'ddi' => '+355'),
            'AM' => array('name' => __('Armênia', 'ddi-phone-field'), 'ddi' => '+374'),
            'AO' => array('name' => __('Angola', 'ddi-phone-field'), 'ddi' => '+244'),
            'AR' => array('name' => __('Argentina', 'ddi-phone-field'), 'ddi' => '+54'),
            'AS' => array('name' => __('Samoa Americana', 'ddi-phone-field'), 'ddi' => '+1684'),
            'AT' => array('name' => __('Áustria', 'ddi-phone-field'), 'ddi' => '+43'),
            'AU' => array('name' => __('Austrália', 'ddi-phone-field'), 'ddi' => '+61'),
            'AW' => array('name' => __('Aruba', 'ddi-phone-field'), 'ddi' => '+297'),
            'AZ' => array('name' => __('Azerbaijão', 'ddi-phone-field'), 'ddi' => '+994'),
            'BA' => array('name' => __('Bósnia e Herzegovina', 'ddi-phone-field'), 'ddi' => '+387'),
            'BB' => array('name' => __('Barbados', 'ddi-phone-field'), 'ddi' => '+1246'),
            'BD' => array('name' => __('Bangladesh', 'ddi-phone-field'), 'ddi' => '+880'),
            'BE' => array('name' => __('Bélgica', 'ddi-phone-field'), 'ddi' => '+32'),
            'BF' => array('name' => __('Burkina Faso', 'ddi-phone-field'), 'ddi' => '+226'),
            'BG' => array('name' => __('Bulgária', 'ddi-phone-field'), 'ddi' => '+359'),
            'BH' => array('name' => __('Bahrein', 'ddi-phone-field'), 'ddi' => '+973'),
            'BI' => array('name' => __('Burundi', 'ddi-phone-field'), 'ddi' => '+257'),
            'BJ' => array('name' => __('Benin', 'ddi-phone-field'), 'ddi' => '+229'),
            'BM' => array('name' => __('Bermudas', 'ddi-phone-field'), 'ddi' => '+1441'),
            'BN' => array('name' => __('Brunei', 'ddi-phone-field'), 'ddi' => '+673'),
            'BO' => array('name' => __('Bolívia', 'ddi-phone-field'), 'ddi' => '+591'),
            'BR' => array('name' => __('Brasil', 'ddi-phone-field'), 'ddi' => '+55'),
            'BS' => array('name' => __('Bahamas', 'ddi-phone-field'), 'ddi' => '+1242'),
            'BT' => array('name' => __('Butão', 'ddi-phone-field'), 'ddi' => '+975'),
            'BW' => array('name' => __('Botswana', 'ddi-phone-field'), 'ddi' => '+267'),
            'BY' => array('name' => __('Belarus', 'ddi-phone-field'), 'ddi' => '+375'),
            'BZ' => array('name' => __('Belize', 'ddi-phone-field'), 'ddi' => '+501'),
            'CA' => array('name' => __('Canadá', 'ddi-phone-field'), 'ddi' => '+1'),
            'CD' => array('name' => __('Congo (RDC)', 'ddi-phone-field'), 'ddi' => '+243'),
            'CF' => array('name' => __('República Centro-Africana', 'ddi-phone-field'), 'ddi' => '+236'),
            'CG' => array('name' => __('Congo', 'ddi-phone-field'), 'ddi' => '+242'),
            'CH' => array('name' => __('Suíça', 'ddi-phone-field'), 'ddi' => '+41'),
            'CI' => array('name' => __('Costa do Marfim', 'ddi-phone-field'), 'ddi' => '+225'),
            'CK' => array('name' => __('Ilhas Cook', 'ddi-phone-field'), 'ddi' => '+682'),
            'CL' => array('name' => __('Chile', 'ddi-phone-field'), 'ddi' => '+56'),
            'CM' => array('name' => __('Camarões', 'ddi-phone-field'), 'ddi' => '+237'),
            'CN' => array('name' => __('China', 'ddi-phone-field'), 'ddi' => '+86'),
            'CO' => array('name' => __('Colômbia', 'ddi-phone-field'), 'ddi' => '+57'),
            'CR' => array('name' => __('Costa Rica', 'ddi-phone-field'), 'ddi' => '+506'),
            'CU' => array('name' => __('Cuba', 'ddi-phone-field'), 'ddi' => '+53'),
            'CV' => array('name' => __('Cabo Verde', 'ddi-phone-field'), 'ddi' => '+238'),
            'CY' => array('name' => __('Chipre', 'ddi-phone-field'), 'ddi' => '+357'),
            'CZ' => array('name' => __('República Tcheca', 'ddi-phone-field'), 'ddi' => '+420'),
            'DE' => array('name' => __('Alemanha', 'ddi-phone-field'), 'ddi' => '+49'),
            'DJ' => array('name' => __('Djibuti', 'ddi-phone-field'), 'ddi' => '+253'),
            'DK' => array('name' => __('Dinamarca', 'ddi-phone-field'), 'ddi' => '+45'),
            'DM' => array('name' => __('Dominica', 'ddi-phone-field'), 'ddi' => '+1767'),
            'DO' => array('name' => __('República Dominicana', 'ddi-phone-field'), 'ddi' => '+1809'),
            'DZ' => array('name' => __('Argélia', 'ddi-phone-field'), 'ddi' => '+213'),
            'EC' => array('name' => __('Equador', 'ddi-phone-field'), 'ddi' => '+593'),
            'EE' => array('name' => __('Estônia', 'ddi-phone-field'), 'ddi' => '+372'),
            'EG' => array('name' => __('Egito', 'ddi-phone-field'), 'ddi' => '+20'),
            'ER' => array('name' => __('Eritreia', 'ddi-phone-field'), 'ddi' => '+291'),
            'ES' => array('name' => __('Espanha', 'ddi-phone-field'), 'ddi' => '+34'),
            'ET' => array('name' => __('Etiópia', 'ddi-phone-field'), 'ddi' => '+251'),
            'FI' => array('name' => __('Finlândia', 'ddi-phone-field'), 'ddi' => '+358'),
            'FJ' => array('name' => __('Fiji', 'ddi-phone-field'), 'ddi' => '+679'),
            'FK' => array('name' => __('Ilhas Malvinas', 'ddi-phone-field'), 'ddi' => '+500'),
            'FM' => array('name' => __('Micronésia', 'ddi-phone-field'), 'ddi' => '+691'),
            'FO' => array('name' => __('Ilhas Faroe', 'ddi-phone-field'), 'ddi' => '+298'),
            'FR' => array('name' => __('França', 'ddi-phone-field'), 'ddi' => '+33'),
            'GA' => array('name' => __('Gabão', 'ddi-phone-field'), 'ddi' => '+241'),
            'GB' => array('name' => __('Reino Unido', 'ddi-phone-field'), 'ddi' => '+44'),
            'GD' => array('name' => __('Granada', 'ddi-phone-field'), 'ddi' => '+1473'),
            'GE' => array('name' => __('Geórgia', 'ddi-phone-field'), 'ddi' => '+995'),
            'GF' => array('name' => __('Guiana Francesa', 'ddi-phone-field'), 'ddi' => '+594'),
            'GH' => array('name' => __('Gana', 'ddi-phone-field'), 'ddi' => '+233'),
            'GI' => array('name' => __('Gibraltar', 'ddi-phone-field'), 'ddi' => '+350'),
            'GL' => array('name' => __('Groenlândia', 'ddi-phone-field'), 'ddi' => '+299'),
            'GM' => array('name' => __('Gâmbia', 'ddi-phone-field'), 'ddi' => '+220'),
            'GN' => array('name' => __('Guiné', 'ddi-phone-field'), 'ddi' => '+224'),
            'GP' => array('name' => __('Guadalupe', 'ddi-phone-field'), 'ddi' => '+590'),
            'GQ' => array('name' => __('Guiné Equatorial', 'ddi-phone-field'), 'ddi' => '+240'),
            'GR' => array('name' => __('Grécia', 'ddi-phone-field'), 'ddi' => '+30'),
            'GT' => array('name' => __('Guatemala', 'ddi-phone-field'), 'ddi' => '+502'),
            'GU' => array('name' => __('Guam', 'ddi-phone-field'), 'ddi' => '+1671'),
            'GW' => array('name' => __('Guiné-Bissau', 'ddi-phone-field'), 'ddi' => '+245'),
            'GY' => array('name' => __('Guiana', 'ddi-phone-field'), 'ddi' => '+592'),
            'HK' => array('name' => __('Hong Kong', 'ddi-phone-field'), 'ddi' => '+852'),
            'HN' => array('name' => __('Honduras', 'ddi-phone-field'), 'ddi' => '+504'),
            'HR' => array('name' => __('Croácia', 'ddi-phone-field'), 'ddi' => '+385'),
            'HT' => array('name' => __('Haiti', 'ddi-phone-field'), 'ddi' => '+509'),
            'HU' => array('name' => __('Hungria', 'ddi-phone-field'), 'ddi' => '+36'),
            'ID' => array('name' => __('Indonésia', 'ddi-phone-field'), 'ddi' => '+62'),
            'IE' => array('name' => __('Irlanda', 'ddi-phone-field'), 'ddi' => '+353'),
            'IL' => array('name' => __('Israel', 'ddi-phone-field'), 'ddi' => '+972'),
            'IN' => array('name' => __('Índia', 'ddi-phone-field'), 'ddi' => '+91'),
            'IO' => array('name' => __('Território Britânico do Oceano Índico', 'ddi-phone-field'), 'ddi' => '+246'),
            'IQ' => array('name' => __('Iraque', 'ddi-phone-field'), 'ddi' => '+964'),
            'IR' => array('name' => __('Irã', 'ddi-phone-field'), 'ddi' => '+98'),
            'IS' => array('name' => __('Islândia', 'ddi-phone-field'), 'ddi' => '+354'),
            'IT' => array('name' => __('Itália', 'ddi-phone-field'), 'ddi' => '+39'),
            'JM' => array('name' => __('Jamaica', 'ddi-phone-field'), 'ddi' => '+1876'),
            'JO' => array('name' => __('Jordânia', 'ddi-phone-field'), 'ddi' => '+962'),
            'JP' => array('name' => __('Japão', 'ddi-phone-field'), 'ddi' => '+81'),
            'KE' => array('name' => __('Quênia', 'ddi-phone-field'), 'ddi' => '+254'),
            'KG' => array('name' => __('Quirguistão', 'ddi-phone-field'), 'ddi' => '+996'),
            'KH' => array('name' => __('Camboja', 'ddi-phone-field'), 'ddi' => '+855'),
            'KI' => array('name' => __('Kiribati', 'ddi-phone-field'), 'ddi' => '+686'),
            'KM' => array('name' => __('Comores', 'ddi-phone-field'), 'ddi' => '+269'),
            'KN' => array('name' => __('São Cristóvão e Nevis', 'ddi-phone-field'), 'ddi' => '+1869'),
            'KP' => array('name' => __('Coreia do Norte', 'ddi-phone-field'), 'ddi' => '+850'),
            'KR' => array('name' => __('Coreia do Sul', 'ddi-phone-field'), 'ddi' => '+82'),
            'KW' => array('name' => __('Kuwait', 'ddi-phone-field'), 'ddi' => '+965'),
            'KY' => array('name' => __('Ilhas Cayman', 'ddi-phone-field'), 'ddi' => '+1345'),
            'KZ' => array('name' => __('Cazaquistão', 'ddi-phone-field'), 'ddi' => '+7'),
            'LA' => array('name' => __('Laos', 'ddi-phone-field'), 'ddi' => '+856'),
            'LB' => array('name' => __('Líbano', 'ddi-phone-field'), 'ddi' => '+961'),
            'LC' => array('name' => __('Santa Lúcia', 'ddi-phone-field'), 'ddi' => '+1758'),
            'LI' => array('name' => __('Liechtenstein', 'ddi-phone-field'), 'ddi' => '+423'),
            'LK' => array('name' => __('Sri Lanka', 'ddi-phone-field'), 'ddi' => '+94'),
            'LR' => array('name' => __('Libéria', 'ddi-phone-field'), 'ddi' => '+231'),
            'LS' => array('name' => __('Lesoto', 'ddi-phone-field'), 'ddi' => '+266'),
            'LT' => array('name' => __('Lituânia', 'ddi-phone-field'), 'ddi' => '+370'),
            'LU' => array('name' => __('Luxemburgo', 'ddi-phone-field'), 'ddi' => '+352'),
            'LV' => array('name' => __('Letônia', 'ddi-phone-field'), 'ddi' => '+371'),
            'LY' => array('name' => __('Líbia', 'ddi-phone-field'), 'ddi' => '+218'),
            'MA' => array('name' => __('Marrocos', 'ddi-phone-field'), 'ddi' => '+212'),
            'MC' => array('name' => __('Mônaco', 'ddi-phone-field'), 'ddi' => '+377'),
            'MD' => array('name' => __('Moldávia', 'ddi-phone-field'), 'ddi' => '+373'),
            'ME' => array('name' => __('Montenegro', 'ddi-phone-field'), 'ddi' => '+382'),
            'MG' => array('name' => __('Madagascar', 'ddi-phone-field'), 'ddi' => '+261'),
            'MH' => array('name' => __('Ilhas Marshall', 'ddi-phone-field'), 'ddi' => '+692'),
            'MK' => array('name' => __('Macedônia do Norte', 'ddi-phone-field'), 'ddi' => '+389'),
            'ML' => array('name' => __('Mali', 'ddi-phone-field'), 'ddi' => '+223'),
            'MM' => array('name' => __('Myanmar', 'ddi-phone-field'), 'ddi' => '+95'),
            'MN' => array('name' => __('Mongólia', 'ddi-phone-field'), 'ddi' => '+976'),
            'MO' => array('name' => __('Macau', 'ddi-phone-field'), 'ddi' => '+853'),
            'MP' => array('name' => __('Ilhas Marianas do Norte', 'ddi-phone-field'), 'ddi' => '+1670'),
            'MQ' => array('name' => __('Martinica', 'ddi-phone-field'), 'ddi' => '+596'),
            'MR' => array('name' => __('Mauritânia', 'ddi-phone-field'), 'ddi' => '+222'),
            'MS' => array('name' => __('Montserrat', 'ddi-phone-field'), 'ddi' => '+1664'),
            'MT' => array('name' => __('Malta', 'ddi-phone-field'), 'ddi' => '+356'),
            'MU' => array('name' => __('Maurício', 'ddi-phone-field'), 'ddi' => '+230'),
            'MV' => array('name' => __('Maldivas', 'ddi-phone-field'), 'ddi' => '+960'),
            'MW' => array('name' => __('Malawi', 'ddi-phone-field'), 'ddi' => '+265'),
            'MX' => array('name' => __('México', 'ddi-phone-field'), 'ddi' => '+52'),
            'MY' => array('name' => __('Malásia', 'ddi-phone-field'), 'ddi' => '+60'),
            'MZ' => array('name' => __('Moçambique', 'ddi-phone-field'), 'ddi' => '+258'),
            'NA' => array('name' => __('Namíbia', 'ddi-phone-field'), 'ddi' => '+264'),
            'NC' => array('name' => __('Nova Caledônia', 'ddi-phone-field'), 'ddi' => '+687'),
            'NE' => array('name' => __('Níger', 'ddi-phone-field'), 'ddi' => '+227'),
            'NF' => array('name' => __('Ilha Norfolk', 'ddi-phone-field'), 'ddi' => '+672'),
            'NG' => array('name' => __('Nigéria', 'ddi-phone-field'), 'ddi' => '+234'),
            'NI' => array('name' => __('Nicarágua', 'ddi-phone-field'), 'ddi' => '+505'),
            'NL' => array('name' => __('Países Baixos', 'ddi-phone-field'), 'ddi' => '+31'),
            'NO' => array('name' => __('Noruega', 'ddi-phone-field'), 'ddi' => '+47'),
            'NP' => array('name' => __('Nepal', 'ddi-phone-field'), 'ddi' => '+977'),
            'NR' => array('name' => __('Nauru', 'ddi-phone-field'), 'ddi' => '+674'),
            'NU' => array('name' => __('Niue', 'ddi-phone-field'), 'ddi' => '+683'),
            'NZ' => array('name' => __('Nova Zelândia', 'ddi-phone-field'), 'ddi' => '+64'),
            'OM' => array('name' => __('Omã', 'ddi-phone-field'), 'ddi' => '+968'),
            'PA' => array('name' => __('Panamá', 'ddi-phone-field'), 'ddi' => '+507'),
            'PE' => array('name' => __('Peru', 'ddi-phone-field'), 'ddi' => '+51'),
            'PF' => array('name' => __('Polinésia Francesa', 'ddi-phone-field'), 'ddi' => '+689'),
            'PG' => array('name' => __('Papua-Nova Guiné', 'ddi-phone-field'), 'ddi' => '+675'),
            'PH' => array('name' => __('Filipinas', 'ddi-phone-field'), 'ddi' => '+63'),
            'PK' => array('name' => __('Paquistão', 'ddi-phone-field'), 'ddi' => '+92'),
            'PL' => array('name' => __('Polônia', 'ddi-phone-field'), 'ddi' => '+48'),
            'PM' => array('name' => __('São Pedro e Miquelon', 'ddi-phone-field'), 'ddi' => '+508'),
            'PN' => array('name' => __('Ilhas Pitcairn', 'ddi-phone-field'), 'ddi' => '+64'),
            'PR' => array('name' => __('Porto Rico', 'ddi-phone-field'), 'ddi' => '+1787'),
            'PS' => array('name' => __('Palestina', 'ddi-phone-field'), 'ddi' => '+970'),
            'PT' => array('name' => __('Portugal', 'ddi-phone-field'), 'ddi' => '+351'),
            'PW' => array('name' => __('Palau', 'ddi-phone-field'), 'ddi' => '+680'),
            'PY' => array('name' => __('Paraguai', 'ddi-phone-field'), 'ddi' => '+595'),
            'QA' => array('name' => __('Catar', 'ddi-phone-field'), 'ddi' => '+974'),
            'RE' => array('name' => __('Reunião', 'ddi-phone-field'), 'ddi' => '+262'),
            'RO' => array('name' => __('Romênia', 'ddi-phone-field'), 'ddi' => '+40'),
            'RS' => array('name' => __('Sérvia', 'ddi-phone-field'), 'ddi' => '+381'),
            'RU' => array('name' => __('Rússia', 'ddi-phone-field'), 'ddi' => '+7'),
            'RW' => array('name' => __('Ruanda', 'ddi-phone-field'), 'ddi' => '+250'),
            'SA' => array('name' => __('Arábia Saudita', 'ddi-phone-field'), 'ddi' => '+966'),
            'SB' => array('name' => __('Ilhas Salomão', 'ddi-phone-field'), 'ddi' => '+677'),
            'SC' => array('name' => __('Seychelles', 'ddi-phone-field'), 'ddi' => '+248'),
            'SD' => array('name' => __('Sudão', 'ddi-phone-field'), 'ddi' => '+249'),
            'SE' => array('name' => __('Suécia', 'ddi-phone-field'), 'ddi' => '+46'),
            'SG' => array('name' => __('Singapura', 'ddi-phone-field'), 'ddi' => '+65'),
            'SH' => array('name' => __('Santa Helena', 'ddi-phone-field'), 'ddi' => '+290'),
            'SI' => array('name' => __('Eslovênia', 'ddi-phone-field'), 'ddi' => '+386'),
            'SJ' => array('name' => __('Svalbard e Jan Mayen', 'ddi-phone-field'), 'ddi' => '+47'),
            'SK' => array('name' => __('Eslováquia', 'ddi-phone-field'), 'ddi' => '+421'),
            'SL' => array('name' => __('Serra Leoa', 'ddi-phone-field'), 'ddi' => '+232'),
            'SM' => array('name' => __('San Marino', 'ddi-phone-field'), 'ddi' => '+378'),
            'SN' => array('name' => __('Senegal', 'ddi-phone-field'), 'ddi' => '+221'),
            'SO' => array('name' => __('Somália', 'ddi-phone-field'), 'ddi' => '+252'),
            'SR' => array('name' => __('Suriname', 'ddi-phone-field'), 'ddi' => '+597'),
            'SS' => array('name' => __('Sudão do Sul', 'ddi-phone-field'), 'ddi' => '+211'),
            'ST' => array('name' => __('São Tomé e Príncipe', 'ddi-phone-field'), 'ddi' => '+239'),
            'SV' => array('name' => __('El Salvador', 'ddi-phone-field'), 'ddi' => '+503'),
            'SX' => array('name' => __('Sint Maarten', 'ddi-phone-field'), 'ddi' => '+1721'),
            'SY' => array('name' => __('Síria', 'ddi-phone-field'), 'ddi' => '+963'),
            'SZ' => array('name' => __('Eswatini', 'ddi-phone-field'), 'ddi' => '+268'),
            'TC' => array('name' => __('Ilhas Turks e Caicos', 'ddi-phone-field'), 'ddi' => '+1649'),
            'TD' => array('name' => __('Chade', 'ddi-phone-field'), 'ddi' => '+235'),
            'TF' => array('name' => __('Territórios Franceses do Sul', 'ddi-phone-field'), 'ddi' => '+262'),
            'TG' => array('name' => __('Togo', 'ddi-phone-field'), 'ddi' => '+228'),
            'TH' => array('name' => __('Tailândia', 'ddi-phone-field'), 'ddi' => '+66'),
            'TJ' => array('name' => __('Tajiquistão', 'ddi-phone-field'), 'ddi' => '+992'),
            'TK' => array('name' => __('Tokelau', 'ddi-phone-field'), 'ddi' => '+690'),
            'TL' => array('name' => __('Timor-Leste', 'ddi-phone-field'), 'ddi' => '+670'),
            'TM' => array('name' => __('Turcomenistão', 'ddi-phone-field'), 'ddi' => '+993'),
            'TN' => array('name' => __('Tunísia', 'ddi-phone-field'), 'ddi' => '+216'),
            'TO' => array('name' => __('Tonga', 'ddi-phone-field'), 'ddi' => '+676'),
            'TR' => array('name' => __('Turquia', 'ddi-phone-field'), 'ddi' => '+90'),
            'TT' => array('name' => __('Trinidad e Tobago', 'ddi-phone-field'), 'ddi' => '+1868'),
            'TV' => array('name' => __('Tuvalu', 'ddi-phone-field'), 'ddi' => '+688'),
            'TW' => array('name' => __('Taiwan', 'ddi-phone-field'), 'ddi' => '+886'),
            'TZ' => array('name' => __('Tanzânia', 'ddi-phone-field'), 'ddi' => '+255'),
            'UA' => array('name' => __('Ucrânia', 'ddi-phone-field'), 'ddi' => '+380'),
            'UG' => array('name' => __('Uganda', 'ddi-phone-field'), 'ddi' => '+256'),
            'UM' => array('name' => __('Ilhas Menores Distantes dos Estados Unidos', 'ddi-phone-field'), 'ddi' => '+1'),
            'US' => array('name' => __('Estados Unidos', 'ddi-phone-field'), 'ddi' => '+1'),
            'UY' => array('name' => __('Uruguai', 'ddi-phone-field'), 'ddi' => '+598'),
            'UZ' => array('name' => __('Uzbequistão', 'ddi-phone-field'), 'ddi' => '+998'),
            'VA' => array('name' => __('Vaticano', 'ddi-phone-field'), 'ddi' => '+39'),
            'VC' => array('name' => __('São Vicente e Granadinas', 'ddi-phone-field'), 'ddi' => '+1784'),
            'VE' => array('name' => __('Venezuela', 'ddi-phone-field'), 'ddi' => '+58'),
            'VG' => array('name' => __('Ilhas Virgens Britânicas', 'ddi-phone-field'), 'ddi' => '+1284'),
            'VI' => array('name' => __('Ilhas Virgens Americanas', 'ddi-phone-field'), 'ddi' => '+1340'),
            'VN' => array('name' => __('Vietnã', 'ddi-phone-field'), 'ddi' => '+84'),
            'VU' => array('name' => __('Vanuatu', 'ddi-phone-field'), 'ddi' => '+678'),
            'WF' => array('name' => __('Wallis e Futuna', 'ddi-phone-field'), 'ddi' => '+681'),
            'WS' => array('name' => __('Samoa', 'ddi-phone-field'), 'ddi' => '+685'),
            'YE' => array('name' => __('Iêmen', 'ddi-phone-field'), 'ddi' => '+967'),
            'YT' => array('name' => __('Mayotte', 'ddi-phone-field'), 'ddi' => '+262'),
            'ZA' => array('name' => __('África do Sul', 'ddi-phone-field'), 'ddi' => '+27'),
            'ZM' => array('name' => __('Zâmbia', 'ddi-phone-field'), 'ddi' => '+260'),
            'ZW' => array('name' => __('Zimbábue', 'ddi-phone-field'), 'ddi' => '+263')
        );
        
        return apply_filters('ddiphonefield_countries', $countries);
    }

    /**
     * Get plugin settings
     *
     * @since 1.0.0
     * @return array
     */
    public static function get_settings() {
        $default_settings = array(
            'default_country' => 'BR',
            'show_ddi_code' => false,
            'ddi_position' => 'left'
        );
        
        $settings = get_option('ddiphonefield_settings', $default_settings);
        
        return wp_parse_args($settings, $default_settings);
    }

    /**
     * Get country flag URL
     *
     * @since 1.0.0
     * @param string $country_code Country code
     * @return string
     */
    public static function get_flag_url($country_code) {
        $country_code = strtolower($country_code);
        return DDIPHONEFIELD_PLUGIN_URL . 'assets/images/flags/' . $country_code . '.png';
    }

    /**
     * Sanitize phone number
     *
     * @since 1.0.0
     * @param string $phone Phone number
     * @return string
     */
    public static function sanitize_phone($phone) {
        return sanitize_text_field($phone);
    }

    /**
     * Check if integration is enabled
     *
     * @since 1.0.0
     * @param string $integration Integration name
     * @return bool
     */
    public static function is_integration_enabled($integration) {
        $settings = self::get_settings();
        $enabled_integrations = isset($settings['enabled_integrations']) ? $settings['enabled_integrations'] : array('elementor');
        
        return in_array($integration, $enabled_integrations);
    }
}
