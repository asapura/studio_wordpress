<?php
/**
 * Admin Panel and Settings
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

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

// ダミーデータ作成ページを追加
function kashis_studio_add_dummy_data_page() {
    add_submenu_page(
        'kashis-studio-settings',
        'ダミーデータ作成',
        'ダミーデータ作成',
        'manage_options',
        'kashis-studio-dummy-data',
        'kashis_studio_dummy_data_page'
    );
}
add_action('admin_menu', 'kashis_studio_add_dummy_data_page');

// ダミーデータ作成ページの内容
function kashis_studio_dummy_data_page() {
    // ダミーデータ作成処理
    if (isset($_POST['create_dummy_data']) && check_admin_referer('kashis_studio_dummy_data_nonce')) {
        kashis_studio_create_dummy_data();
        echo '<div class="notice notice-success"><p>ダミーデータを作成しました！</p></div>';
    }

    // 既存のダミーデータをチェック
    $has_dummy = get_option('kashis_studio_dummy_data_created', false);

    ?>
    <div class="wrap">
        <h1>ダミーデータ作成</h1>
        <p>カシスタジオのサイトを外観から確認できるよう、ダミーデータを作成します。</p>

        <?php if ($has_dummy): ?>
        <div class="notice notice-info">
            <p>すでにダミーデータが作成されています。再度実行すると重複したデータが作成されます。</p>
        </div>
        <?php endif; ?>

        <h2>作成されるデータ</h2>
        <ul>
            <li>✅ スタジオルーム投稿 × 1件（メインスタジオ）</li>
            <li>✅ 固定ページ × 6件（ホーム、料金システム、アクセス、ご利用方法、お問い合わせ、予約）</li>
            <li>✅ お知らせ記事 × 3件</li>
            <li>✅ カテゴリー・タクソノミー設定</li>
        </ul>

        <form method="post" style="margin-top: 20px;">
            <?php wp_nonce_field('kashis_studio_dummy_data_nonce'); ?>
            <input type="submit" name="create_dummy_data" class="button button-primary button-hero" value="ダミーデータを作成" onclick="return confirm('ダミーデータを作成しますか？');">
        </form>

        <hr style="margin: 30px 0;">

        <h2>注意事項</h2>
        <ul>
            <li>この操作は元に戻せません。</li>
            <li>既存のデータには影響しません（追加のみ）。</li>
            <li>画像は含まれません。実際の画像は後で追加してください。</li>
            <li>作成後、「設定」→「表示設定」でトップページを設定してください。</li>
            <li>作成後、「設定」→「パーマリンク設定」で「変更を保存」をクリックしてください。</li>
        </ul>
    </div>
    <?php
}

// ダミーデータ作成関数
function kashis_studio_create_dummy_data() {
    // 1. スタジオルームの作成
    $studio_post = array(
        'post_title'    => 'メインスタジオ',
        'post_content'  => '<!-- wp:paragraph -->
<p>カシスタジオのメインスタジオは、広々とした空間で様々な用途にご利用いただけます。全面鏡張りの壁面により、ダンスやヨガのレッスンに最適です。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">スタジオの特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>全面鏡張りで動きを確認しやすい</li>
<li>高品質な音響システム完備</li>
<li>Bluetooth対応スピーカー</li>
<li>天井が高く開放感がある</li>
<li>床材は膝や腰に優しいクッションフロア</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">こんな用途におすすめ</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ダンスレッスン、ヨガ、ピラティス、バレエ、演劇の稽古、音楽練習、パーソナルトレーニング、ワークショップなど、幅広い用途でご利用いただけます。</p>
<!-- /wp:paragraph -->',
        'post_status'   => 'publish',
        'post_type'     => 'studio_room',
        'post_author'   => get_current_user_id(),
    );

    $studio_id = wp_insert_post($studio_post);

    if ($studio_id) {
        // カスタムフィールドを追加
        update_post_meta($studio_id, 'studio_size', '30㎡（約18畳）');
        update_post_meta($studio_id, 'studio_capacity', 15);
        update_post_meta($studio_id, 'studio_base_price', 2500);
        update_post_meta($studio_id, 'studio_floor', '4F');
        update_post_meta($studio_id, 'studio_equipment_list', array('mirror', 'sound_system', 'bluetooth', 'air_conditioner', 'wifi', 'locker', 'changing_room', 'chair'));
        update_post_meta($studio_id, 'studio_display_order', 1);

        // タクソノミーを追加
        wp_set_object_terms($studio_id, array('ダンス', 'ヨガ', '音楽練習'), 'studio_usage');
        wp_set_object_terms($studio_id, array('全面鏡張り', '音響システム', 'Bluetooth対応'), 'studio_equipment');
    }

    // 2. 固定ページの作成
    $pages = array(
        array(
            'title' => 'ホーム',
            'slug' => 'home',
            'content' => '<!-- このページはfront-page.htmlテンプレートを使用します -->',
            'template' => 'front-page',
        ),
        array(
            'title' => '料金システム',
            'slug' => 'pricing',
            'content' => '<!-- このページはpage-pricing.htmlテンプレートを使用します -->',
            'template' => 'page-pricing',
        ),
        array(
            'title' => 'アクセス',
            'slug' => 'access',
            'content' => '<!-- このページはpage-access.htmlテンプレートを使用します -->',
            'template' => 'page-access',
        ),
        array(
            'title' => 'ご利用方法',
            'slug' => 'how-to-use',
            'content' => '<!-- wp:heading -->
<h2 class="wp-block-heading">ご利用の流れ</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>カシスタジオのご利用は以下の流れで進みます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">1. 予約</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>オンライン予約システム（STORES予約）または電話でご予約ください。24時間前までのご予約を推奨しています。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">2. 来店</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>予約時間の10分前までにお越しください。初回のお客様は受付で簡単な登録を行います。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">3. 利用開始</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>スタジオの使い方をご説明します。音響機器の操作方法などもお気軽にお尋ねください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">4. お支払い</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ご利用後、受付にてお支払いをお願いします。現金・クレジットカード・電子マネーに対応しています。</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">ご利用規約</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>スタジオ内は土足禁止です。室内履きをご持参ください。</li>
<li>飲食は水分補給のための飲み物のみ可能です。</li>
<li>騒音にはご配慮ください。周辺への配慮をお願いします。</li>
<li>備品の破損・汚損があった場合は実費をご請求させていただきます。</li>
<li>危険な行為、他のお客様の迷惑となる行為はご遠慮ください。</li>
</ul>
<!-- /wp:list -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">よくある質問</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Q. 初めて利用する場合、会員登録は必要ですか？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A. はい、初回のみ簡単な会員登録（無料）をお願いしています。氏名、連絡先などの基本情報のみです。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Q. 当日予約は可能ですか？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A. はい、空きがあれば当日予約も可能です。ただし、事前予約を推奨しています。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Q. 音響機器の使い方がわかりません</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A. スタッフが丁寧にご説明いたします。お気軽にお声がけください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Q. 駐車場はありますか？</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A. 専用駐車場はございませんが、近隣にコインパーキングが複数あります。</p>
<!-- /wp:paragraph -->',
            'template' => '',
        ),
        array(
            'title' => 'お問い合わせ',
            'slug' => 'contact',
            'content' => '<!-- wp:paragraph -->
<p>カシスタジオへのお問い合わせは、以下のフォームまたはお電話・メールにて承っております。</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">お問い合わせフォーム</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>※ Contact Form 7のショートコードをここに挿入してください<br>例: [contact-form-7 id="1" title="お問い合わせ"]</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">その他のお問い合わせ方法</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>電話:</strong> 03-1234-5678<br><strong>営業時間:</strong> 平日 10:00-22:00 / 土日祝 9:00-22:00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>メール:</strong> info@kashis-studio.example.com<br><strong>返信:</strong> 24時間以内に返信いたします</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:paragraph -->
<p>お急ぎの場合は、お電話でのお問い合わせをおすすめします。</p>
<!-- /wp:paragraph -->',
            'template' => '',
        ),
        array(
            'title' => '予約',
            'slug' => 'reservation',
            'content' => '<!-- wp:heading -->
<h2 class="wp-block-heading">オンライン予約</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>カシスタジオのオンライン予約システムです。ご希望の日時を選択してご予約ください。</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:shortcode -->
[reservation_embed]
<!-- /wp:shortcode -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading -->
<h2 class="wp-block-heading">電話予約</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>お電話でのご予約も承っております。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>電話:</strong> 03-1234-5678<br><strong>受付時間:</strong> 平日 10:00-22:00 / 土日祝 9:00-22:00</p>
<!-- /wp:paragraph -->',
            'template' => '',
        ),
    );

    foreach ($pages as $page_data) {
        $page = array(
            'post_title'    => $page_data['title'],
            'post_content'  => $page_data['content'],
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => $page_data['slug'],
            'post_author'   => get_current_user_id(),
        );

        $page_id = wp_insert_post($page);

        if ($page_id && !empty($page_data['template'])) {
            update_post_meta($page_id, '_wp_page_template', $page_data['template']);
        }
    }

    // 3. お知らせ記事の作成
    $posts = array(
        array(
            'title' => 'カシスタジオがオープンしました！',
            'content' => '<!-- wp:paragraph -->
<p>この度、カシスタジオがオープンいたしました！</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>東京都心の好立地に、ダンス、ヨガ、音楽練習など多目的にご利用いただける完全個室のレンタルスタジオです。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">オープン記念キャンペーン</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>オープンを記念して、初回ご利用の方は<strong>20%OFF</strong>でご利用いただけます。ぜひこの機会にカシスタジオをご体験ください。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>期間:</strong> 2025年11月11日〜12月31日まで<br><strong>対象:</strong> 初回ご利用のお客様<br><strong>適用:</strong> ご予約時に「オープンキャンペーン」とお伝えください</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>皆様のご来店を心よりお待ちしております！</p>
<!-- /wp:paragraph -->',
            'category' => 'お知らせ',
        ),
        array(
            'title' => '年末年始の営業時間のお知らせ',
            'content' => '<!-- wp:paragraph -->
<p>年末年始の営業時間についてお知らせいたします。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">営業時間</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>12月29日〜30日:</strong> 通常営業（9:00-22:00）</li>
<li><strong>12月31日:</strong> 短縮営業（9:00-18:00）</li>
<li><strong>1月1日〜3日:</strong> 休業</li>
<li><strong>1月4日〜:</strong> 通常営業</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>ご不便をおかけいたしますが、何卒よろしくお願いいたします。</p>
<!-- /wp:paragraph -->',
            'category' => 'お知らせ',
        ),
        array(
            'title' => 'パック料金プランを追加しました',
            'content' => '<!-- wp:paragraph -->
<p>よりお得にご利用いただけるパック料金プランを追加しました！</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">新プラン</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>3時間パック:</strong> ¥7,000（通常より¥500お得）</li>
<li><strong>5時間パック:</strong> ¥11,000（通常より¥1,500お得）</li>
<li><strong>10時間回数券:</strong> ¥22,000（3ヶ月有効、¥3,000お得）</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>長時間のご利用や、定期的にご利用いただくお客様に最適なプランです。詳しくは<a href="/pricing/">料金ページ</a>をご覧ください。</p>
<!-- /wp:paragraph -->',
            'category' => 'お知らせ',
        ),
    );

    // カテゴリーを作成
    $cat_id = wp_create_category('お知らせ');

    foreach ($posts as $post_data) {
        $post = array(
            'post_title'    => $post_data['title'],
            'post_content'  => $post_data['content'],
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_author'   => get_current_user_id(),
            'post_category' => array($cat_id),
        );

        wp_insert_post($post);
    }

    // ダミーデータ作成完了フラグを設定
    update_option('kashis_studio_dummy_data_created', true);
}

// ============================================================================
// ブロックエディター対応（非エンジニア向け）
// ============================================================================

// カスタムブロックパターンカテゴリーの登録
function kashis_studio_register_block_pattern_category() {
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'kashis-studio',
            array('label' => __('カシスタジオ', 'kashis-studio'))
        );
    }
}
add_action('init', 'kashis_studio_register_block_pattern_category');

// エディターのカスタマイズ
function kashis_studio_editor_settings() {
    // ブロックエディターのサポートを追加
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');
    add_theme_support('custom-units');
    add_theme_support('link-color');
    add_theme_support('border');
    
    // エディター用スタイルの読み込み
    add_editor_style('style.css');
}
add_action('after_setup_theme', 'kashis_studio_editor_settings');

// ブロックエディターでのカラーパレット拡張
function kashis_studio_block_editor_assets() {
    wp_enqueue_script(
        'kashis-studio-editor',
        get_stylesheet_directory_uri() . '/assets/js/editor.js',
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        wp_get_theme()->get('Version')
    );
}
// add_action('enqueue_block_editor_assets', 'kashis_studio_block_editor_assets');

// 管理画面に使い方ガイドを追加
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

function kashis_studio_help_page() {
    ?>
    <div class="wrap">
        <h1>ブロックエディターの使い方</h1>

        <div class="card" style="max-width: 100%; background: #f0f9ff; border-left: 4px solid #2563eb;">
            <h2 style="color: #2563eb;">📍 ページ管理の場所一覧</h2>
            <p>各ページがどこで管理されているかを明確にします。</p>

            <table class="widefat" style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th style="padding: 10px;"><strong>ページ名</strong></th>
                        <th style="padding: 10px;"><strong>管理場所</strong></th>
                        <th style="padding: 10px;"><strong>編集方法</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px;"><strong>TOPページ（ホーム）</strong></td>
                        <td style="padding: 10px;">固定ページ → 「ホーム」または「トップページ」</td>
                        <td style="padding: 10px;">
                            1. 「固定ページ」→「ホーム」を編集<br>
                            2. ブロックパターンを使って各セクションを配置<br>
                            3. 「設定」→「表示設定」で「固定ページ」を選択し、ホームページに指定
                        </td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">スタジオ紹介ページ</td>
                        <td style="padding: 10px;">固定ページ → 各ページ名</td>
                        <td style="padding: 10px;">「固定ページ」→「新規追加」で作成</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">料金システムページ</td>
                        <td style="padding: 10px;">固定ページ → 「料金システム」</td>
                        <td style="padding: 10px;">「料金表」パターンを使用</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">アクセスページ</td>
                        <td style="padding: 10px;">固定ページ → 「アクセス」</td>
                        <td style="padding: 10px;">「アクセス情報」パターンを使用</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">お知らせ（ブログ記事）</td>
                        <td style="padding: 10px;">投稿 → 記事一覧</td>
                        <td style="padding: 10px;">「投稿」→「新規追加」で作成</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 10px;">スタジオルーム詳細</td>
                        <td style="padding: 10px;">スタジオルーム → 各ルーム名</td>
                        <td style="padding: 10px;">「スタジオルーム」→「新規追加」で作成</td>
                    </tr>
                    <tr>
                        <td style="padding: 10px;">電話番号・住所などの基本情報</td>
                        <td style="padding: 10px;">スタジオ設定 → 基本設定</td>
                        <td style="padding: 10px;">管理画面左メニュー「スタジオ設定」から編集</td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 20px; padding: 15px; background: white; border-radius: 4px;">
                <h3 style="margin-top: 0;">💡 TOPページの各セクション管理</h3>
                <p><strong>TOPページの各セクション（ヒーロー、特徴、料金表など）は、すべて「固定ページ」→「ホーム」の中で管理されています。</strong></p>
                <ol>
                    <li>管理画面左メニュー「固定ページ」をクリック</li>
                    <li>「ホーム」または「トップページ」というタイトルのページを見つける</li>
                    <li>「編集」をクリック</li>
                    <li>ブロックエディターが開き、各セクションが表示されます</li>
                    <li>編集したいセクション（ブロック）をクリックして編集</li>
                    <li>「更新」ボタンで保存</li>
                </ol>
                <p style="margin-bottom: 0;"><em>※ TOPページがまだ作成されていない場合は、下記「TOPページの作り方」を参照してください。</em></p>
            </div>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🎨 ブロックパターンの使い方</h2>
            <p>ブロックパターンを使えば、プロフェッショナルなデザインのセクションを簡単に追加できます。</p>

            <ol>
                <li><strong>ページ編集画面を開く</strong><br>「固定ページ」→「新規追加」または既存ページの編集</li>
                <li><strong>ブロックパターンを挿入</strong><br>画面左上の「+」ボタン→「パターン」タブ→「カシスタジオ」カテゴリーを選択</li>
                <li><strong>利用可能なパターン:</strong>
                    <ul>
                        <li>✨ ヒーローセクション - トップページのメインビジュアル</li>
                        <li>🏢 スタジオルームカード - スタジオの紹介カード（3列）</li>
                        <li>💰 料金表 - 料金プランの表示</li>
                        <li>❓ FAQ（よくある質問） - アコーディオン形式のFAQ</li>
                        <li>📣 CTA（予約促進）セクション - 予約を促すエリア</li>
                        <li>📍 アクセス情報 - 地図と店舗情報</li>
                        <li>⭐ スタジオの特徴 - 6つの特徴をグリッド表示</li>
                    </ul>
                </li>
                <li><strong>テキストや画像を変更</strong><br>パターンを挿入後、テキストをクリックして編集、画像をクリックして置き換え</li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🎨 色とフォントの変更方法</h2>
            <p>ブロックエディターの右サイドバーから、色やフォントを簡単に変更できます。</p>
            
            <ol>
                <li><strong>ブロックを選択</strong><br>変更したいテキストや画像をクリック</li>
                <li><strong>右サイドバーで設定</strong>
                    <ul>
                        <li><strong>色</strong>: カラーパレットから選択（プライマリ、セカンダリなど）</li>
                        <li><strong>フォントサイズ</strong>: 小、中、大、特大など</li>
                        <li><strong>スペーシング</strong>: 余白を調整</li>
                        <li><strong>角丸</strong>: ボタンやカードの角を丸くする</li>
                    </ul>
                </li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>📝 よく使うブロック</h2>
            <ul>
                <li><strong>段落</strong>: 通常のテキスト</li>
                <li><strong>見出し</strong>: タイトルや小見出し（H2〜H6）</li>
                <li><strong>画像</strong>: 写真やイラストを挿入</li>
                <li><strong>カラム</strong>: 2列、3列のレイアウト</li>
                <li><strong>ボタン</strong>: リンクボタン</li>
                <li><strong>カバー</strong>: 背景画像付きのエリア</li>
                <li><strong>グループ</strong>: 複数のブロックをまとめる</li>
                <li><strong>スペーサー</strong>: 余白を追加</li>
                <li><strong>詳細</strong>: アコーディオン（開閉式）</li>
                <li><strong>テーブル</strong>: 表を作成</li>
            </ul>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px; background: #fffbeb; border-left: 4px solid #f59e0b;">
            <h2 style="color: #f59e0b;">✏️ TOPページの編集方法（2つの方法）</h2>
            <p>TOPページを編集する方法は2つあります。どちらでも同じ結果になりますので、お好みの方法をお選びください。</p>

            <h3 style="margin-top: 1.5rem;">方法1: サイトエディターから編集（推奨）</h3>
            <ol>
                <li>管理画面左メニュー「<strong>外観</strong>」→「<strong>エディター</strong>」をクリック</li>
                <li>「<strong>テンプレート</strong>」をクリック</li>
                <li>一覧から「<strong>フロントページ</strong>」または「<strong>ホーム</strong>」を選択</li>
                <li>ブロックエディターが開くので、各セクションを編集</li>
                <li>画面右上の「<strong>保存</strong>」ボタンをクリック</li>
            </ol>
            <p style="margin-top: 1rem; padding: 10px; background: white; border-radius: 4px;">
                <strong>💡 サイトエディターの利点:</strong><br>
                ヘッダー、フッター、TOPページのコンテンツをまとめて確認しながら編集できます。<br>
                リアルタイムでプレビューを見ながら編集できます。
            </p>

            <h3 style="margin-top: 2rem;">方法2: 固定ページ「ホーム」から編集</h3>
            <ol>
                <li>管理画面左メニュー「<strong>固定ページ</strong>」をクリック</li>
                <li>一覧から「<strong>ホーム</strong>」または「<strong>トップページ</strong>」を見つけて「編集」をクリック</li>
                <li>ブロックエディターが開くので、各セクションを編集</li>
                <li>画面右上の「<strong>更新</strong>」ボタンをクリック</li>
            </ol>
            <p style="margin-top: 1rem; padding: 10px; background: white; border-radius: 4px;">
                <strong>💡 固定ページ編集の利点:</strong><br>
                他の固定ページと同じ方法で編集できるため、慣れている方におすすめです。
            </p>

            <h3 style="margin-top: 2rem;">🔍 各セクションの見つけ方</h3>
            <table class="widefat" style="margin-top: 10px; background: white;">
                <thead>
                    <tr>
                        <th style="padding: 8px;">セクション名</th>
                        <th style="padding: 8px;">見つけ方</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 8px;">ヒーローセクション</td>
                        <td style="padding: 8px;">ページ最上部の大きなビジュアルエリア（カバーブロック）</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">スタジオの特徴</td>
                        <td style="padding: 8px;">3つのカード（絵文字付き）が並んでいるセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">スタジオ紹介</td>
                        <td style="padding: 8px;">スタジオルームの情報が表示されるセクション</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">料金表</td>
                        <td style="padding: 8px;">テーブルブロックで料金が表示されているセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">FAQ</td>
                        <td style="padding: 8px;">詳細ブロック（アコーディオン）で質問が並んでいるセクション</td>
                    </tr>
                    <tr style="background: #f9fafb;">
                        <td style="padding: 8px;">予約促進（CTA）</td>
                        <td style="padding: 8px;">背景色が付いた「今すぐ予約」ボタンがあるセクション</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">アクセス情報</td>
                        <td style="padding: 8px;">住所・地図が表示されているセクション（ページ下部）</td>
                    </tr>
                </tbody>
            </table>

            <p style="margin-top: 1.5rem; padding: 15px; background: white; border-radius: 4px; border: 2px solid #f59e0b;">
                <strong>⚠️ 重要:</strong><br>
                各セクションをクリックすると、ブロックが選択され、右側のサイドバーに編集オプションが表示されます。<br>
                テキストをクリックすればその場で編集でき、画像をクリックすれば画像を置き換えることができます。
            </p>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>🚀 新しくTOPページを作成する方法</h2>
            <p>まだTOPページが作成されていない場合は、以下の手順で作成してください。</p>
            <ol>
                <li>「固定ページ」→「新規追加」</li>
                <li>タイトルを「ホーム」または「トップページ」に設定</li>
                <li>以下の順番でパターンを挿入:
                    <ol>
                        <li>ヒーローセクション</li>
                        <li>スタジオの特徴</li>
                        <li>スタジオルームカード</li>
                        <li>料金表</li>
                        <li>FAQ</li>
                        <li>CTA（予約促進）</li>
                        <li>アクセス情報</li>
                    </ol>
                </li>
                <li>各パターンのテキストと画像を編集</li>
                <li>「公開」ボタンをクリック</li>
                <li>「設定」→「表示設定」→「ホームページの表示」で、作成したページを「ホームページ」に設定</li>
            </ol>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px;">
            <h2>💡 Tips</h2>
            <ul>
                <li><strong>プレビュー機能</strong>: 編集中に「プレビュー」ボタンで表示を確認できます</li>
                <li><strong>リビジョン</strong>: 過去のバージョンに戻すことができます（右サイドバー→「リビジョン」）</li>
                <li><strong>下書き保存</strong>: 公開前に「下書きとして保存」で一時保存できます</li>
                <li><strong>複製</strong>: ブロックを選択→ツールバーの「︙」→「複製」で同じブロックをコピーできます</li>
                <li><strong>ブロックを移動</strong>: ブロックを選択→ツールバーの「↑↓」で上下に移動できます</li>
            </ul>
        </div>

        <div class="card" style="max-width: 100%; margin-top: 20px; background: #f0f9ff; border-left: 4px solid #2563eb;">
            <h2 style="color: #2563eb;">📚 さらに詳しく学びたい方へ</h2>
            <p>WordPressの公式ドキュメントもご参照ください：</p>
            <ul>
                <li><a href="https://ja.wordpress.org/support/article/wordpress-editor/" target="_blank">WordPressエディター完全ガイド</a></li>
                <li><a href="https://ja.wordpress.org/support/article/blocks/" target="_blank">ブロック一覧</a></li>
            </ul>
        </div>
    </div>
    <?php
}

// 非エンジニア向け: 不要な機能を非表示にする（オプション）
function kashis_studio_simplify_admin() {
    // コメント機能を無効化（必要に応じて）
    // add_action('admin_init', function() {
    //     remove_menu_page('edit-comments.php');
    // });
    
    // 不要なウィジェットを非表示（必要に応じて）
    // add_action('admin_init', function() {
    //     remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    //     remove_meta_box('dashboard_primary', 'dashboard', 'side');
    // });
}
add_action('init', 'kashis_studio_simplify_admin');

// ブロックエディターのヒント機能（管理バーに表示）
function kashis_studio_admin_bar_help($wp_admin_bar) {
    if (!is_admin() && is_user_logged_in() && current_user_can('edit_posts')) {
