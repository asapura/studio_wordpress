<?php
/**
 * WordPress Customizer Integration
 *
 * Adds theme customization options for colors, branding, and layout settings.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register customizer settings
 *
 * Adds panels, sections, and controls for theme customization including
 * branding, colors, typography, and layout options.
 *
 * @since 1.0.8
 * @param WP_Customize_Manager $wp_customize Customizer object
 * @return void
 */
function kashis_studio_customize_register(WP_Customize_Manager $wp_customize): void {
    // Add Kashis Studio Panel
    $wp_customize->add_panel('kashis_studio_panel', array(
        'title' => __('カシスタジオ設定', 'kashis-studio'),
        'description' => __('テーマのカスタマイズオプション', 'kashis-studio'),
        'priority' => 10,
    ));

    // === Branding Section ===
    $wp_customize->add_section('kashis_studio_branding', array(
        'title' => __('ブランディング', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 10,
    ));

    // Site Logo
    $wp_customize->add_setting('kashis_studio_logo', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'kashis_studio_logo', array(
        'label' => __('サイトロゴ', 'kashis-studio'),
        'section' => 'kashis_studio_branding',
        'mime_type' => 'image',
    )));

    // Tagline
    $wp_customize->add_setting('kashis_studio_tagline', array(
        'default' => 'プロフェッショナルなレンタルスタジオ',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('kashis_studio_tagline', array(
        'label' => __('キャッチフレーズ', 'kashis-studio'),
        'section' => 'kashis_studio_branding',
        'type' => 'text',
    ));

    // === Colors Section ===
    $wp_customize->add_section('kashis_studio_colors', array(
        'title' => __('カラー設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 20,
    ));

    // Primary Color
    $wp_customize->add_setting('kashis_studio_primary_color', array(
        'default' => '#0052CC',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_primary_color', array(
        'label' => __('プライマリカラー', 'kashis-studio'),
        'section' => 'kashis_studio_colors',
    )));

    // Secondary Color
    $wp_customize->add_setting('kashis_studio_secondary_color', array(
        'default' => '#00875A',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_secondary_color', array(
        'label' => __('セカンダリカラー', 'kashis-studio'),
        'section' => 'kashis_studio_colors',
    )));

    // === Layout Section ===
    $wp_customize->add_section('kashis_studio_layout', array(
        'title' => __('レイアウト設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 30,
    ));

    // Container Width
    $wp_customize->add_setting('kashis_studio_container_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('kashis_studio_container_width', array(
        'label' => __('コンテナ幅 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_layout',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 960,
            'max' => 1600,
            'step' => 40,
        ),
    ));

    // Sticky Header
    $wp_customize->add_setting('kashis_studio_sticky_header', array(
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));

    $wp_customize->add_control('kashis_studio_sticky_header', array(
        'label' => __('固定ヘッダー', 'kashis-studio'),
        'description' => __('スクロール時にヘッダーを固定表示', 'kashis-studio'),
        'section' => 'kashis_studio_layout',
        'type' => 'checkbox',
    ));

    // === Typography Section ===
    $wp_customize->add_section('kashis_studio_typography', array(
        'title' => __('タイポグラフィ', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 40,
    ));

    // Font Family
    $wp_customize->add_setting('kashis_studio_font_family', array(
        'default' => 'system',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('kashis_studio_font_family', array(
        'label' => __('フォント', 'kashis-studio'),
        'section' => 'kashis_studio_typography',
        'type' => 'select',
        'choices' => array(
            'system' => 'システムフォント',
            'noto-sans' => 'Noto Sans JP',
            'hiragino' => 'ヒラギノ角ゴ',
        ),
    ));

    // Base Font Size
    $wp_customize->add_setting('kashis_studio_font_size', array(
        'default' => '14',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('kashis_studio_font_size', array(
        'label' => __('基本フォントサイズ (px)', 'kashis-studio'),
        'section' => 'kashis_studio_typography',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 12,
            'max' => 18,
            'step' => 1,
        ),
    ));

    // === Social Links Section ===
    $wp_customize->add_section('kashis_studio_social', array(
        'title' => __('ソーシャルメディア', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 50,
    ));

    // Social Links
    $social_platforms = array(
        'facebook' => 'Facebook',
        'twitter' => 'Twitter / X',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'line' => 'LINE',
    );

    foreach ($social_platforms as $platform => $label) {
        $wp_customize->add_setting("kashis_studio_social_{$platform}", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("kashis_studio_social_{$platform}", array(
            'label' => $label . ' URL',
            'section' => 'kashis_studio_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'kashis_studio_customize_register');

/**
 * Add customizer presets section
 *
 * Adds quick preset buttons for instant theme styling.
 *
 * @since 1.0.8
 * @param WP_Customize_Manager $wp_customize Customizer object
 * @return void
 */
function kashis_studio_customizer_presets(WP_Customize_Manager $wp_customize): void {
    // Add Presets Section
    $wp_customize->add_section('kashis_studio_presets', array(
        'title' => __('クイックプリセット', 'kashis-studio'),
        'description' => __('ワンクリックでテーマスタイルを変更', 'kashis-studio'),
        'priority' => 5,
    ));

    // Add preset control (using custom HTML)
    $wp_customize->add_setting('kashis_studio_preset_selector', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('kashis_studio_preset_selector', array(
        'label' => __('プリセットを選択', 'kashis-studio'),
        'section' => 'kashis_studio_presets',
        'type' => 'select',
        'choices' => array(
            '' => '選択してください',
            'default' => 'デフォルト（ブルー）',
            'warm' => 'ウォーム（オレンジ）',
            'cool' => 'クール（シアン）',
            'professional' => 'プロフェッショナル（ダーク）',
            'elegant' => 'エレガント（パープル）',
        ),
    ));
}
add_action('customize_register', 'kashis_studio_customizer_presets');

/**
 * Apply preset colors
 *
 * Applies preset color schemes when selected in customizer.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_apply_preset(): void {
    if (!isset($_GET['kashis_preset']) || !current_user_can('customize')) {
        return;
    }

    $preset = sanitize_text_field($_GET['kashis_preset']);

    $presets = array(
        'default' => array(
            'primary' => '#0052CC',
            'secondary' => '#00875A',
        ),
        'warm' => array(
            'primary' => '#FF5630',
            'secondary' => '#FFAB00',
        ),
        'cool' => array(
            'primary' => '#00B8D9',
            'secondary' => '#2684FF',
        ),
        'professional' => array(
            'primary' => '#172B4D',
            'secondary' => '#42526E',
        ),
        'elegant' => array(
            'primary' => '#6554C0',
            'secondary' => '#8777D9',
        ),
    );

    if (isset($presets[$preset])) {
        set_theme_mod('kashis_studio_primary_color', $presets[$preset]['primary']);
        set_theme_mod('kashis_studio_secondary_color', $presets[$preset]['secondary']);
    }

    wp_safe_redirect(admin_url('customize.php'));
    exit;
}
add_action('admin_init', 'kashis_studio_apply_preset');

/**
 * Output custom CSS based on customizer settings
 *
 * Generates dynamic CSS from customizer values and outputs it in the head.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_customizer_css(): void {
    $primary_color = get_theme_mod('kashis_studio_primary_color', '#0052CC');
    $secondary_color = get_theme_mod('kashis_studio_secondary_color', '#00875A');
    $container_width = get_theme_mod('kashis_studio_container_width', '1200');
    $font_size = get_theme_mod('kashis_studio_font_size', '14');
    $sticky_header = get_theme_mod('kashis_studio_sticky_header', true);

    ?>
    <style id="kashis-studio-customizer-css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --container-width: <?php echo esc_attr($container_width); ?>px;
            --base-font-size: <?php echo esc_attr($font_size); ?>px;
        }

        /* Primary color applications */
        .wp-block-button__link,
        .wp-element-button,
        a:hover,
        .kashis-room-title a:hover,
        .site-header a:hover {
            color: var(--primary-color) !important;
        }

        .wp-block-button__link,
        .wp-element-button {
            background-color: var(--primary-color) !important;
        }

        /* Container width */
        .wp-block-group.alignwide {
            max-width: var(--container-width);
        }

        /* Base font size */
        body {
            font-size: var(--base-font-size);
        }

        <?php if ($sticky_header): ?>
        /* Sticky header */
        .site-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 8px rgba(9, 30, 66, 0.1);
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'kashis_studio_customizer_css');
