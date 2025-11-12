<?php
/**
 * Kashis Studio Functions and Definitions
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Version
 */
define('KASHIS_STUDIO_VERSION', '1.0.7');

/**
 * Load Theme Modules
 *
 * テーマの機能をモジュール化し、保守性を向上させました。
 * 各機能は includes/ ディレクトリ内の専用ファイルで管理されています。
 */

// テーマセットアップとスタイル読み込み
require_once get_stylesheet_directory() . '/includes/setup.php';

// カスタム投稿タイプ
require_once get_stylesheet_directory() . '/includes/post-types.php';

// カスタムタクソノミー
require_once get_stylesheet_directory() . '/includes/taxonomies.php';

// ウィジェットエリア
require_once get_stylesheet_directory() . '/includes/widgets.php';

// Advanced Custom Fields設定
require_once get_stylesheet_directory() . '/includes/acf.php';

// ショートコード
require_once get_stylesheet_directory() . '/includes/shortcodes.php';

// ブロックパターン
require_once get_stylesheet_directory() . '/includes/block-patterns.php';

// 管理画面とヘルプページ
require_once get_stylesheet_directory() . '/includes/admin.php';

/**
 * Get theme information
 *
 * Returns an array containing theme metadata including name, version,
 * author, and parent theme information.
 *
 * @since 1.0.6
 * @return array Theme details including name, version, author, and parent theme
 */
function kashis_studio_get_theme_info() {
    return array(
        'name'    => 'Kashis Studio',
        'version' => KASHIS_STUDIO_VERSION,
        'author'  => 'Kashis Studio Team',
        'parent'  => 'Twenty Twenty-Four',
    );
}

/**
 * Simplify admin interface for non-technical users
 *
 * Hides unnecessary menu items (Comments, Tools) from the WordPress admin
 * panel for non-administrator users to reduce complexity.
 *
 * @since 1.0.6
 * @return void
 */
function kashis_studio_simplify_admin() {
    // 管理者以外の場合、一部のメニューを非表示
    if (!current_user_can('manage_options')) {
        remove_menu_page('edit-comments.php'); // コメント
        remove_menu_page('tools.php');         // ツール
    }
}
add_action('admin_menu', 'kashis_studio_simplify_admin', 999);

/**
 * Add help link to admin bar
 *
 * Adds a "📘 編集ガイド" (Edit Guide) link to the WordPress admin bar
 * for quick access to the theme's help documentation.
 *
 * @since 1.0.6
 * @param WP_Admin_Bar $wp_admin_bar WordPress admin bar object
 * @return void
 */
function kashis_studio_admin_bar_help($wp_admin_bar) {
    $wp_admin_bar->add_node(array(
        'id'    => 'kashis-studio-help',
        'title' => '📘 編集ガイド',
        'href'  => admin_url('admin.php?page=kashis-studio-help'),
    ));
}
add_action('admin_bar_menu', 'kashis_studio_admin_bar_help', 100);
