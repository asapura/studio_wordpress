<?php
/**
 * Block Patterns Registration
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Register custom block pattern category
 *
 * Creates a 'カシスタジオ' (Kashis Studio) category for organizing
 * theme-specific block patterns in the block editor.
 *
 * @since 1.0.6
 * @return void
 */
function kashis_studio_register_block_patterns() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => 'カシスタジオ')
        );
    }
}
add_action('init', 'kashis_studio_register_block_patterns');

/**
 * Register block pattern category (backwards compatibility)
 *
 * Legacy function maintained for backwards compatibility.
 * Registers the same pattern category with translation support.
 *
 * @since 1.0.6
 * @return void
 */
function kashis_studio_register_block_pattern_category() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => __('カシスタジオ', 'kashis-studio'))
        );
    }
}
add_action('init', 'kashis_studio_register_block_pattern_category');
