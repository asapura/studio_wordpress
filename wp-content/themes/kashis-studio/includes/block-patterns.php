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
 * theme-specific block patterns in the block editor with translation support.
 *
 * @since 1.0.6
 * @return void
 */
function kashis_studio_register_block_patterns() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => __('カシスタジオ', 'kashis-studio'))
        );
    }
}
add_action('init', 'kashis_studio_register_block_patterns');

/**
 * Register custom block styles
 *
 * Adds Atlassian Design System-compliant style variations for core blocks
 * to enhance design flexibility in the block editor.
 *
 * Button variations: Secondary, Subtle, Success, Warning, Danger
 * Group variations: Elevated (with shadow), Bordered, Flat
 * Image variations: Circle (fully rounded), Shadow
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_block_styles(): void {
    // Button Block Styles - Atlassian Design System variants
    register_block_style('core/button', array(
        'name'  => 'secondary',
        'label' => __('セカンダリー', 'kashis-studio'),
    ));

    register_block_style('core/button', array(
        'name'  => 'subtle',
        'label' => __('控えめ', 'kashis-studio'),
    ));

    register_block_style('core/button', array(
        'name'  => 'success',
        'label' => __('成功（グリーン）', 'kashis-studio'),
    ));

    register_block_style('core/button', array(
        'name'  => 'warning',
        'label' => __('警告（イエロー）', 'kashis-studio'),
    ));

    register_block_style('core/button', array(
        'name'  => 'danger',
        'label' => __('危険（レッド）', 'kashis-studio'),
    ));

    // Group Block Styles - Card variations
    register_block_style('core/group', array(
        'name'  => 'elevated',
        'label' => __('浮き上がり（シャドウ付き）', 'kashis-studio'),
    ));

    register_block_style('core/group', array(
        'name'  => 'bordered',
        'label' => __('ボーダー', 'kashis-studio'),
    ));

    register_block_style('core/group', array(
        'name'  => 'flat',
        'label' => __('フラット', 'kashis-studio'),
    ));

    // Image Block Styles
    register_block_style('core/image', array(
        'name'  => 'circle',
        'label' => __('円形', 'kashis-studio'),
    ));

    register_block_style('core/image', array(
        'name'  => 'shadow',
        'label' => __('シャドウ付き', 'kashis-studio'),
    ));
}
add_action('init', 'kashis_studio_register_block_styles');
