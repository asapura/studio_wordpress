<?php
/**
 * Custom Gutenberg Blocks Registration
 *
 * Registers custom blocks for enhanced content creation in the block editor.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register all custom blocks
 *
 * Registers custom Gutenberg blocks for the theme including room lists,
 * pricing tables, accordions, timelines, testimonials, and CTAs.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_blocks(): void {
    // Register block category
    add_filter('block_categories_all', 'kashis_studio_block_category', 10, 2);

    // Register individual blocks
    kashis_studio_register_room_list_block();
    kashis_studio_register_pricing_table_block();
    kashis_studio_register_accordion_block();
    kashis_studio_register_timeline_block();
    kashis_studio_register_testimonial_block();
    kashis_studio_register_cta_block();
}
add_action('init', 'kashis_studio_register_blocks');

/**
 * Add custom block category
 *
 * Creates a "カシスタジオ" category in the block inserter for
 * organizing custom blocks.
 *
 * @since 1.0.8
 * @param array $categories Existing block categories
 * @param WP_Block_Editor_Context $context Block editor context
 * @return array Modified block categories
 */
function kashis_studio_block_category(array $categories, $context): array {
    return array_merge(
        array(
            array(
                'slug'  => 'kashis-studio',
                'title' => __('カシスタジオ', 'kashis-studio'),
                'icon'  => 'building',
            ),
        ),
        $categories
    );
}

// Load individual block files
require_once get_stylesheet_directory() . '/blocks/room-list/block.php';
require_once get_stylesheet_directory() . '/blocks/pricing-table/block.php';
require_once get_stylesheet_directory() . '/blocks/accordion/block.php';
require_once get_stylesheet_directory() . '/blocks/timeline/block.php';
require_once get_stylesheet_directory() . '/blocks/testimonial/block.php';
require_once get_stylesheet_directory() . '/blocks/cta/block.php';
