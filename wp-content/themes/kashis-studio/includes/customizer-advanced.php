<?php
/**
 * Advanced Customizer Options
 *
 * Extreme customization options for design control
 *
 * @package Kashis_Studio
 * @since 1.0.9
 */

/**
 * Register advanced customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Customizer object
 * @return void
 */
function kashis_studio_advanced_customizer(WP_Customize_Manager $wp_customize): void {

    // ===================================================================
    // ADVANCED COLORS SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_advanced_colors', array(
        'title' => __('高度なカラー設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 21,
    ));

    // Accent Color
    $wp_customize->add_setting('kashis_studio_accent_color', array(
        'default' => '#FFAB00',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_accent_color', array(
        'label' => __('アクセントカラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // Text Color
    $wp_customize->add_setting('kashis_studio_text_color', array(
        'default' => '#172B4D',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_text_color', array(
        'label' => __('テキストカラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // Link Color
    $wp_customize->add_setting('kashis_studio_link_color', array(
        'default' => '#0052CC',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_link_color', array(
        'label' => __('リンクカラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // Link Hover Color
    $wp_customize->add_setting('kashis_studio_link_hover_color', array(
        'default' => '#0747A6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_link_hover_color', array(
        'label' => __('リンクホバーカラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // Background Color
    $wp_customize->add_setting('kashis_studio_bg_color', array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_bg_color', array(
        'label' => __('背景カラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // Border Color
    $wp_customize->add_setting('kashis_studio_border_color', array(
        'default' => '#DFE1E6',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_border_color', array(
        'label' => __('ボーダーカラー', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_colors',
    )));

    // ===================================================================
    // ADVANCED TYPOGRAPHY SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_advanced_typography', array(
        'title' => __('高度なタイポグラフィ', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 41,
    ));

    // Heading Font Family
    $wp_customize->add_setting('kashis_studio_heading_font_family', array(
        'default' => 'inherit',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_heading_font_family', array(
        'label' => __('見出しフォント', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'select',
        'choices' => array(
            'inherit' => '本文と同じ',
            'noto-sans-jp' => 'Noto Sans JP',
            'noto-serif-jp' => 'Noto Serif JP',
            'hiragino' => 'ヒラギノ角ゴ',
            'meiryo' => 'メイリオ',
            'yu-gothic' => '游ゴシック',
            'arial' => 'Arial',
            'helvetica' => 'Helvetica',
        ),
    ));

    // H1 Font Size
    $wp_customize->add_setting('kashis_studio_h1_size', array(
        'default' => '2.5',
        'sanitize_callback' => 'kashis_studio_sanitize_float',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_h1_size', array(
        'label' => __('H1サイズ (rem)', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'number',
        'input_attrs' => array('min' => 1.5, 'max' => 4, 'step' => 0.1),
    ));

    // H2 Font Size
    $wp_customize->add_setting('kashis_studio_h2_size', array(
        'default' => '2',
        'sanitize_callback' => 'kashis_studio_sanitize_float',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_h2_size', array(
        'label' => __('H2サイズ (rem)', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'number',
        'input_attrs' => array('min' => 1.2, 'max' => 3, 'step' => 0.1),
    ));

    // Line Height
    $wp_customize->add_setting('kashis_studio_line_height', array(
        'default' => '1.7',
        'sanitize_callback' => 'kashis_studio_sanitize_float',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_line_height', array(
        'label' => __('行間', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'number',
        'input_attrs' => array('min' => 1, 'max' => 3, 'step' => 0.1),
    ));

    // Letter Spacing
    $wp_customize->add_setting('kashis_studio_letter_spacing', array(
        'default' => '0',
        'sanitize_callback' => 'kashis_studio_sanitize_float',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_letter_spacing', array(
        'label' => __('文字間隔 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'number',
        'input_attrs' => array('min' => -2, 'max' => 5, 'step' => 0.1),
    ));

    // Font Weight
    $wp_customize->add_setting('kashis_studio_font_weight', array(
        'default' => '400',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_font_weight', array(
        'label' => __('フォントウェイト', 'kashis-studio'),
        'section' => 'kashis_studio_advanced_typography',
        'type' => 'select',
        'choices' => array(
            '300' => 'Light (300)',
            '400' => 'Regular (400)',
            '500' => 'Medium (500)',
            '600' => 'Semi Bold (600)',
            '700' => 'Bold (700)',
        ),
    ));

    // ===================================================================
    // SPACING SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_spacing', array(
        'title' => __('スペーシング設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 35,
    ));

    // Content Padding
    $wp_customize->add_setting('kashis_studio_content_padding', array(
        'default' => '40',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_content_padding', array(
        'label' => __('コンテンツ内側余白 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_spacing',
        'type' => 'range',
        'input_attrs' => array('min' => 0, 'max' => 100, 'step' => 5),
    ));

    // Section Spacing
    $wp_customize->add_setting('kashis_studio_section_spacing', array(
        'default' => '80',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_section_spacing', array(
        'label' => __('セクション間余白 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_spacing',
        'type' => 'range',
        'input_attrs' => array('min' => 20, 'max' => 200, 'step' => 10),
    ));

    // Element Margin
    $wp_customize->add_setting('kashis_studio_element_margin', array(
        'default' => '24',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_element_margin', array(
        'label' => __('要素間余白 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_spacing',
        'type' => 'range',
        'input_attrs' => array('min' => 8, 'max' => 60, 'step' => 4),
    ));

    // ===================================================================
    // BUTTON STYLES SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_button_styles', array(
        'title' => __('ボタンスタイル', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 36,
    ));

    // Button Border Radius
    $wp_customize->add_setting('kashis_studio_button_radius', array(
        'default' => '4',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_button_radius', array(
        'label' => __('ボタン角丸 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_button_styles',
        'type' => 'range',
        'input_attrs' => array('min' => 0, 'max' => 50, 'step' => 1),
    ));

    // Button Padding
    $wp_customize->add_setting('kashis_studio_button_padding', array(
        'default' => '12',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_button_padding', array(
        'label' => __('ボタン内側余白 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_button_styles',
        'type' => 'range',
        'input_attrs' => array('min' => 8, 'max' => 30, 'step' => 2),
    ));

    // Button Hover Effect
    $wp_customize->add_setting('kashis_studio_button_hover_effect', array(
        'default' => 'darken',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_button_hover_effect', array(
        'label' => __('ボタンホバーエフェクト', 'kashis-studio'),
        'section' => 'kashis_studio_button_styles',
        'type' => 'select',
        'choices' => array(
            'darken' => '暗く',
            'lighten' => '明るく',
            'lift' => '浮き上がり',
            'scale' => '拡大',
        ),
    ));

    // ===================================================================
    // HEADER SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_header', array(
        'title' => __('ヘッダー設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 15,
    ));

    // Header Height
    $wp_customize->add_setting('kashis_studio_header_height', array(
        'default' => '80',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_header_height', array(
        'label' => __('ヘッダー高さ (px)', 'kashis-studio'),
        'section' => 'kashis_studio_header',
        'type' => 'range',
        'input_attrs' => array('min' => 60, 'max' => 120, 'step' => 5),
    ));

    // Header Background Color
    $wp_customize->add_setting('kashis_studio_header_bg', array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_header_bg', array(
        'label' => __('ヘッダー背景色', 'kashis-studio'),
        'section' => 'kashis_studio_header',
    )));

    // Header Transparency
    $wp_customize->add_setting('kashis_studio_header_transparent', array(
        'default' => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_header_transparent', array(
        'label' => __('透過ヘッダー', 'kashis-studio'),
        'description' => __('トップページで背景を透過', 'kashis-studio'),
        'section' => 'kashis_studio_header',
        'type' => 'checkbox',
    ));

    // Header Shadow
    $wp_customize->add_setting('kashis_studio_header_shadow', array(
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_header_shadow', array(
        'label' => __('ヘッダーシャドウ', 'kashis-studio'),
        'section' => 'kashis_studio_header',
        'type' => 'checkbox',
    ));

    // ===================================================================
    // FOOTER SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_footer', array(
        'title' => __('フッター設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 60,
    ));

    // Footer Background Color
    $wp_customize->add_setting('kashis_studio_footer_bg', array(
        'default' => '#172B4D',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_footer_bg', array(
        'label' => __('フッター背景色', 'kashis-studio'),
        'section' => 'kashis_studio_footer',
    )));

    // Footer Text Color
    $wp_customize->add_setting('kashis_studio_footer_text', array(
        'default' => '#FFFFFF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kashis_studio_footer_text', array(
        'label' => __('フッターテキスト色', 'kashis-studio'),
        'section' => 'kashis_studio_footer',
    )));

    // Footer Padding
    $wp_customize->add_setting('kashis_studio_footer_padding', array(
        'default' => '60',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_footer_padding', array(
        'label' => __('フッター内側余白 (px)', 'kashis-studio'),
        'section' => 'kashis_studio_footer',
        'type' => 'range',
        'input_attrs' => array('min' => 20, 'max' => 100, 'step' => 10),
    ));

    // ===================================================================
    // ANIMATION SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_animation', array(
        'title' => __('アニメーション設定', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 70,
    ));

    // Enable Animations
    $wp_customize->add_setting('kashis_studio_enable_animations', array(
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_enable_animations', array(
        'label' => __('アニメーションを有効化', 'kashis-studio'),
        'section' => 'kashis_studio_animation',
        'type' => 'checkbox',
    ));

    // Animation Speed
    $wp_customize->add_setting('kashis_studio_animation_speed', array(
        'default' => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_animation_speed', array(
        'label' => __('アニメーション速度', 'kashis-studio'),
        'section' => 'kashis_studio_animation',
        'type' => 'select',
        'choices' => array(
            'fast' => '高速 (0.2s)',
            'normal' => '標準 (0.3s)',
            'slow' => '低速 (0.5s)',
        ),
    ));

    // ===================================================================
    // CUSTOM CSS SECTION
    // ===================================================================
    $wp_customize->add_section('kashis_studio_custom_css', array(
        'title' => __('カスタムCSS', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 100,
    ));

    // Custom CSS
    $wp_customize->add_setting('kashis_studio_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'wp_strip_all_tags',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('kashis_studio_custom_css', array(
        'label' => __('追加CSS', 'kashis-studio'),
        'description' => __('高度なカスタマイズ用のCSSコード', 'kashis-studio'),
        'section' => 'kashis_studio_custom_css',
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => '/* カスタムCSSをここに入力 */',
            'rows' => 10,
        ),
    ));
}
add_action('customize_register', 'kashis_studio_advanced_customizer');

/**
 * Sanitize float values
 *
 * @param string $input Input value
 * @return float Sanitized float
 */
function kashis_studio_sanitize_float(string $input): float {
    return floatval($input);
}

/**
 * Output advanced customizer CSS
 *
 * @return void
 */
function kashis_studio_advanced_customizer_css(): void {
    // Get all settings
    $accent_color = get_theme_mod('kashis_studio_accent_color', '#FFAB00');
    $text_color = get_theme_mod('kashis_studio_text_color', '#172B4D');
    $link_color = get_theme_mod('kashis_studio_link_color', '#0052CC');
    $link_hover_color = get_theme_mod('kashis_studio_link_hover_color', '#0747A6');
    $bg_color = get_theme_mod('kashis_studio_bg_color', '#FFFFFF');
    $border_color = get_theme_mod('kashis_studio_border_color', '#DFE1E6');

    $heading_font = get_theme_mod('kashis_studio_heading_font_family', 'inherit');
    $h1_size = get_theme_mod('kashis_studio_h1_size', '2.5');
    $h2_size = get_theme_mod('kashis_studio_h2_size', '2');
    $line_height = get_theme_mod('kashis_studio_line_height', '1.7');
    $letter_spacing = get_theme_mod('kashis_studio_letter_spacing', '0');
    $font_weight = get_theme_mod('kashis_studio_font_weight', '400');

    $content_padding = get_theme_mod('kashis_studio_content_padding', '40');
    $section_spacing = get_theme_mod('kashis_studio_section_spacing', '80');
    $element_margin = get_theme_mod('kashis_studio_element_margin', '24');

    $button_radius = get_theme_mod('kashis_studio_button_radius', '4');
    $button_padding = get_theme_mod('kashis_studio_button_padding', '12');
    $button_hover_effect = get_theme_mod('kashis_studio_button_hover_effect', 'darken');

    $header_height = get_theme_mod('kashis_studio_header_height', '80');
    $header_bg = get_theme_mod('kashis_studio_header_bg', '#FFFFFF');
    $header_transparent = get_theme_mod('kashis_studio_header_transparent', false);
    $header_shadow = get_theme_mod('kashis_studio_header_shadow', true);

    $footer_bg = get_theme_mod('kashis_studio_footer_bg', '#172B4D');
    $footer_text = get_theme_mod('kashis_studio_footer_text', '#FFFFFF');
    $footer_padding = get_theme_mod('kashis_studio_footer_padding', '60');

    $enable_animations = get_theme_mod('kashis_studio_enable_animations', true);
    $animation_speed = get_theme_mod('kashis_studio_animation_speed', 'normal');
    $custom_css = get_theme_mod('kashis_studio_custom_css', '');

    $animation_duration = array(
        'fast' => '0.2s',
        'normal' => '0.3s',
        'slow' => '0.5s',
    );

    $font_families = array(
        'noto-sans-jp' => "'Noto Sans JP', sans-serif",
        'noto-serif-jp' => "'Noto Serif JP', serif",
        'hiragino' => "'Hiragino Kaku Gothic ProN', 'ヒラギノ角ゴ ProN', sans-serif",
        'meiryo' => "'Meiryo', 'メイリオ', sans-serif",
        'yu-gothic' => "'Yu Gothic', '游ゴシック', sans-serif",
        'arial' => "Arial, sans-serif",
        'helvetica' => "Helvetica, Arial, sans-serif",
    );

    ?>
    <style id="kashis-studio-advanced-css">
        :root {
            --accent-color: <?php echo esc_attr($accent_color); ?>;
            --text-color: <?php echo esc_attr($text_color); ?>;
            --link-color: <?php echo esc_attr($link_color); ?>;
            --link-hover-color: <?php echo esc_attr($link_hover_color); ?>;
            --bg-color: <?php echo esc_attr($bg_color); ?>;
            --border-color: <?php echo esc_attr($border_color); ?>;

            --h1-size: <?php echo esc_attr($h1_size); ?>rem;
            --h2-size: <?php echo esc_attr($h2_size); ?>rem;
            --line-height: <?php echo esc_attr($line_height); ?>;
            --letter-spacing: <?php echo esc_attr($letter_spacing); ?>px;
            --font-weight: <?php echo esc_attr($font_weight); ?>;

            --content-padding: <?php echo esc_attr($content_padding); ?>px;
            --section-spacing: <?php echo esc_attr($section_spacing); ?>px;
            --element-margin: <?php echo esc_attr($element_margin); ?>px;

            --button-radius: <?php echo esc_attr($button_radius); ?>px;
            --button-padding: <?php echo esc_attr($button_padding); ?>px;

            --header-height: <?php echo esc_attr($header_height); ?>px;
            --header-bg: <?php echo esc_attr($header_bg); ?>;

            --footer-bg: <?php echo esc_attr($footer_bg); ?>;
            --footer-text: <?php echo esc_attr($footer_text); ?>;
            --footer-padding: <?php echo esc_attr($footer_padding); ?>px;

            --animation-duration: <?php echo esc_attr($animation_duration[$animation_speed]); ?>;
        }

        /* Colors */
        body {
            color: var(--text-color);
            background-color: var(--bg-color);
            font-weight: var(--font-weight);
            line-height: var(--line-height);
            letter-spacing: var(--letter-spacing);
        }

        a {
            color: var(--link-color);
        }

        a:hover {
            color: var(--link-hover-color);
        }

        /* Typography */
        <?php if ($heading_font !== 'inherit' && isset($font_families[$heading_font])): ?>
        h1, h2, h3, h4, h5, h6 {
            font-family: <?php echo $font_families[$heading_font]; ?>;
        }
        <?php endif; ?>

        h1 {
            font-size: var(--h1-size);
        }

        h2 {
            font-size: var(--h2-size);
        }

        /* Spacing */
        .wp-block-group {
            padding-top: var(--section-spacing);
            padding-bottom: var(--section-spacing);
        }

        .entry-content > * + * {
            margin-top: var(--element-margin);
        }

        /* Buttons */
        .wp-block-button__link,
        .wp-element-button {
            border-radius: var(--button-radius);
            padding: var(--button-padding) calc(var(--button-padding) * 2);
            transition: all var(--animation-duration) ease;
        }

        <?php if ($button_hover_effect === 'darken'): ?>
        .wp-block-button__link:hover,
        .wp-element-button:hover {
            filter: brightness(0.9);
        }
        <?php elseif ($button_hover_effect === 'lighten'): ?>
        .wp-block-button__link:hover,
        .wp-element-button:hover {
            filter: brightness(1.1);
        }
        <?php elseif ($button_hover_effect === 'lift'): ?>
        .wp-block-button__link:hover,
        .wp-element-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        <?php elseif ($button_hover_effect === 'scale'): ?>
        .wp-block-button__link:hover,
        .wp-element-button:hover {
            transform: scale(1.05);
        }
        <?php endif; ?>

        /* Header */
        .site-header {
            height: var(--header-height);
            background-color: var(--header-bg);
            <?php if ($header_shadow): ?>
            box-shadow: 0 2px 8px rgba(9, 30, 66, 0.1);
            <?php endif; ?>
        }

        <?php if ($header_transparent && is_front_page()): ?>
        .home .site-header {
            background-color: transparent;
            box-shadow: none;
        }
        <?php endif; ?>

        /* Footer */
        .site-footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding-top: var(--footer-padding);
            padding-bottom: var(--footer-padding);
        }

        .site-footer a {
            color: var(--footer-text);
            opacity: 0.8;
        }

        .site-footer a:hover {
            opacity: 1;
        }

        /* Animations */
        <?php if (!$enable_animations): ?>
        * {
            animation: none !important;
            transition: none !important;
        }
        <?php endif; ?>

        /* Borders */
        .wp-block-group.is-style-bordered,
        .wp-block-separator,
        input,
        textarea,
        select {
            border-color: var(--border-color);
        }

        /* Custom CSS */
        <?php echo wp_strip_all_tags($custom_css); ?>
    </style>
    <?php
}
add_action('wp_head', 'kashis_studio_advanced_customizer_css', 99);
