<?php
/**
 * Advanced Custom Fields Configuration
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// ACFフィールドの設定（JSONファイルから自動読み込み）
function kashis_studio_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'kashis_studio_acf_json_save_point');

function kashis_studio_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'kashis_studio_acf_json_load_point');
