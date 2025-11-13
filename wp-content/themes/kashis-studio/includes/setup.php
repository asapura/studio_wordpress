<?php
/**
 * Theme Setup and Initialization
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Enqueue parent and child theme styles and scripts
 *
 * Loads the parent theme (Twenty Twenty-Four) stylesheet, child theme stylesheet,
 * and custom JavaScript file with proper versioning and dependencies.
 *
 * Script Loading Strategy:
 * - Development mode (SCRIPT_DEBUG or WP_DEBUG): Loads unminified theme.js for debugging
 * - Production mode: Loads minified theme.min.js for optimal performance
 *
 * @since 1.0.6
 * @since 1.0.8 Added automatic minified/unminified script selection
 * @return void
 */
function kashis_studio_enqueue_styles(): void {
    $theme = wp_get_theme();
    $parent_theme = $theme->parent();

    // 親テーマのバージョン取得（存在しない場合はフォールバック）
    $parent_version = $parent_theme ? $parent_theme->get('Version') : '1.0.0';
    $child_version = $theme->get('Version');

    // 親テーマのスタイル読み込み
    wp_enqueue_style(
        'twentytwentyfour-style',
        get_template_directory_uri() . '/style.css',
        array(),
        $parent_version
    );

    // 子テーマのスタイル読み込み（親テーマスタイルに依存）
    wp_enqueue_style(
        'kashis-studio-style',
        get_stylesheet_uri(),
        array('twentytwentyfour-style'),
        $child_version
    );

    // カスタムJavaScript読み込み
    // 開発環境では通常版（可読性重視）、本番環境では最小化版（パフォーマンス重視）を自動選択
    $script_file = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) || (defined('WP_DEBUG') && WP_DEBUG)
        ? 'theme.js'        // 開発用：19KB（デバッグしやすい）
        : 'theme.min.js';   // 本番用：7.4KB（61%削減）

    wp_enqueue_script(
        'kashis-studio-theme-js',
        get_stylesheet_directory_uri() . '/assets/js/' . $script_file,
        array(),
        $child_version,
        true // フッターで読み込み（ページレンダリングブロック防止）
    );

    // 高度な機能JavaScript（お気に入り・比較機能）
    wp_enqueue_script(
        'kashis-studio-advanced-js',
        get_stylesheet_directory_uri() . '/assets/js/advanced-features.js',
        array(),
        $child_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'kashis_studio_enqueue_styles');

/**
 * Set up theme defaults and register support for various WordPress features
 *
 * Registers theme support for title-tag, post-thumbnails, HTML5 markup,
 * custom logo, navigation menus, and custom image sizes.
 *
 * Features Enabled:
 * - Title Tag: Automatic <title> tag generation for SEO
 * - Post Thumbnails: Featured image support for posts and pages
 * - HTML5: Modern semantic markup for forms, galleries, etc.
 * - Custom Logo: Customizer support for site logo
 * - Navigation Menus: Primary and footer menu locations
 * - Custom Image Sizes: Optimized sizes for studio thumbnails
 *
 * @since 1.0.6
 * @since 1.0.8 Enhanced documentation
 * @return void
 */
function kashis_studio_setup(): void {
    // タイトルタグのサポート（SEO最適化のため自動生成）
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート（投稿・固定ページで使用可能）
    add_theme_support('post-thumbnails');

    // HTML5サポート（モダンなセマンティックマークアップ）
    add_theme_support('html5', array(
        'search-form',   // 検索フォーム
        'comment-form',  // コメントフォーム
        'comment-list',  // コメントリスト
        'gallery',       // ギャラリー
        'caption',       // キャプション
        'style',         // スタイルタグ
        'script'         // スクリプトタグ
    ));

    // カスタムロゴのサポート（カスタマイザーで設定可能）
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,  // 高さ可変
        'flex-width'  => true,  // 幅可変
    ));

    // ナビゲーションメニューの登録（プライマリとフッター）
    register_nav_menus(array(
        'primary' => __('プライマリメニュー', 'kashis-studio'),  // ヘッダーメニュー
        'footer'  => __('フッターメニュー', 'kashis-studio'),    // フッターメニュー
    ));

    // カスタム画像サイズ（スタジオサムネイル用に最適化）
    // 800x600px、トリミング有効
    add_image_size('studio-thumbnail', 800, 600, true);
    add_image_size('studio-hero', 1920, 800, true);
}
add_action('after_setup_theme', 'kashis_studio_setup');

/**
 * Configure block editor settings and features
 *
 * Adds theme support for block editor features including editor styles,
 * wide alignment, custom spacing, line height, units, and border controls.
 * Also disables custom colors and font sizes in favor of theme.json configuration.
 *
 * @since 1.0.6
 * @return void
 */
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

/**
 * Output SEO meta tags including Open Graph and Twitter Card metadata
 *
 * Generates meta description from excerpt or content for singular posts/pages,
 * or uses site description for other pages. Adds Open Graph tags for social
 * media sharing and Twitter Card metadata for enhanced Twitter display.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_seo_meta_tags() {
    // メタディスクリプション
    if (is_singular()) {
        // 個別投稿・ページ
        if (has_excerpt()) {
            $description = get_the_excerpt();
        } else {
            // get_the_content()でフィルター適用済みコンテンツを取得
            $content = apply_filters('the_content', get_post_field('post_content'));
            $description = wp_trim_words(wp_strip_all_tags($content), 30, '...');
        }
    } elseif (is_home() || is_front_page()) {
        // ホームページ
        $description = get_bloginfo('description');
        if (empty($description)) {
            $description = 'カシスタジオは東京都心にある完全個室のレンタルスタジオです。ダンス、ヨガ、音楽練習など多目的にご利用いただけます。';
        }
    } else {
        $description = get_bloginfo('description');
    }

    if (!empty($description)) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }

    // Open Graph (OG) タグ
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";

    if (is_singular()) {
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";

        if (has_post_thumbnail()) {
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            echo '<meta property="og:image" content="' . esc_url($thumbnail_url) . '">' . "\n";
        }
    } else {
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
    }

    if (!empty($description)) {
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    }

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr(is_singular() ? get_the_title() : get_bloginfo('name')) . '">' . "\n";

    if (!empty($description)) {
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    }

    if (is_singular() && has_post_thumbnail()) {
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        echo '<meta name="twitter:image" content="' . esc_url($thumbnail_url) . '">' . "\n";
    }
}
add_action('wp_head', 'kashis_studio_seo_meta_tags');
