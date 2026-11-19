<?php

/**
 * WPML + ACF integration
 *
 * ACF Multilingual (ACFML) handles field translation via WPML UI.
 * This file provides only the wpml-config.xml equivalent for option-page strings
 * and minimal glue so ACF fields are exposed to WPML.
 *
 * @package ntronica
 */

/**
 * Expose ACF option-page fields to WPML String Translation.
 *
 * This is the PHP equivalent of wpml-config.xml <admin-texts>.
 * ACFML uses this to know which option values to register for translation.
 */
add_filter(
    'wpml_config_array',
    function ($config) {
        if (! isset($config['wpml-config'])) {
            $config['wpml-config'] = array();
        }

        $config['wpml-config'][] = array(
            'admin-texts' => array(
                'key' => 'ntronica_site_settings',
                'children' => array(
                    array('name' => 'logo_en_svg', 'type' => 'textarea'),
                    array('name' => 'logo_ru_svg', 'type' => 'textarea'),
                    array(
                        'name' => 'ntronica_header_menu',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                            array(
                                'name' => 'children',
                                'type' => 'repeater',
                                'children' => array(
                                    array('name' => 'label', 'type' => 'text'),
                                ),
                            ),
                        ),
                    ),
                    array('name' => 'ntronica_footer_email_1', 'type' => 'email'),
                    array('name' => 'ntronica_footer_email_2', 'type' => 'email'),
                    array('name' => 'ntronica_footer_phone', 'type' => 'text'),
                    array('name' => 'ntronica_footer_website', 'type' => 'url'),
                    array('name' => 'ntronica_footer_address', 'type' => 'textarea'),
                ),
            ),
        );

        return $config;
    },
    10,
    1
);

/**
 * Retrieve ACF option field with WPML String Translation fallback.
 *
 * @param string $field_name ACF field name.
 * @return string|null
 */
function ntronica_wpml_option(string $field_name)
{
    $ntronica_value = get_field($field_name, 'option');

    if (function_exists('icl_t') && is_string($ntronica_value) && '' !== $ntronica_value) {
        return icl_t('Site Settings', $field_name, $ntronica_value);
    }

    return $ntronica_value;
}
