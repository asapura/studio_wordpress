<?php
/**
 * Block Patterns Registration
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// ブロックパターンのカテゴリーを追加
function kashis_studio_register_block_patterns() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => 'カシスタジオ')
        );
    }
}
add_action('init', 'kashis_studio_register_block_patterns');

// ブロックパターンカテゴリーの登録（後方互換性）
function kashis_studio_register_block_pattern_category() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => __('カシスタジオ', 'kashis-studio'))
        );
    }
}
add_action('init', 'kashis_studio_register_block_pattern_category');
