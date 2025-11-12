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

/**
 * Get studio information by key
 *
 * Retrieves studio contact information and details from WordPress options
 * with static caching for better performance. Returns empty string if key doesn't exist.
 *
 * Available keys: phone, email, address, hours, access
 *
 * @since 1.0.6
 * @param string $key The information key to retrieve
 * @return string The requested studio information or empty string
 */
function kashis_get_studio_info($key) {
    static $info = null;

    // キャッシュが未初期化の場合のみget_option()を実行
    if ($info === null) {
        $info = array(
            'phone'   => get_option('kashis_studio_phone', '03-1234-5678'),
            'email'   => get_option('kashis_studio_email', 'info@kashis-studio.example.com'),
            'address' => get_option('kashis_studio_address', '東京都渋谷区〇〇1-2-3 〇〇ビル4F'),
            'hours'   => get_option('kashis_studio_hours', '平日 10:00-22:00 / 土日祝 9:00-22:00'),
            'access'  => get_option('kashis_studio_access', 'JR山手線 渋谷駅 徒歩5分'),
        );
    }

    return isset($info[$key]) ? $info[$key] : '';
}
