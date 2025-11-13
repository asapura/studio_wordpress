<?php
/**
 * Enhanced Sample Data Generator
 *
 * Creates realistic sample data with images for demo purposes
 *
 * @package Kashis_Studio
 * @since 1.0.9
 */

/**
 * Create enhanced dummy studio rooms with images
 *
 * @return bool True on success
 */
function kashis_studio_create_enhanced_rooms(): bool {
    $rooms = array(
        array(
            'title' => 'スタジオA - メインホール',
            'slug' => 'studio-a-main-hall',
            'description' => '<!-- wp:paragraph -->
<p>広々とした60㎡の大型スタジオ。全面鏡張りで、ダンススクールやヨガ教室に最適です。最大30名まで収容可能。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>全面鏡張り（3面）</li>
<li>プロ仕様音響システム（JBL）</li>
<li>Bluetooth接続可能</li>
<li>天井高3.2m</li>
<li>バレエバー完備</li>
<li>クッションフロア（膝・腰に優しい）</li>
<li>エアコン完備（快適な温度管理）</li>
<li>更衣室・シャワー完備</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ダンスレッスン、ヨガ・ピラティス、バレエ、演劇の稽古、フィットネス教室、ワークショップ、撮影など</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥3,500</li>
<li>3時間パック: ¥9,000（¥1,500お得）</li>
<li>5時間パック: ¥15,000（¥2,500お得）</li>
<li>1日貸切（10時間）: ¥28,000（¥7,000お得）</li>
</ul>
<!-- /wp:list -->',
            'size' => '60㎡（約36畳）',
            'capacity' => 30,
            'price' => 3500,
            'floor' => '4F',
            'image_url' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&h=600&fit=crop', // Dance studio
            'equipment' => array('mirror', 'sound_system', 'bluetooth', 'ballet_bar', 'air_conditioner', 'wifi', 'shower', 'changing_room'),
            'usages' => array('ダンス', 'ヨガ', 'バレエ', '演劇'),
        ),
        array(
            'title' => 'スタジオB - 音楽練習室',
            'slug' => 'studio-b-music',
            'description' => '<!-- wp:paragraph -->
<p>防音完備の音楽専用スタジオ。バンド練習、楽器練習、レコーディングに最適。各種機材レンタルも可能。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>完全防音（隣室への音漏れなし）</li>
<li>ドラムセット（YAMAHA）</li>
<li>ベースアンプ・ギターアンプ</li>
<li>PA システム</li>
<li>マイク4本</li>
<li>キーボード（88鍵）</li>
<li>譜面台6台</li>
<li>エアコン完備</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>バンド練習、楽器個人練習、ボイストレーニング、レコーディング、音楽レッスン</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥2,800</li>
<li>3時間パック: ¥7,500</li>
<li>深夜パック（22時〜翌6時）: ¥15,000</li>
</ul>
<!-- /wp:list -->',
            'size' => '25㎡（約15畳）',
            'capacity' => 10,
            'price' => 2800,
            'floor' => '3F',
            'image_url' => 'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?w=800&h=600&fit=crop', // Music studio
            'equipment' => array('soundproof', 'drum_set', 'amplifier', 'pa_system', 'microphone', 'keyboard', 'music_stand', 'air_conditioner', 'wifi'),
            'usages' => array('音楽練習', 'バンド練習', 'レコーディング'),
        ),
        array(
            'title' => 'スタジオC - コンパクトルーム',
            'slug' => 'studio-c-compact',
            'description' => '<!-- wp:paragraph -->
<p>1〜8名の少人数向けスタジオ。パーソナルトレーニング、小規模ワークショップ、個人練習に最適です。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>一面鏡張り</li>
<li>Bluetoothスピーカー</li>
<li>ヨガマット8枚完備</li>
<li>エアコン完備</li>
<li>Wi-Fi完備</li>
<li>ホワイトボード</li>
<li>椅子・テーブル</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>パーソナルトレーニング、少人数ヨガ、ピラティス、個人ダンス練習、セミナー、撮影</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥1,800</li>
<li>3時間パック: ¥4,500</li>
<li>5時間パック: ¥7,000</li>
</ul>
<!-- /wp:list -->',
            'size' => '18㎡（約11畳）',
            'capacity' => 8,
            'price' => 1800,
            'floor' => '3F',
            'image_url' => 'https://images.unsplash.com/photo-1540497077202-7c8a3999166f?w=800&h=600&fit=crop', // Yoga studio
            'equipment' => array('mirror', 'bluetooth', 'yoga_mat', 'air_conditioner', 'wifi', 'whiteboard', 'chair', 'table'),
            'usages' => array('ヨガ', 'ピラティス', 'パーソナルトレーニング'),
        ),
        array(
            'title' => 'スタジオD - 撮影・配信スタジオ',
            'slug' => 'studio-d-photo-streaming',
            'description' => '<!-- wp:paragraph -->
<p>撮影・配信専用スタジオ。照明機材、背景紙、三脚など撮影機材が充実。YouTuber、配信者に人気！</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>LED照明システム（3灯）</li>
<li>背景紙（白・黒・グリーン）</li>
<li>三脚3台</li>
<li>レフ板セット</li>
<li>スタンドマイク</li>
<li>Wi-Fi（高速・安定）</li>
<li>ホワイトボード・小道具</li>
<li>エアコン完備</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>YouTube撮影、ライブ配信、商品撮影、ポートレート撮影、オンライン講座、Zoom配信</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥2,200</li>
<li>3時間パック: ¥6,000</li>
<li>半日パック（4時間）: ¥7,500</li>
<li>1日パック（8時間）: ¥14,000</li>
</ul>
<!-- /wp:list -->',
            'size' => '20㎡（約12畳）',
            'capacity' => 5,
            'price' => 2200,
            'floor' => '5F',
            'image_url' => 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=800&h=600&fit=crop', // Photo studio
            'equipment' => array('led_light', 'backdrop', 'tripod', 'reflector', 'microphone', 'wifi', 'whiteboard', 'air_conditioner'),
            'usages' => array('撮影', '配信', 'オンライン講座'),
        ),
        array(
            'title' => 'スタジオE - フィットネスルーム',
            'slug' => 'studio-e-fitness',
            'description' => '<!-- wp:paragraph -->
<p>フィットネストレーニング専用スタジオ。トレーニング器具完備で、パーソナルトレーニングやグループレッスンに。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>ダンベルセット（1kg〜15kg）</li>
<li>ヨガマット10枚</li>
<li>バランスボール5個</li>
<li>ステップ台6台</li>
<li>ストレッチポール</li>
<li>一面鏡張り</li>
<li>Bluetoothスピーカー</li>
<li>シャワー・更衣室</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>パーソナルトレーニング、グループフィットネス、ストレッチ教室、体幹トレーニング、ボディメイク</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥2,500</li>
<li>3時間パック: ¥6,500</li>
<li>5時間パック: ¥10,000</li>
<li>月額会員（1日1時間使い放題）: ¥25,000</li>
</ul>
<!-- /wp:list -->',
            'size' => '30㎡（約18畳）',
            'capacity' => 12,
            'price' => 2500,
            'floor' => '4F',
            'image_url' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&h=600&fit=crop', // Gym
            'equipment' => array('dumbbell', 'yoga_mat', 'balance_ball', 'step_platform', 'stretch_pole', 'mirror', 'bluetooth', 'shower', 'changing_room', 'air_conditioner', 'wifi'),
            'usages' => array('フィットネス', 'パーソナルトレーニング', 'グループレッスン'),
        ),
        array(
            'title' => 'スタジオF - 和室多目的ルーム',
            'slug' => 'studio-f-japanese-room',
            'description' => '<!-- wp:paragraph -->
<p>落ち着いた和室スタジオ。茶道、華道、着付け教室、瞑想、ヨガなど和の雰囲気を活かした利用に最適。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>設備・特徴</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>畳12畳</li>
<li>床の間</li>
<li>座卓・座布団完備</li>
<li>お茶セット（茶道具）</li>
<li>Bluetoothスピーカー</li>
<li>Wi-Fi完備</li>
<li>エアコン完備</li>
<li>靴箱・下駄箱</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>こんな用途に</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>茶道教室、華道教室、着付け教室、書道教室、瞑想・マインドフルネス、和ヨガ、占い、セラピー</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>料金</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>1時間: ¥2,000</li>
<li>3時間パック: ¥5,200</li>
<li>半日パック（4時間）: ¥6,800</li>
</ul>
<!-- /wp:list -->',
            'size' => '24㎡（12畳）',
            'capacity' => 10,
            'price' => 2000,
            'floor' => '2F',
            'image_url' => 'https://images.unsplash.com/photo-1528360983277-13d401cdc186?w=800&h=600&fit=crop', // Japanese room
            'equipment' => array('tatami', 'alcove', 'low_table', 'cushion', 'tea_set', 'bluetooth', 'wifi', 'air_conditioner'),
            'usages' => array('茶道', '華道', '着付け', '瞑想', 'ヨガ'),
        ),
    );

    $success_count = 0;

    foreach ($rooms as $room_data) {
        // Create post
        $post_data = array(
            'post_title' => $room_data['title'],
            'post_content' => $room_data['description'],
            'post_status' => 'publish',
            'post_type' => 'studio_room',
            'post_name' => $room_data['slug'],
            'post_author' => get_current_user_id(),
        );

        $room_id = wp_insert_post($post_data);

        if (is_wp_error($room_id) || !$room_id) {
            error_log('Failed to create room: ' . $room_data['title']);
            continue;
        }

        // Add custom fields
        update_post_meta($room_id, 'studio_size', $room_data['size']);
        update_post_meta($room_id, 'studio_capacity', $room_data['capacity']);
        update_post_meta($room_id, 'studio_base_price', $room_data['price']);
        update_post_meta($room_id, 'studio_floor', $room_data['floor']);
        update_post_meta($room_id, 'studio_equipment_list', $room_data['equipment']);
        update_post_meta($room_id, 'studio_display_order', $success_count + 1);

        // Set taxonomies
        if (!empty($room_data['usages'])) {
            wp_set_object_terms($room_id, $room_data['usages'], 'studio_usage');
        }

        // Download and set featured image from Unsplash
        $image_id = kashis_studio_sideload_image($room_data['image_url'], $room_id, $room_data['title']);
        if ($image_id) {
            set_post_thumbnail($room_id, $image_id);
        }

        $success_count++;
    }

    return $success_count === count($rooms);
}

