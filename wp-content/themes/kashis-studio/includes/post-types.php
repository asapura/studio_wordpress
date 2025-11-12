<?php
/**
 * Custom Post Types
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// カスタム投稿タイプ: スタジオルーム
function kashis_studio_register_post_types() {
    // スタジオルーム
    register_post_type('studio_room', array(
        'labels' => array(
            'name'               => 'スタジオルーム',
            'singular_name'      => 'スタジオルーム',
            'menu_name'          => 'スタジオルーム',
            'add_new'            => '新規追加',
            'add_new_item'       => '新しいスタジオルームを追加',
            'edit_item'          => 'スタジオルームを編集',
            'new_item'           => '新しいスタジオルーム',
            'view_item'          => 'スタジオルームを表示',
            'search_items'       => 'スタジオルームを検索',
            'not_found'          => 'スタジオルームが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にスタジオルームはありません',
        ),
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true, // ブロックエディター対応
        'menu_icon'           => 'dashicons-building',
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions'),
        'rewrite'             => array('slug' => 'studio'),
        'capability_type'     => 'post',
    ));
}
add_action('init', 'kashis_studio_register_post_types');
