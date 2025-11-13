<?php
/**
 * Theme Activation and Setup Wizard
 *
 * Handles theme activation tasks, welcome screen, and guided setup.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Theme activation hook
 *
 * Runs when theme is activated, sets up initial configuration.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_theme_activation(): void {
    // Set flag to show welcome screen
    set_transient('kashis_studio_activation_redirect', true, 30);

    // Set default options if not exist
    $defaults = array(
        'kashis_studio_primary_color' => '#0052CC',
        'kashis_studio_secondary_color' => '#00875A',
        'kashis_studio_container_width' => '1200',
        'kashis_studio_sticky_header' => true,
        'kashis_studio_font_size' => '14',
    );

    foreach ($defaults as $option => $value) {
        if (get_theme_mod($option) === false) {
            set_theme_mod($option, $value);
        }
    }
}
add_action('after_switch_theme', 'kashis_studio_theme_activation');

/**
 * Redirect to welcome page after activation
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_activation_redirect(): void {
    if (!get_transient('kashis_studio_activation_redirect')) {
        return;
    }

    delete_transient('kashis_studio_activation_redirect');

    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }

    wp_safe_redirect(admin_url('admin.php?page=kashis-studio-welcome'));
    exit;
}
add_action('admin_init', 'kashis_studio_activation_redirect');

/**
 * Add welcome page to admin menu
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_welcome_menu(): void {
    add_theme_page(
        __('カシスタジオへようこそ', 'kashis-studio'),
        __('テーマセットアップ', 'kashis-studio'),
        'manage_options',
        'kashis-studio-welcome',
        'kashis_studio_welcome_page'
    );
}
add_action('admin_menu', 'kashis_studio_welcome_menu');

/**
 * Welcome page content
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_welcome_page(): void {
    ?>
    <div class="wrap kashis-welcome-wrap">
        <style>
            .kashis-welcome-wrap {
                max-width: 1200px;
                margin: 2rem auto;
            }
            .kashis-welcome-header {
                background: linear-gradient(135deg, #0052CC 0%, #2684FF 100%);
                color: #FFFFFF;
                padding: 3rem 2rem;
                border-radius: 8px;
                margin-bottom: 2rem;
                text-align: center;
            }
            .kashis-welcome-header h1 {
                font-size: 2.5rem;
                margin: 0 0 1rem 0;
                color: #FFFFFF;
            }
            .kashis-welcome-header p {
                font-size: 1.25rem;
                margin: 0;
                opacity: 0.95;
            }
            .kashis-setup-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                margin-bottom: 3rem;
            }
            .kashis-setup-card {
                background: #FFFFFF;
                border: 2px solid #DFE1E6;
                border-radius: 8px;
                padding: 2rem;
                transition: all 200ms ease;
            }
            .kashis-setup-card:hover {
                border-color: #0052CC;
                box-shadow: 0 8px 16px rgba(0, 82, 204, 0.1);
                transform: translateY(-4px);
            }
            .kashis-setup-card h2 {
                font-size: 1.5rem;
                margin: 0 0 1rem 0;
                color: #091E42;
            }
            .kashis-setup-card p {
                color: #5E6C84;
                line-height: 1.6;
                margin-bottom: 1.5rem;
            }
            .kashis-setup-card .button {
                width: 100%;
                text-align: center;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
            }
            .kashis-features-list {
                background: #F4F5F7;
                padding: 2rem;
                border-radius: 8px;
            }
            .kashis-features-list h3 {
                margin-top: 0;
                color: #091E42;
            }
            .kashis-features-list ul {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }
            .kashis-features-list li {
                padding: 0.75rem 0;
                color: #42526E;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            .kashis-features-list li:before {
                content: '✓';
                display: inline-block;
                width: 24px;
                height: 24px;
                background: #00875A;
                color: #FFFFFF;
                border-radius: 50%;
                text-align: center;
                line-height: 24px;
                font-weight: bold;
                flex-shrink: 0;
            }
        </style>

        <div class="kashis-welcome-header">
            <h1>🎉 カシスタジオへようこそ！</h1>
            <p>テーマのアクティベーションが完了しました。次のステップで素晴らしいウェブサイトを作成しましょう。</p>
        </div>

        <div class="kashis-setup-grid">
            <div class="kashis-setup-card">
                <h2>1️⃣ サンプルコンテンツを生成</h2>
                <p>スタジオルーム、ページ、お知らせのサンプルデータを自動生成します。すぐにデザインを確認できます。</p>
                <form method="post" action="">
                    <?php wp_nonce_field('kashis_generate_sample', 'kashis_sample_nonce'); ?>
                    <button type="submit" name="kashis_generate_sample" class="button button-primary">
                        サンプルコンテンツを生成
                    </button>
                </form>
            </div>

            <div class="kashis-setup-card">
                <h2>2️⃣ テーマをカスタマイズ</h2>
                <p>カスタマイザーで配色、ロゴ、レイアウトを調整します。リアルタイムでプレビューできます。</p>
                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary">
                    カスタマイザーを開く
                </a>
            </div>

            <div class="kashis-setup-card">
                <h2>3️⃣ スタジオ情報を設定</h2>
                <p>電話番号、メールアドレス、営業時間などの基本情報を設定します。</p>
                <a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-settings')); ?>" class="button button-primary">
                    スタジオ設定を開く
                </a>
            </div>
        </div>

        <div class="kashis-setup-grid">
            <div class="kashis-setup-card">
                <h2>🎨 ブロックショーケースページを生成</h2>
                <p>すべてのカスタムブロックの使用例を含むショーケースページを自動生成します。</p>
                <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?kashis_create_showcase=1'), 'create_showcase')); ?>" class="button button-secondary">
                    ショーケースページを作成
                </a>
            </div>

            <div class="kashis-setup-card">
                <h2>📚 編集ガイドを見る</h2>
                <p>ブロックエディタの使い方やテーマ機能の詳細を確認します。</p>
                <a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-help')); ?>" class="button button-secondary">
                    ヘルプページを開く
                </a>
            </div>

            <div class="kashis-setup-card">
                <h2>🌐 サイトを表示</h2>
                <p>フロントエンドでサイトがどのように表示されるか確認します。</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="button button-secondary" target="_blank">
                    サイトを開く
                </a>
            </div>
        </div>

        <div class="kashis-features-list">
            <h3>実装済みの機能</h3>
            <ul>
                <li>6種類のカスタムGutenbergブロック</li>
                <li>18種類の高度な機能</li>
                <li>Atlassian Design System準拠</li>
                <li>完全レスポンシブデザイン</li>
                <li>WAI-ARIAアクセシビリティ対応</li>
                <li>SEO最適化</li>
                <li>パフォーマンス最適化（62%軽量化）</li>
                <li>お気に入り・比較機能</li>
                <li>高度な検索ウィジェット</li>
                <li>カスタマイザー統合</li>
                <li>ショートコード4種類</li>
                <li>アニメーション10種類以上</li>
            </ul>
        </div>

        <div style="margin-top: 2rem; text-align: center; color: #5E6C84;">
            <p>
                <a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-help')); ?>">📘 編集ガイドを見る</a> |
                <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank">🌐 サイトを表示</a>
            </p>
        </div>
    </div>
    <?php

    // Handle sample content generation
    if (isset($_POST['kashis_generate_sample']) &&
        isset($_POST['kashis_sample_nonce']) &&
        wp_verify_nonce($_POST['kashis_sample_nonce'], 'kashis_generate_sample')) {

        if (current_user_can('manage_options')) {
            // Generate sample content
            if (function_exists('kashis_studio_create_dummy_data')) {
                $result = kashis_studio_create_dummy_data();

                if ($result) {
                    echo '<div class="notice notice-success"><p>✓ サンプルコンテンツの生成が完了しました！</p></div>';
                } else {
                    echo '<div class="notice notice-error"><p>サンプルコンテンツの生成中にエラーが発生しました。</p></div>';
                }
            }
        }
    }
}
