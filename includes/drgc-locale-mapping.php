<?php
/**
 * WP-DR locale mapping.
 *
 * @link       https://www.digitalriver.com
 * @since      1.0.0
 *
 * @package    Digital_River_Global_Commerce
 * @subpackage Digital_River_Global_Commerce/includes
 */

function get_locale_mapping() { // (Will be deprecated once new localization is done)
    return array(
        'af' => '',
        'ar' => 'ar_EG',
        'ary' => 'ar_MA',
        'as' => '',
        'azb' => '',
        'az' => '',
        'bel' => 'be_BY',
        'bg_BG' => 'bg_BG',
        'bn_BD' => '',
        'bo' => '',
        'bs_BA' => '',
        'ca' => 'ca_ES',
        'ceb' => '',
        'cs_CZ' => 'cs_CZ',
        'cy' => '',
        'da_DK' => 'da_DK',
        'de_DE_formal' => 'de_DE',
        'de_DE' => 'de_DE',
        'de_AT' => 'de_AT',
        'de_CH_informal' => 'de_CH',
        'de_CH' => 'de_CH',
        'dzo' => '',
        'el' => 'el_GR',
        'en_US' => 'en_US',
        'en_CA' => 'en_CA',
        'en_AU' => 'en_AU',
        'en_ZA' => 'en_ZA',
        'en_GB' => 'en_GB',
        'en_NZ' => 'en_NZ',
        'en' => 'en_US',
        'eo' => '',
        'es_CL' => 'es_CL',
        'es_ES' => 'es_ES',
        'es_MX' => 'es_MX',
        'es_CR' => 'es_CR',
        'es_VE' => 'es_VE',
        'es_CO' => 'es_CO',
        'es_GT' => 'es_GT',
        'es_PE' => 'es_PE',
        'es_AR' => 'es_AR',
        'et' => 'et_EE',
        'eu' => '',
        'fa_IR' => '',
        'fi' => 'fi_FI',
        'fr_FR' => 'fr_FR',
        'fr_CA' => 'fr_CA',
        'fr_BE' => 'fr_BE',
        'fur' => '',
        'gd' => '',
        'gl_ES' => '',
        'gu' => '',
        'haz' => '',
        'he_IL' => 'iw_IL',
        'hi_IN' => 'hi_IN',
        'hr' => 'hr_HR',
        'hu_HU' => 'hu_HU',
        'hy' => '',
        'id_ID' => 'in_ID',
        'is_IS' => 'is_IS',
        'it_IT' => 'it_IT',
        'ja' => 'ja_JP',
        'jv_ID' => '',
        'ka_GE' => '',
        'kab' => '',
        'kk' => 'kk_KZ',
        'km' => '',
        'ko_KR' => 'ko_KR',
        'ckb' => '',
        'lo' => '',
        'lt_LT' => 'lt_LT',
        'lv' => 'lv_LV',
        'mk_MK' => 'mk_MK',
        'ml_IN' => '',
        'mn' => '',
        'mr' => '',
        'ms_MY' => 'ms_MY',
        'my_MM' => '',
        'nb_NO' => 'no_NO',
        'ne_NP' => '',
        'nl_BE' => 'nl_BE',
        'nl_NL_formal' => 'nl_NL',
        'nl_NL' => 'nl_NL',
        'nn_NO' => 'no_NO_NY',
        'oci' => '',
        'pa_IN' => '',
        'pl_PL' => 'pl_PL',
        'ps' => '',
        'pt_BR' => 'pt_BR',
        'pt_PT' => 'pt_PT',
        'pt_PT_ao90' => 'pt_PT',
        'rhg' => '',
        'ro_RO' => 'ro_RO',
        'ru_RU' => 'ru_RU',
        'sah' => '',
        'si_LK' => '',
        'sk_SK' => 'sk_SK',
        'skr' => '',
        'sl_SI' => 'sl_SI',
        'sq' => 'sq_AL',
        'sr_RS' => 'sr_RS',
        'sv_SE' => 'sv_SE',
        'szl' => '',
        'ta_IN' => '',
        'te' => '',
        'th' => 'th_TH',
        'tl' => '',
        'tr_TR' => 'tr_TR',
        'tt_RU' => '',
        'tah' => '',
        'ug_CN' => '',
        'uk' => 'uk_UA',
        'ur' => '',
        'uz_UZ' => '',
        'vi' => 'vi_VN',
        'zh_TW' => 'zh_TW',
        'zh_CN' => 'zh_CN',
        'zh_HK' => 'zh_HK'
    );
}

