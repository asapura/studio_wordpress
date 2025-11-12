<?php
/**
 * Custom Taxonomies
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// カスタムタクソノミー
function kashis_studio_register_taxonomies() {
    // 利用用途タクソノミー
    register_taxonomy('studio_usage', 'studio_room', array(
        'labels' => array(
            'name'              => '利用用途',
            'singular_name'     => '利用用途',
            'search_items'      => '利用用途を検索',
            'all_items'         => 'すべての利用用途',
            'edit_item'         => '利用用途を編集',
            'update_item'       => '利用用途を更新',
            'add_new_item'      => '新しい利用用途を追加',
            'new_item_name'     => '新しい利用用途名',
            'menu_name'         => '利用用途',
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, // ブロックエディター対応
        'rewrite'           => array('slug' => 'usage'),
    ));

    // 設備タクソノミー
    register_taxonomy('studio_equipment', 'studio_room', array(
        'labels' => array(
            'name'              => '設備',
            'singular_name'     => '設備',
            'search_items'      => '設備を検索',
            'all_items'         => 'すべての設備',
            'edit_item'         => '設備を編集',
            'update_item'       => '設備を更新',
            'add_new_item'      => '新しい設備を追加',
            'new_item_name'     => '新しい設備名',
            'menu_name'         => '設備',
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'equipment'),
    ));
}
add_action('init', 'kashis_studio_register_taxonomies');
