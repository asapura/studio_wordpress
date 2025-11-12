<?php
/**
 * Helper Functions
 *
 * Utility functions used throughout the theme
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

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