/**
 * Sideload image from URL
 *
 * @param string $image_url Image URL
 * @param int $post_id Post ID
 * @param string $desc Image description
 * @return int|false Attachment ID or false on failure
 */
function kashis_studio_sideload_image(string $image_url, int $post_id, string $desc) {
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Download file to temp dir
    $tmp = download_url($image_url);

    if (is_wp_error($tmp)) {
        return false;
    }

    $file_array = array(
        'name' => basename($image_url) . '.jpg',
        'tmp_name' => $tmp,
    );

    // Do the upload
    $id = media_handle_sideload($file_array, $post_id, $desc);

    // If error storing permanently, unlink
    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $id;
}

/**
 * Create testimonial sample data
 *
 * @return bool True on success
 */
function kashis_studio_create_testimonials(): bool {
    $testimonials = array(
        array(
            'name' => '田中 美咲',
            'role' => 'ヨガインストラクター',
            'rating' => 5,
            'comment' => 'スタジオAは広くて明るく、生徒さんたちからも大好評です。設備も充実していて、毎週のレッスンが楽しみです！',
            'image' => 'https://i.pravatar.cc/150?img=1',
        ),
        array(
            'name' => '佐藤 健太',
            'role' => 'バンドメンバー',
            'rating' => 5,
            'comment' => '防音がしっかりしていて、深夜でも気兼ねなく練習できます。機材も揃っていて、コスパ最高です！',
            'image' => 'https://i.pravatar.cc/150?img=12',
        ),
        array(
            'name' => '鈴木 あゆみ',
            'role' => 'YouTuber',
            'rating' => 5,
            'comment' => '撮影スタジオの照明が素晴らしい！背景紙も豊富で、いろんなシーンが撮れます。配信もサクサクで快適です。',
            'image' => 'https://i.pravatar.cc/150?img=5',
        ),
        array(
            'name' => '山田 太郎',
            'role' => 'パーソナルトレーナー',
            'rating' => 4,
            'comment' => 'クライアントとのトレーニングに利用しています。器具も充実していて、清潔感もあり大満足です。',
            'image' => 'https://i.pravatar.cc/150?img=33',
        ),
        array(
            'name' => '高橋 真理子',
            'role' => '茶道講師',
            'rating' => 5,
            'comment' => '和室スタジオの雰囲気が素晴らしいです。本格的な茶道教室が開けて、生徒さんも喜んでいます。',
            'image' => 'https://i.pravatar.cc/150?img=9',
        ),
    );

    // Store as option for use in testimonial block
    update_option('kashis_studio_sample_testimonials', $testimonials);

    return true;
}

/**
 * Setup initial theme customizer settings
 *
 * @return void
 */
function kashis_studio_setup_customizer_defaults(): void {
    // Set default color preset
    set_theme_mod('kashis_studio_primary_color', '#0052CC');
    set_theme_mod('kashis_studio_secondary_color', '#00875A');
    set_theme_mod('kashis_studio_accent_color', '#FFAB00');

    // Set typography defaults
    set_theme_mod('kashis_studio_font_family', 'system');
    set_theme_mod('kashis_studio_font_size', '14');
    set_theme_mod('kashis_studio_line_height', '1.7');

    // Set layout defaults
    set_theme_mod('kashis_studio_container_width', '1200');
    set_theme_mod('kashis_studio_sticky_header', true);
    set_theme_mod('kashis_studio_header_shadow', true);

    // Set button defaults
    set_theme_mod('kashis_studio_button_radius', '4');
    set_theme_mod('kashis_studio_button_padding', '12');
    set_theme_mod('kashis_studio_button_hover_effect', 'darken');

    // Set animation defaults
    set_theme_mod('kashis_studio_enable_animations', true);
    set_theme_mod('kashis_studio_animation_speed', 'normal');
}
