<?php

/**
 * Advanced Custom Fields — helpers & options page
 *
 * @package ntronica
 */

if (! defined('ABSPATH')) {
    exit;
}

// ──────────────────────────────────────────────────────
// Options page
// ──────────────────────────────────────────────────────
add_action(
    'acf/init',
    function () {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page(
            array(
                'page_title'  => 'Site Settings',
                'menu_title'  => 'Site Settings',
                'menu_slug'   => 'acf-options-site-settings',
                'capability'  => 'manage_options',
                'redirect'    => false,
                'icon_url'    => 'dashicons-admin-settings',
                'position'    => 3,
            )
        );
    }
);

// ──────────────────────────────────────────────────────
// Helper: get logo markup for a language
// ──────────────────────────────────────────────────────
function ntronica_acf_get_logo(string $language = 'en'): string
{
    $lang_key  = 'ru' === $language ? 'ru' : 'en';
    $svg       = get_field("logo_{$lang_key}_svg", 'option');
    $image_url = get_field("logo_{$lang_key}_image", 'option');
    $width     = get_field('logo_width', 'option') ?: 234;
    $height    = get_field('logo_height', 'option') ?: 34;

    if (! empty($svg)) {
        $svg = trim($svg);

        $inject_attrs = sprintf(
            ' width="%d" height="%d"',
            (int) $width,
            (int) $height
        );

        $svg = preg_replace(
            '/<svg\b([^>]*?)>/i',
            '<svg$1 aria-hidden="true" focusable="false"' . $inject_attrs . '>',
            $svg
        );

        return $svg;
    }

    if (! empty($image_url)) {
        return sprintf(
            '<img src="%s" alt="%s" width="%d" height="%d" aria-hidden="true" focusable="false">',
            esc_url($image_url),
            esc_attr(get_bloginfo('name')),
            (int) $width,
            (int) $height
        );
    }

    return '';
}

// ──────────────────────────────────────────────────────
// Helper: get nav tree from ACF
// ──────────────────────────────────────────────────────
function ntronica_acf_get_nav_tree(): array
{
    static $tree = null;

    if (null !== $tree) {
        return $tree;
    }

    $menu_items = get_field('ntronica_header_menu', 'option');

    if (empty($menu_items) || ! is_array($menu_items)) {
        $tree = array();
        return $tree;
    }

    $tree = array();

    foreach ($menu_items as $item) {
        $slug  = isset($item['slug']) ? sanitize_title((string) $item['slug']) : '';
        $label = isset($item['label']) ? (string) $item['label'] : '';
        $url   = isset($item['url']) ? (string) $item['url'] : '';

        if ('' === $slug || '' === $label || '' === $url) {
            continue;
        }

        $children = array();

        if (! empty($item['children']) && is_array($item['children'])) {
            foreach ($item['children'] as $child) {
                $child_href  = isset($child['href']) ? (string) $child['href'] : '';
                $child_label = isset($child['label']) ? (string) $child['label'] : '';

                if ('' === $child_label) {
                    continue;
                }

                $children[] = array(
                    'href'  => $child_href,
                    'label' => $child_label,
                );
            }
        }

        $tree[] = array(
            'slug'     => $slug,
            'label'    => $label,
            'url'      => $url,
            'children' => $children,
        );
    }

    return $tree;
}