function get_full_locale_mapping() {
  return array(
    'sq_AL' => array( 'wp_locale' => 'sq', 'lang' => 'Albanian', 'country' => 'Albania' ),
    'ar_DZ' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Algeria' ),
    'ar_BH' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Bahrain' ),
    'ar_EG' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Egypt' ),
    'ar_IQ' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Iraq' ),
    'ar_JO' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Jordan' ),
    'ar_KW' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Kuwait' ),
    'ar_LB' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Lebanon' ),
    'ar_LY' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Libya' ),
    'ar_MA' => array( 'wp_locale' => 'ary', 'lang' => 'Arabic', 'country' => 'Morocco' ),
    'ar_OM' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Oman' ),
    'ar_QA' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Qatar' ),
    'ar_SA' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Saudi Arabia' ),
    'ar_SD' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Sudan' ),
    'ar_SY' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Syria' ),
    'ar_TN' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Tunisia' ),
    'ar_AE' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'United Arab Emirates' ),
    'ar_YE' => array( 'wp_locale' => 'ar', 'lang' => 'Arabic', 'country' => 'Yemen' ),
    'be_BY' => array( 'wp_locale' => 'bel', 'lang' => 'Belarusian', 'country' => 'Belarus' ),
    'bg_BG' => array( 'wp_locale' => 'bg_BG', 'lang' => 'Bulgarian', 'country' => 'Bulgaria' ),
    'ca_ES' => array( 'wp_locale' => 'ca', 'lang' => 'Catalan', 'country' => 'Spain' ),
    'zh_CN' => array( 'wp_locale' => 'zh_CN', 'lang' => 'Chinese', 'country' => 'China' ),
    'zh_HK' => array( 'wp_locale' => 'zh_HK', 'lang' => 'Chinese', 'country' => 'Hong Kong SAR China' ),
    'zh_MO' => array( 'wp_locale' => 'zh_HK', 'lang' => 'Chinese', 'country' => 'Macau SAR China' ),
    'zh_TW' => array( 'wp_locale' => 'zh_TW', 'lang' => 'Chinese', 'country' => 'Taiwan' ),
    'hr_BA' => array( 'wp_locale' => 'hr', 'lang' => 'Croatian', 'country' => 'Bosnia & Herzegovina' ),
    'hr_HR' => array( 'wp_locale' => 'hr', 'lang' => 'Croatian', 'country' => 'Croatia' ),
    'cs_CZ' => array( 'wp_locale' => 'cs_CZ', 'lang' => 'Czech', 'country' => 'Czechia' ),
    'da_DK' => array( 'wp_locale' => 'da_DK', 'lang' => 'Danish', 'country' => 'Denmark' ),
    'nl_BE' => array( 'wp_locale' => 'nl_BE', 'lang' => 'Dutch', 'country' => 'Belgium' ),
    'nl_NL' => array( 'wp_locale' => 'nl_NL', 'lang' => 'Dutch', 'country' => 'Netherlands' ),
    'en_AU' => array( 'wp_locale' => 'en_AU', 'lang' => 'English', 'country' => 'Australia' ),
    'en_BE' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Belgium' ),
    'en_CA' => array( 'wp_locale' => 'en_CA', 'lang' => 'English', 'country' => 'Canada' ),
    'en_DK' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Denmark' ),
    'en_FI' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Finland' ),
    'en_HK' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Hong Kong SAR China' ),
    'en_IS' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Iceland' ),
    'en_IN' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'India' ),
    'en_ID' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Indonesia' ),
    'en_IE' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Ireland' ),
    'en_MY' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Malaysia' ),
    'en_MT' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Malta' ),
    'en_NL' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Netherlands' ),
    'en_NZ' => array( 'wp_locale' => 'en_NZ', 'lang' => 'English', 'country' => 'New Zealand' ),
    'en_NO' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Norway' ),
    'en_PH' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Philippines' ),
    'en_PR' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Puerto Rico' ),
    'en_SG' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Singapore' ),
    'en_ZA' => array( 'wp_locale' => 'en_ZA', 'lang' => 'English', 'country' => 'South Africa' ),
    'en_SE' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Sweden' ),
    'en_CH' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'Switzerland' ),
    'en_TH' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'Thailand' ),
    'en_GB' => array( 'wp_locale' => 'en_GB', 'lang' => 'English', 'country' => 'United Kingdom' ),
    'en_US' => array( 'wp_locale' => 'en_US', 'lang' => 'English', 'country' => 'United States' ),
    'et_EE' => array( 'wp_locale' => 'et', 'lang' => 'Estonian', 'country' => 'Estonia' ),
    'fi_FI' => array( 'wp_locale' => 'fi', 'lang' => 'Finnish', 'country' => 'Finland' ),
    'fr_BE' => array( 'wp_locale' => 'fr_BE', 'lang' => 'French', 'country' => 'Belgium' ),
    'fr_CA' => array( 'wp_locale' => 'fr_CA', 'lang' => 'French', 'country' => 'Canada' ),
    'fr_FR' => array( 'wp_locale' => 'fr_FR', 'lang' => 'French', 'country' => 'France' ),
    'fr_LU' => array( 'wp_locale' => 'fr_FR', 'lang' => 'French', 'country' => 'Luxembourg' ),
    'fr_PM' => array( 'wp_locale' => 'fr_FR', 'lang' => 'French', 'country' => 'St. Pierre & Miquelon' ),
    'fr_CH' => array( 'wp_locale' => 'fr_FR', 'lang' => 'French', 'country' => 'Switzerland' ),
    'de_AT' => array( 'wp_locale' => 'de_AT', 'lang' => 'German', 'country' => 'Austria' ),
    'de_DE' => array( 'wp_locale' => 'de_DE', 'lang' => 'German', 'country' => 'Germany' ),
    'de_LI' => array( 'wp_locale' => 'de_DE', 'lang' => 'German', 'country' => 'Liechtenstein' ),
    'de_LU' => array( 'wp_locale' => 'de_DE', 'lang' => 'German', 'country' => 'Luxembourg' ),
    'de_CH' => array( 'wp_locale' => 'de_CH', 'lang' => 'German', 'country' => 'Switzerland' ),
    'el_GR' => array( 'wp_locale' => 'el', 'lang' => 'Greek', 'country' => 'Greece' ),
    'iw_IL' => array( 'wp_locale' => 'he_IL', 'lang' => 'Hebrew', 'country' => 'Israel' ),
    'hi_IN' => array( 'wp_locale' => 'hi_IN', 'lang' => 'Hindi', 'country' => 'India' ),
    'hu_HU' => array( 'wp_locale' => 'hu_HU', 'lang' => 'Hungarian', 'country' => 'Hungary' ),
    'is_IS' => array( 'wp_locale' => 'is_IS', 'lang' => 'Icelandic', 'country' => 'Iceland' ),
    'in_ID' => array( 'wp_locale' => 'id_ID', 'lang' => 'Indonesian', 'country' => 'Indonesia' ),
    'it_IT' => array( 'wp_locale' => 'it_IT', 'lang' => 'Italian', 'country' => 'Italy' ),
    'it_CH' => array( 'wp_locale' => 'it_IT', 'lang' => 'Italian', 'country' => 'Switzerland' ),
    'ja_JP' => array( 'wp_locale' => 'ja', 'lang' => 'Japanese', 'country' => 'Japan' ),
    'kk_KZ' => array( 'wp_locale' => 'kk', 'lang' => 'Kazakh', 'country' => 'Kazakhstan' ),
    'ko_KR' => array( 'wp_locale' => 'ko_KR', 'lang' => 'Korean', 'country' => 'South Korea' ),
    'lv_LV' => array( 'wp_locale' => 'lv', 'lang' => 'Latvian', 'country' => 'Latvia' ),
    'lt_LT' => array( 'wp_locale' => 'lt_LT', 'lang' => 'Lithuanian', 'country' => 'Lithuania' ),
    'mk_MK' => array( 'wp_locale' => 'mk_MK', 'lang' => 'Macedonian', 'country' => 'Macedonia' ),
    'ms_MY' => array( 'wp_locale' => 'ms_MY', 'lang' => 'Malay', 'country' => 'Malaysia' ),
    'no_NO' => array( 'wp_locale' => 'nb_NO', 'lang' => 'Norwegian', 'country' => 'Norway' ),
    'no_NO_NY' => array( 'wp_locale' => 'nn_NO', 'lang' => 'Norwegian', 'country' => 'Norway, Nynorsk' ),
    'pl_PL' => array( 'wp_locale' => 'pl_PL', 'lang' => 'Polish', 'country' => 'Poland' ),
    'pt_BR' => array( 'wp_locale' => 'pt_BR', 'lang' => 'Portuguese', 'country' => 'Brazil' ),
    'pt_PT' => array( 'wp_locale' => 'pt_PT', 'lang' => 'Portuguese', 'country' => 'Portugal' ),
    'ro_RO' => array( 'wp_locale' => 'ro_RO', 'lang' => 'Romanian', 'country' => 'Romania' ),
    'ru_RU' => array( 'wp_locale' => 'ru_RU', 'lang' => 'Russian', 'country' => 'Russia' ),
    'sr_RS' => array( 'wp_locale' => 'sr_RS', 'lang' => 'Serbian', 'country' => 'Serbia' ),
    'sr_YU' => array( 'wp_locale' => 'sr_RS', 'lang' => 'Serbian', 'country' => 'YU' ),
    'sk_SK' => array( 'wp_locale' => 'sk_SK', 'lang' => 'Slovak', 'country' => 'Slovakia' ),
    'sl_SI' => array( 'wp_locale' => 'sl_SI', 'lang' => 'Slovenian', 'country' => 'Slovenia' ),
    'es_AR' => array( 'wp_locale' => 'es_AR', 'lang' => 'Spanish', 'country' => 'Argentina' ),
    'es_BO' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Bolivia' ),
    'es_CL' => array( 'wp_locale' => 'es_CL', 'lang' => 'Spanish', 'country' => 'Chile' ),
    'es_CO' => array( 'wp_locale' => 'es_CO', 'lang' => 'Spanish', 'country' => 'Colombia' ),
    'es_CR' => array( 'wp_locale' => 'es_CR', 'lang' => 'Spanish', 'country' => 'Costa Rica' ),
    'es_DO' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Dominican Republic' ),
    'es_EC' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Ecuador' ),
    'es_SV' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'El Salvador' ),
    'es_GT' => array( 'wp_locale' => 'es_GT', 'lang' => 'Spanish', 'country' => 'Guatemala' ),
    'es_HN' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Honduras' ),
    'es_MX' => array( 'wp_locale' => 'es_MX', 'lang' => 'Spanish', 'country' => 'Mexico' ),
    'es_NI' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Nicaragua' ),
    'es_PA' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Panama' ),
    'es_PY' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Paraguay' ),
    'es_PE' => array( 'wp_locale' => 'es_PE', 'lang' => 'Spanish', 'country' => 'Peru' ),
    'es_PR' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Puerto Rico' ),
    'es_ES' => array( 'wp_locale' => 'es_ES', 'lang' => 'Spanish', 'country' => 'Spain' ),
    'es_UY' => array( 'wp_locale' => 'es_UY', 'lang' => 'Spanish', 'country' => 'Uruguay' ),
    'es_VE' => array( 'wp_locale' => 'es_VE', 'lang' => 'Spanish', 'country' => 'Venezuela' ),
    'sv_SE' => array( 'wp_locale' => 'sv_SE', 'lang' => 'Swedish', 'country' => 'Sweden' ),
    'th_TH' => array( 'wp_locale' => 'th', 'lang' => 'Thai', 'country' => 'Thailand' ),
    'th_TH_TH_#u-nu-thai' => array( 'wp_locale' => 'th', 'lang' => 'Thai', 'country' => 'Thailand, TH, Thai Digits' ),
    'tr_TR' => array( 'wp_locale' => 'tr_TR', 'lang' => 'Turkish', 'country' => 'Turkey' ),
    'uk_UA' => array( 'wp_locale' => 'uk', 'lang' => 'Ukrainian', 'country' => 'Ukraine' ),
    'vi_VN' => array( 'wp_locale' => 'vi', 'lang' => 'Vietnamese', 'country' => 'Vietnam' )
  );
}

