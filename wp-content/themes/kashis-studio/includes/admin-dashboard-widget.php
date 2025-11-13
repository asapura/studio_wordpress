<?php
/**
 * Admin Dashboard Widget
 *
 * Provides a custom dashboard widget showing studio overview, room statistics,
 * recent additions, quick actions, and helpful tips for content management.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register custom dashboard widget
 *
 * Adds a "カシスタジオ 概要" (Kashis Studio Overview) widget to the
 * WordPress admin dashboard for quick access to studio information.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_add_dashboard_widget(): void {
    wp_add_dashboard_widget(
        'kashis_studio_overview',
        '📊 カシスタジオ 概要',
        'kashis_studio_dashboard_widget_content'
    );
}
add_action('wp_dashboard_setup', 'kashis_studio_add_dashboard_widget');

/**
 * Render dashboard widget content
 *
 * Displays comprehensive studio information including:
 * - Room count and recent room additions
 * - Quick action links for common tasks
 * - Helpful tips for content management
 * - Links to documentation and settings
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_dashboard_widget_content(): void {
    // Get studio room statistics
    $room_count = wp_count_posts('studio_room');
    $published_rooms = isset($room_count->publish) ? $room_count->publish : 0;
    $draft_rooms = isset($room_count->draft) ? $room_count->draft : 0;

    // Get recent studio rooms
    $recent_rooms = get_posts(array(
        'post_type'      => 'studio_room',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));

    // Get recent posts count
    $recent_posts_count = wp_count_posts('post');
    $published_posts = isset($recent_posts_count->publish) ? $recent_posts_count->publish : 0;

    ?>
    <style>
        .kashis-dashboard-widget {
            font-size: 14px;
            line-height: 1.6;
        }
        .kashis-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        .kashis-stat-box {
            background: #f0f0f1;
            padding: 16px;
            border-radius: 4px;
            text-align: center;
        }
        .kashis-stat-number {
            font-size: 32px;
            font-weight: 600;
            color: #0052CC;
            display: block;
            margin-bottom: 4px;
        }
        .kashis-stat-label {
            font-size: 12px;
            color: #646970;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kashis-section {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #dcdcde;
        }
        .kashis-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .kashis-section-title {
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .kashis-recent-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .kashis-recent-list li {
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f1;
        }
        .kashis-recent-list li:last-child {
            border-bottom: none;
        }
        .kashis-recent-list a {
            color: #0052CC;
            text-decoration: none;
            font-weight: 500;
        }
        .kashis-recent-list a:hover {
            text-decoration: underline;
        }
        .kashis-recent-date {
            font-size: 12px;
            color: #787c82;
            margin-left: 8px;
        }
        .kashis-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .kashis-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            background: #0052CC;
            color: #fff !important;
            border-radius: 3px;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 500;
            transition: background-color 150ms ease;
        }
        .kashis-action-btn:hover {
            background: #0747A6;
        }
        .kashis-action-btn.secondary {
            background: #f0f0f1;
            color: #1d2327 !important;
        }
        .kashis-action-btn.secondary:hover {
            background: #dcdcde;
        }
        .kashis-tips {
            background: #FFFAE6;
            padding: 12px;
            border-radius: 3px;
            border-left: 3px solid #FFAB00;
        }
        .kashis-tips ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }
        .kashis-tips li {
            margin-bottom: 4px;
            font-size: 13px;
            color: #42526E;
        }
        .kashis-empty-state {
            padding: 24px;
            text-align: center;
            background: #f0f0f1;
            border-radius: 4px;
            color: #646970;
        }
    </style>

    <div class="kashis-dashboard-widget">
        <!-- Statistics Section -->
        <div class="kashis-stats">
            <div class="kashis-stat-box">
                <span class="kashis-stat-number"><?php echo esc_html($published_rooms); ?></span>
                <span class="kashis-stat-label">公開中のスタジオ</span>
            </div>
            <div class="kashis-stat-box">
                <span class="kashis-stat-number"><?php echo esc_html($draft_rooms); ?></span>
                <span class="kashis-stat-label">下書き</span>
            </div>
            <div class="kashis-stat-box">
                <span class="kashis-stat-number"><?php echo esc_html($published_posts); ?></span>
                <span class="kashis-stat-label">お知らせ記事</span>
            </div>
        </div>

        <!-- Recent Rooms Section -->
        <div class="kashis-section">
            <div class="kashis-section-title">
                🏢 最近追加されたスタジオ
            </div>
            <?php if (!empty($recent_rooms)): ?>
                <ul class="kashis-recent-list">
                    <?php foreach ($recent_rooms as $room): ?>
                        <li>
                            <a href="<?php echo esc_url(get_edit_post_link($room->ID)); ?>">
                                <?php echo esc_html($room->post_title); ?>
                            </a>
                            <span class="kashis-recent-date">
                                <?php echo esc_html(get_the_date('Y/m/d', $room->ID)); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="kashis-empty-state">
                    まだスタジオルームが登録されていません
                </div>
            <?php endif; ?>
        </div>

        <!-- Quick Actions Section -->
        <div class="kashis-section">
            <div class="kashis-section-title">
                ⚡ クイックアクション
            </div>
            <div class="kashis-actions">
                <a href="<?php echo esc_url(admin_url('post-new.php?post_type=studio_room')); ?>" class="kashis-action-btn">
                    ➕ 新規スタジオ追加
                </a>
                <a href="<?php echo esc_url(admin_url('edit.php?post_type=studio_room')); ?>" class="kashis-action-btn secondary">
                    📋 スタジオ一覧
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-settings')); ?>" class="kashis-action-btn secondary">
                    ⚙️ スタジオ設定
                </a>
                <a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-help')); ?>" class="kashis-action-btn secondary">
                    📘 編集ガイド
                </a>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="kashis-section">
            <div class="kashis-section-title">
                💡 編集のヒント
            </div>
            <div class="kashis-tips">
                <ul>
                    <li>ブロックエディタで簡単にレイアウトを作成できます</li>
                    <li>画像は適切なサイズ（推奨：1200x800px）で用意しましょう</li>
                    <li>スタジオの特徴は箇条書きで分かりやすく記載しましょう</li>
                    <li>料金情報は最新の状態に保ちましょう</li>
                    <li>困ったときは<a href="<?php echo esc_url(admin_url('admin.php?page=kashis-studio-help')); ?>">編集ガイド</a>をご覧ください</li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
