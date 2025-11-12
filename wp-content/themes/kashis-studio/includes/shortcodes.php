<?php
/**
 * Custom Shortcodes
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Shortcode to embed STORES reservation system
 *
 * Outputs a reservation system embed area with configurable height.
 * Displays the reservation code from theme settings with XSS protection.
 *
 * Usage: [reservation_embed height="600px"]
 *
 * @since 1.0.6
 * @param array $atts Shortcode attributes (height)
 * @return string HTML output for reservation embed area
 */
function kashis_studio_reservation_embed($atts) {
    $atts = shortcode_atts(array(
        'height' => '600px',
    ), $atts);

    ob_start();
    ?>
    <div class="reservation-embed" style="min-height: <?php echo esc_attr($atts['height']); ?>;">
        <div class="reservation-placeholder">
            <h3>予約システム</h3>
            <p>ここにSTORES予約の埋め込みコードを設置してください。</p>
            <p>管理画面から「外観」→「ウィジェット」または「カスタマイズ」で設定できます。</p>
        </div>
        <!-- STORES予約埋め込みコードをここに配置 -->
        <?php
        // カスタムフィールドから埋め込みコードを取得
        $reservation_code = get_option('kashis_studio_reservation_code');
        if (!empty($reservation_code)) {
            // HTMLコードをサニタイズして出力（XSS対策）
            echo wp_kses_post($reservation_code);
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('reservation_embed', 'kashis_studio_reservation_embed');
