<?php
/**
 * Admin Settings Page
 *
 * @package Kashis_Studio
 * @since 1.0.7
 */

/**
 * Add custom settings page to admin menu
 *
 * Creates a top-level menu item "スタジオ設定" (Studio Settings) in the WordPress
 * admin panel for managing theme-specific settings.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_add_admin_menu() {
    add_menu_page(
        'カシスタジオ設定',
        'スタジオ設定',
        'manage_options',
        'kashis-studio-settings',
        'kashis_studio_settings_page',
        'dashicons-admin-generic',
        100
    );
}
add_action('admin_menu', 'kashis_studio_add_admin_menu');

/**
 * Render the settings page content
 *
 * Displays the settings form for studio information including:
 * - STORES reservation embed code
 * - Phone number
 * - Email address
 * - Physical address
 * - Business hours
 * - Access information
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_settings_page() {
    ?>
    <div class="wrap">
        <h1>カシスタジオ設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('kashis_studio_settings');
            do_settings_sections('kashis_studio_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="kashis_studio_reservation_code">STORES予約埋め込みコード</label></th>
                    <td>
                        <textarea name="kashis_studio_reservation_code" id="kashis_studio_reservation_code" rows="10" cols="50" class="large-text"><?php echo esc_textarea(get_option('kashis_studio_reservation_code')); ?></textarea>
                        <p class="description">STORES予約から取得した埋め込みコードを貼り付けてください。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_phone">電話番号</label></th>
                    <td>
                        <input type="text" name="kashis_studio_phone" id="kashis_studio_phone" value="<?php echo esc_attr(get_option('kashis_studio_phone', KASHIS_STUDIO_DEFAULT_PHONE)); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_email">メールアドレス</label></th>
                    <td>
                        <input type="email" name="kashis_studio_email" id="kashis_studio_email" value="<?php echo esc_attr(get_option('kashis_studio_email', KASHIS_STUDIO_DEFAULT_EMAIL)); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_address">住所</label></th>
                    <td>
                        <input type="text" name="kashis_studio_address" id="kashis_studio_address" value="<?php echo esc_attr(get_option('kashis_studio_address', KASHIS_STUDIO_DEFAULT_ADDRESS)); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_hours">営業時間</label></th>
                    <td>
                        <input type="text" name="kashis_studio_hours" id="kashis_studio_hours" value="<?php echo esc_attr(get_option('kashis_studio_hours', KASHIS_STUDIO_DEFAULT_HOURS)); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_access">アクセス</label></th>
                    <td>
                        <textarea name="kashis_studio_access" id="kashis_studio_access" rows="3" cols="50" class="large-text"><?php echo esc_textarea(get_option('kashis_studio_access', KASHIS_STUDIO_DEFAULT_ACCESS)); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Register theme settings with WordPress Settings API
 *
 * Registers all studio settings options to allow them to be saved
 * via the WordPress options system with proper sanitization callbacks.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_register_settings() {
    register_setting('kashis_studio_settings', 'kashis_studio_reservation_code', array(
        'type' => 'string',
        'sanitize_callback' => 'wp_kses_post',
        'default' => ''
    ));
    register_setting('kashis_studio_settings', 'kashis_studio_phone', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => KASHIS_STUDIO_DEFAULT_PHONE
    ));
    register_setting('kashis_studio_settings', 'kashis_studio_email', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default' => KASHIS_STUDIO_DEFAULT_EMAIL
    ));
    register_setting('kashis_studio_settings', 'kashis_studio_address', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => KASHIS_STUDIO_DEFAULT_ADDRESS
    ));
    register_setting('kashis_studio_settings', 'kashis_studio_hours', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => KASHIS_STUDIO_DEFAULT_HOURS
    ));
    register_setting('kashis_studio_settings', 'kashis_studio_access', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default' => KASHIS_STUDIO_DEFAULT_ACCESS
    ));
}
add_action('admin_init', 'kashis_studio_register_settings');
