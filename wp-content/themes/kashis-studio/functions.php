<?php
/**
 * Kashis Studio Functions and Definitions
 *
 * @package Kashis_Studio
 * @since 1.0.0
 */

// 親テーマのスタイルシートを読み込む
function kashis_studio_enqueue_styles() {
    // 親テーマのスタイル
    wp_enqueue_style(
        'twentytwentyfour-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );

    // 子テーマのスタイル
    wp_enqueue_style(
        'kashis-studio-style',
        get_stylesheet_uri(),
        array('twentytwentyfour-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'kashis_studio_enqueue_styles');

// テーマサポート
function kashis_studio_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // HTML5サポート
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // カスタムロゴのサポート
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // ナビゲーションメニューの登録
    register_nav_menus(array(
        'primary' => __('プライマリメニュー', 'kashis-studio'),
        'footer'  => __('フッターメニュー', 'kashis-studio'),
    ));

    // カスタム画像サイズ
    add_image_size('studio-thumbnail', 800, 600, true);
    add_image_size('studio-hero', 1920, 800, true);
}
add_action('after_setup_theme', 'kashis_studio_setup');

// カスタム投稿タイプ: スタジオルーム
function kashis_studio_register_post_types() {
    // スタジオルーム
    register_post_type('studio_room', array(
        'labels' => array(
            'name'               => 'スタジオルーム',
            'singular_name'      => 'スタジオルーム',
            'menu_name'          => 'スタジオルーム',
            'add_new'            => '新規追加',
            'add_new_item'       => '新しいスタジオルームを追加',
            'edit_item'          => 'スタジオルームを編集',
            'new_item'           => '新しいスタジオルーム',
            'view_item'          => 'スタジオルームを表示',
            'search_items'       => 'スタジオルームを検索',
            'not_found'          => 'スタジオルームが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にスタジオルームはありません',
        ),
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'        => true, // ブロックエディター対応
        'menu_icon'           => 'dashicons-building',
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'revisions'),
        'rewrite'             => array('slug' => 'studio'),
        'capability_type'     => 'post',
    ));
}
add_action('init', 'kashis_studio_register_post_types');

// カスタムタクソノミー: 利用用途
function kashis_studio_register_taxonomies() {
    register_taxonomy('studio_usage', 'studio_room', array(
        'labels' => array(
            'name'              => '利用用途',
            'singular_name'     => '利用用途',
            'search_items'      => '利用用途を検索',
            'all_items'         => 'すべての利用用途',
            'edit_item'         => '利用用途を編集',
            'update_item'       => '利用用途を更新',
            'add_new_item'      => '新しい利用用途を追加',
            'new_item_name'     => '新しい利用用途名',
            'menu_name'         => '利用用途',
        ),
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true, // ブロックエディター対応
        'rewrite'           => array('slug' => 'usage'),
    ));

    // 設備タクソノミー
    register_taxonomy('studio_equipment', 'studio_room', array(
        'labels' => array(
            'name'              => '設備',
            'singular_name'     => '設備',
            'search_items'      => '設備を検索',
            'all_items'         => 'すべての設備',
            'edit_item'         => '設備を編集',
            'update_item'       => '設備を更新',
            'add_new_item'      => '新しい設備を追加',
            'new_item_name'     => '新しい設備名',
            'menu_name'         => '設備',
        ),
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'equipment'),
    ));
}
add_action('init', 'kashis_studio_register_taxonomies');

// ウィジェットエリアの登録
function kashis_studio_widgets_init() {
    register_sidebar(array(
        'name'          => 'サイドバー',
        'id'            => 'sidebar-1',
        'description'   => 'サイドバーウィジェットエリア',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'フッター1',
        'id'            => 'footer-1',
        'description'   => 'フッターウィジェットエリア1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'フッター2',
        'id'            => 'footer-2',
        'description'   => 'フッターウィジェットエリア2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => 'フッター3',
        'id'            => 'footer-3',
        'description'   => 'フッターウィジェットエリア3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'kashis_studio_widgets_init');

// ACFフィールドの設定（JSONファイルから自動読み込み）
function kashis_studio_acf_json_save_point($path) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'kashis_studio_acf_json_save_point');

function kashis_studio_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'kashis_studio_acf_json_load_point');

// カスタムショートコード: 予約システム埋め込みエリア
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
            echo $reservation_code;
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('reservation_embed', 'kashis_studio_reservation_embed');

// 管理画面にカスタム設定ページを追加
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

// 設定ページの内容
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
                        <input type="text" name="kashis_studio_phone" id="kashis_studio_phone" value="<?php echo esc_attr(get_option('kashis_studio_phone', '03-1234-5678')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_email">メールアドレス</label></th>
                    <td>
                        <input type="email" name="kashis_studio_email" id="kashis_studio_email" value="<?php echo esc_attr(get_option('kashis_studio_email', 'info@kashis-studio.example.com')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_address">住所</label></th>
                    <td>
                        <input type="text" name="kashis_studio_address" id="kashis_studio_address" value="<?php echo esc_attr(get_option('kashis_studio_address', '東京都渋谷区〇〇1-2-3 〇〇ビル4F')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_hours">営業時間</label></th>
                    <td>
                        <input type="text" name="kashis_studio_hours" id="kashis_studio_hours" value="<?php echo esc_attr(get_option('kashis_studio_hours', '平日 10:00-22:00 / 土日祝 9:00-22:00')); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="kashis_studio_access">アクセス</label></th>
                    <td>
                        <textarea name="kashis_studio_access" id="kashis_studio_access" rows="3" cols="50" class="large-text"><?php echo esc_textarea(get_option('kashis_studio_access', 'JR山手線 渋谷駅 徒歩5分')); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// 設定の登録
function kashis_studio_register_settings() {
    register_setting('kashis_studio_settings', 'kashis_studio_reservation_code');
    register_setting('kashis_studio_settings', 'kashis_studio_phone');
    register_setting('kashis_studio_settings', 'kashis_studio_email');
    register_setting('kashis_studio_settings', 'kashis_studio_address');
    register_setting('kashis_studio_settings', 'kashis_studio_hours');
    register_setting('kashis_studio_settings', 'kashis_studio_access');
}
add_action('admin_init', 'kashis_studio_register_settings');

// スタジオ情報を取得するヘルパー関数
function kashis_get_studio_info($key) {
    $info = array(
        'phone'   => get_option('kashis_studio_phone', '03-1234-5678'),
        'email'   => get_option('kashis_studio_email', 'info@kashis-studio.example.com'),
        'address' => get_option('kashis_studio_address', '東京都渋谷区〇〇1-2-3 〇〇ビル4F'),
        'hours'   => get_option('kashis_studio_hours', '平日 10:00-22:00 / 土日祝 9:00-22:00'),
        'access'  => get_option('kashis_studio_access', 'JR山手線 渋谷駅 徒歩5分'),
    );

    return isset($info[$key]) ? $info[$key] : '';
}

// ブロックパターンのカテゴリーを追加
function kashis_studio_register_block_patterns() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => 'カシスタジオ')
        );
    }
}
add_action('init', 'kashis_studio_register_block_patterns');