/**
 * Convert DR locale to WP locale by mapping.
 *
 * @since  2.0.0
 */
function get_wp_locale_by_map( $dr_locale ) {
  $mapping = get_full_locale_mapping();
  $wp_locale = isset( $mapping[$dr_locale] ) ? $mapping[$dr_locale]['wp_locale'] : 'en_US';
  return $wp_locale;
}

/**
 * Get DR country name by DR locale.
 *
 * @since  2.0.0
 */
function get_dr_country_name( $dr_locale ) {
  $mapping = get_full_locale_mapping();
  $country = isset( $mapping[$dr_locale] ) ? $mapping[$dr_locale]['country'] : $mapping['en_US']['country'] ;
  return $country;
}

/**
 * Get DR country code by extracting a substring from DR locale.
 *
 * @since  2.0.0
 */
function get_dr_country_code( $dr_locale ) {
  $arr = explode( '_', $dr_locale );
  return isset( $arr[1] ) ? strtolower( $arr[1] ) : '';
}

/**
 * Convert WP locale to DR locale by mapping. (Will be deprecated once new localization is done)
 *
 * @since  1.0.0
 */
function get_dr_locale_by_map( $wp_locale ) {
  $mapping = get_locale_mapping();
  return $mapping[ $wp_locale ];
}

