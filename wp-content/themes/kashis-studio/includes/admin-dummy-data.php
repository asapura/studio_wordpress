<?php
/**
 * Admin Dummy Data Generator
 *
 * @package Kashis_Studio
 * @since 1.0.7
 */

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
