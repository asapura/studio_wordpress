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
 * @since 1.0.6
 * @return void
 */
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

/**
 * Set up theme defaults and register support for various WordPress features
 *
 * Registers theme support for title-tag, post-thumbnails, HTML5 markup,
 * custom logo, navigation menus, and custom image sizes.
 *
 * @since 1.0.6
 * @return void
 */
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
        global $post;
        if (has_excerpt($post)) {
            $description = get_the_excerpt();
        } else {
            $description = wp_trim_words(strip_tags($post->post_content), 30, '...');
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