/**
 * Returns a list of all usa sates
 */
function retrieve_usa_states() {
    return array('AL' => "Alabama",  'AK' => "Alaska",  'AZ' => "Arizona",  'AR' => "Arkansas",  'CA' => "California",  'CO' => "Colorado",  'CT' => "Connecticut",  'DE' => "Delaware",  'DC' => "District Of Columbia",  'FL' => "Florida",  'GA' => "Georgia",  'HI' => "Hawaii",  'ID' => "Idaho",  'IL' => "Illinois",  'IN' => "Indiana",  'IA' => "Iowa",  'KS' => "Kansas",  'KY' => "Kentucky",  'LA' => "Louisiana",  'ME' => "Maine",  'MD' => "Maryland",  'MA' => "Massachusetts",  'MI' => "Michigan",  'MN' => "Minnesota",  'MS' => "Mississippi",  'MO' => "Missouri",  'MT' => "Montana",'NE' => "Nebraska",'NV' => "Nevada",'NH' => "New Hampshire",'NJ' => "New Jersey",'NM' => "New Mexico",'NY' => "New York",'NC' => "North Carolina",'ND' => "North Dakota",'OH' => "Ohio",  'OK' => "Oklahoma",  'OR' => "Oregon",  'PA' => "Pennsylvania",  'RI' => "Rhode Island",  'SC' => "South Carolina",  'SD' => "South Dakota",'TN' => "Tennessee",  'TX' => "Texas",  'UT' => "Utah",  'VT' => "Vermont",  'VA' => "Virginia",  'WA' => "Washington",  'WV' => "West Virginia",  'WI' => "Wisconsin",  'WY' => "Wyoming");
}
