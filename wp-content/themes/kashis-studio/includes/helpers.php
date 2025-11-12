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
function kashis_get_studio_info(string $key): string {
    static $info = null;

    // キャッシュが未初期化の場合のみget_option()を実行
    if ($info === null) {
        $info = array(
            'phone'   => get_option('kashis_studio_phone', KASHIS_STUDIO_DEFAULT_PHONE),
            'email'   => get_option('kashis_studio_email', KASHIS_STUDIO_DEFAULT_EMAIL),
            'address' => get_option('kashis_studio_address', KASHIS_STUDIO_DEFAULT_ADDRESS),
            'hours'   => get_option('kashis_studio_hours', KASHIS_STUDIO_DEFAULT_HOURS),
            'access'  => get_option('kashis_studio_access', KASHIS_STUDIO_DEFAULT_ACCESS),
        );
    }

    return isset($info[$key]) ? $info[$key] : '';
}
