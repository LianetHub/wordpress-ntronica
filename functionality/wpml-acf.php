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
                    array(
                        'name' => 'sticky_nav_about',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'name' => 'sticky_nav_technology',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'name' => 'sticky_nav_products',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'name' => 'sticky_nav_news',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'name' => 'sticky_nav_careers',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array(
                        'name' => 'sticky_nav_front_page',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array('name' => 'ntronica_info_address', 'type' => 'textarea'),
                    array('name' => 'ntronica_info_cin', 'type' => 'text'),
                    array('name' => 'ntronica_info_title', 'type' => 'text'),
                    array('name' => 'ntronica_info_text', 'type' => 'textarea'),
                    array('name' => 'ntronica_info_email_1', 'type' => 'text'),
                    array('name' => 'ntronica_info_email_2', 'type' => 'text'),
                    array('name' => 'ntronica_info_phone', 'type' => 'text'),
                    array('name' => 'ntronica_contact_title', 'type' => 'text'),
                    array('name' => 'ntronica_contact_form_id', 'type' => 'text'),
                    array('name' => 'ntronica_slider_title', 'type' => 'text'),
                    array(
                        'name' => 'ntronica_slider_items',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'title', 'type' => 'text'),
                        ),
                    ),
                ),
            ),
        );

        // About page translatable texts.
        $config['wpml-config'][] = array(
            'admin-texts' => array(
                'key' => 'ntronica_about_page',
                'children' => array(
                    array('name' => 'about_hero_title', 'type' => 'text'),
                    array('name' => 'about_hero_tagline', 'type' => 'textarea'),
                    array('name' => 'about_overview_title', 'type' => 'text'),
                    array('name' => 'about_overview_intro', 'type' => 'textarea'),
                    array('name' => 'about_overview_subtitle', 'type' => 'text'),
                    array(
                        'name' => 'about_overview_features',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'text', 'type' => 'textarea'),
                        ),
                    ),
                    array('name' => 'about_goal_title', 'type' => 'text'),
                    array('name' => 'about_goal_text', 'type' => 'textarea'),
                    array('name' => 'about_stats_title', 'type' => 'text'),
                    array('name' => 'about_stats_text_left', 'type' => 'textarea'),
                    array('name' => 'about_stats_text_right', 'type' => 'textarea'),
                    array(
                        'name' => 'about_stats_items',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'value', 'type' => 'text'),
                            array('name' => 'label', 'type' => 'text'),
                        ),
                    ),
                    array('name' => 'about_solutions_lead', 'type' => 'textarea'),
                    array(
                        'name' => 'about_solutions_items',
                        'type' => 'repeater',
                        'children' => array(
                            array('name' => 'title', 'type' => 'text'),
                            array('name' => 'alt', 'type' => 'text'),
                        ),
                    ),
                ),
            ),
        );

        // Contacts page translatable texts.
        $config['wpml-config'][] = array(
            'admin-texts' => array(
                'key' => 'ntronica_contacts_page',
                'children' => array(
                    array('name' => 'contacts_hero_title', 'type' => 'text'),
                    array('name' => 'contacts_hero_tagline', 'type' => 'textarea'),
                    array('name' => 'contacts_rep_title', 'type' => 'text'),
                    array('name' => 'contacts_rep_address', 'type' => 'text'),
                ),
            ),
        );

        return $config;
    },
    10,
    1
);

/**
 * Declare vacancy and product post types as translatable in WPML.
 */
add_filter(
    'wpml_post_types',
    function ($post_types) {
        $post_types['vacancy']->translation = 1;
        $post_types['product']->translation = 1;
        return $post_types;
    }
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
