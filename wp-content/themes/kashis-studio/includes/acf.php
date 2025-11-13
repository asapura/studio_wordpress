<?php
/**
 * Advanced Custom Fields Configuration
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Set custom save point for Advanced Custom Fields JSON files
 *
 * Directs ACF to save field group JSON files to the theme's acf-json directory
 * for version control and portability.
 *
 * @since 1.0.6
 * @param string $path The default ACF JSON save path
 * @return string The custom save path for ACF JSON files
 */
function kashis_studio_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'kashis_studio_acf_json_save_point');

/**
 * Set custom load point for Advanced Custom Fields JSON files
 *
 * Directs ACF to load field group JSON files from the theme's acf-json directory
 * instead of the default location.
 *
 * @since 1.0.6
 * @param array $paths Array of paths where ACF looks for JSON files
 * @return array Modified array with custom path
 */
function kashis_studio_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'kashis_studio_acf_json_load_point');
