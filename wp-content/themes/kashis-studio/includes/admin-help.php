<?php
/**
 * Admin Help Page
 *
 * @package Kashis_Studio
 * @since 1.0.7
 */

/**
 * Add help/usage guide page to admin menu
 *
 * Creates a submenu page under "スタジオ設定" (Studio Settings) that provides
 * comprehensive documentation for non-technical users on how to use the block
 * editor and manage website content.
 *
 * @since 1.0.7
 * @return void
 */
function kashis_studio_add_help_menu() {
    add_submenu_page(
        'kashis-studio-settings',
        'ブロックエディターの使い方',
        'エディターの使い方',
        'edit_posts',
        'kashis-studio-help',
        'kashis_studio_help_page'
    );
}
add_action('admin_menu', 'kashis_studio_add_help_menu', 11);

/**
 * Render the help page content
 *
 * Displays a comprehensive guide for using the block editor including:
 * - Page management locations
 * - Block pattern usage instructions
 * - Color and font customization
 * - Commonly used blocks
 * - TOP page editing methods
 * - Tips and best practices
 * - Links to official WordPress documentation
 *
 * Designed for non-technical users to easily understand how to manage the site.
 *
 * @since 1.0.7
 * @since 1.0.8 Refactored to use external template file
 * @return void
 */
function kashis_studio_help_page() {
    $template_path = get_stylesheet_directory() . '/templates/admin-help-page.php';

    if (file_exists($template_path)) {
        require_once $template_path;
    } else {
        ?>
        <div class="wrap">
            <h1>エラー</h1>
            <div class="notice notice-error">
                <p>テンプレートファイルが見つかりません。</p>
                <p><code><?php echo esc_html($template_path); ?></code></p>
            </div>
        </div>
        <?php
        error_log('Admin help template not found: ' . $template_path);
    }
}

