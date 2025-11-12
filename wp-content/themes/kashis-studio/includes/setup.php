<?php
/**
 * Theme Setup and Initialization
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// 親テーマのスタイルシート並びにJavaScriptを読み込む
function kashis_studio_enqueue_styles() {
    // 親テーマのスタイル
    wp_enqueue_style(
        'twentytwentyfour-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );

    // 子テーマのスタイル
    wp_enqueue_style(
        'kashis-studio-style',
        get_stylesheet_uri(),
        array('twentytwentyfour-style'),
        wp_get_theme()->get('Version')
    );

    // カスタムJavaScript
    wp_enqueue_script(
        'kashis-studio-theme-js',
        get_stylesheet_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true // フッターで読み込む
    );
}
add_action('wp_enqueue_scripts', 'kashis_studio_enqueue_styles');

// テーマサポート
function kashis_studio_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // カスタムロゴのサポート
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // ナビゲーションメニューの登録
    register_nav_menus(array(
        'primary' => __('プライマリメニュー', 'kashis-studio'),
        'footer'  => __('フッターメニュー', 'kashis-studio'),
    ));

    // カスタム画像サイズ
    add_image_size('studio-thumbnail', 800, 600, true);
    add_image_size('studio-hero', 1920, 800, true);
}
add_action('after_setup_theme', 'kashis_studio_setup');

// ブロックエディター設定
function kashis_studio_editor_settings() {
    // ブロックエディターのサポートを追加
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');
    add_theme_support('custom-units');
    add_theme_support('link-color');
    add_theme_support('border');

    // エディターのカラーパレットを無効化（theme.jsonで管理）
    add_theme_support('editor-color-palette');
    add_theme_support('disable-custom-colors');

    // エディターのフォントサイズを無効化（theme.jsonで管理）
    add_theme_support('editor-font-sizes');
    add_theme_support('disable-custom-font-sizes');

    // エディター用スタイルの読み込み
    add_editor_style('style.css');
}
add_action('after_setup_theme', 'kashis_studio_editor_settings');
