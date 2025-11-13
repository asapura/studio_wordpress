<?php
/**
 * Legal Pages Generator
 * カシスタジオの法的ページ（プライバシーポリシー、特商法、利用規約、Cookie）を作成
 *
 * @package Kashis_Studio
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * すべての法的ページを作成
 */
function kashis_studio_create_legal_pages(): bool {
    $pages_created = array();

    // 1. プライバシーポリシー
    $pages_created['privacy'] = kashis_studio_create_privacy_policy();

    // 2. 特定商取引法に基づく表記
    $pages_created['tokushoho'] = kashis_studio_create_tokushoho_page();

    // 3. 利用規約
    $pages_created['terms'] = kashis_studio_create_terms_of_service();

    // 4. Cookieポリシー
    $pages_created['cookie'] = kashis_studio_create_cookie_policy();

    // すべて成功したかチェック
    $all_success = !in_array(false, $pages_created, true);

    if ($all_success) {
        // WordPress設定でプライバシーポリシーページを設定
        if ($pages_created['privacy']) {
            update_option('wp_page_for_privacy_policy', $pages_created['privacy']);
        }

        // オプションに保存
        update_option('kashis_studio_legal_pages', $pages_created);
    }

    return $all_success;
}

/**
 * プライバシーポリシーページを作成
 */
function kashis_studio_create_privacy_policy(): int|bool {
    // 既存ページをチェック
    $existing = get_page_by_path('privacy-policy');
    if ($existing) {
        return $existing->ID;
    }

    $content = '<!-- wp:heading -->
<h2>個人情報の取り扱いについて</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>カシスタジオ（以下「当スタジオ」）は、お客様の個人情報の保護に最大限の注意を払い、以下の方針に基づき適切に取り扱います。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>1. 個人情報の定義</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>個人情報とは、お客様個人を識別できる情報を指し、氏名、住所、電話番号、メールアドレス、その他当スタジオが取得する情報が含まれます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>2. 個人情報の収集</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、以下の目的で個人情報を収集します：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>スタジオのご予約・ご利用に関するご連絡</li>
<li>お問い合わせへの対応</li>
<li>サービス向上のためのアンケートやキャンペーンのご案内</li>
<li>ご利用料金の請求および決済処理</li>
<li>統計データの作成（個人を特定できない形式）</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>3. 個人情報の利用目的</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>収集した個人情報は、以下の目的でのみ利用します：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>ご予約の確認、変更、キャンセルの対応</li>
<li>ご利用料金の請求とお支払いの管理</li>
<li>お問い合わせ、ご相談への回答</li>
<li>新サービスやキャンペーン情報のご案内（ご同意いただいた場合のみ）</li>
<li>サービス品質の向上および改善</li>
<li>当スタジオの利用規約や法令に違反する行為への対応</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>4. 個人情報の第三者提供</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、以下の場合を除き、お客様の個人情報を第三者に提供することはありません：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>お客様の同意がある場合</li>
<li>法令に基づく場合</li>
<li>人の生命、身体または財産の保護のために必要がある場合</li>
<li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>5. 個人情報の管理</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、個人情報への不正アクセス、紛失、破壊、改ざん、漏洩等を防止するため、適切なセキュリティ対策を実施します。個人情報は、アクセス権限を持つ従業員のみが取り扱い、厳重に管理します。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>6. Cookieの使用について</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオのウェブサイトでは、サービスの利便性向上のためCookieを使用しています。Cookieとは、ウェブサイトがお客様のコンピュータに保存する小さなテキストファイルです。Cookieの詳細については、<a href="/cookie-policy">Cookieポリシー</a>をご確認ください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>7. アクセス解析ツールについて</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオのウェブサイトでは、Google Analyticsを使用してアクセス解析を行っています。Google Analyticsは、Cookieを使用してお客様の情報を収集します。この情報は匿名で収集され、個人を特定するものではありません。Google Analyticsの利用規約およびプライバシーポリシーについては、Googleのウェブサイトをご確認ください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>8. お客様の権利</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>お客様は、当スタジオが保有する個人情報について、以下の権利を有します：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>開示請求：保有する個人情報の開示を請求できます</li>
<li>訂正請求：個人情報の内容が事実でない場合、訂正を請求できます</li>
<li>利用停止請求：個人情報の利用停止を請求できます</li>
<li>削除請求：個人情報の削除を請求できます</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>これらの請求を行う場合は、下記のお問い合わせ窓口までご連絡ください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>9. SSL/TLSによる暗号化</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオのウェブサイトは、個人情報を安全に送信するため、SSL/TLS（Secure Socket Layer/Transport Layer Security）による暗号化通信を使用しています。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>10. プライバシーポリシーの変更</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、法令の変更や事業内容の変更等により、本プライバシーポリシーを予告なく変更することがあります。変更後のプライバシーポリシーは、本ウェブサイトに掲載した時点から効力を生じるものとします。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>11. お問い合わせ窓口</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>個人情報の取り扱いに関するお問い合わせは、以下までご連絡ください：</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>カシスタジオ</strong><br>
メール：info@kashis-studio.example.com<br>
電話：03-1234-5678<br>
受付時間：平日 10:00～19:00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>制定日：' . date('Y年n月j日') . '</em></p>
<!-- /wp:paragraph -->';

    $page_data = array(
        'post_title'    => 'プライバシーポリシー',
        'post_name'     => 'privacy-policy',
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'comment_status' => 'closed',
        'ping_status'   => 'closed',
    );

    return wp_insert_post($page_data);
}

/**
 * 特定商取引法に基づく表記ページを作成
 */
function kashis_studio_create_tokushoho_page(): int|bool {
    // 既存ページをチェック
    $existing = get_page_by_path('tokushoho');
    if ($existing) {
        return $existing->ID;
    }

    // 設定から情報を取得
    $studio_info = get_option('kashis_studio_info', array());
    $phone = $studio_info['phone'] ?? '03-1234-5678';
    $email = $studio_info['email'] ?? 'info@kashis-studio.example.com';
    $address = $studio_info['address'] ?? '東京都渋谷区〇〇 1-2-3 〇〇ビル 4F';

    $content = '<!-- wp:paragraph -->
<p>特定商取引法に基づき、以下の通り表示します。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>販売業者</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>カシスタジオ</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>運営責任者</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>代表者名（氏名または法人名をご記入ください）</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>所在地</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html($address) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>電話番号</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html($phone) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>メールアドレス</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>' . esc_html($email) . '</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>営業時間</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>平日：9:00～21:00<br>
土日祝：9:00～21:00</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>サービスの提供</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>レンタルスタジオの提供</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>利用料金</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>各スタジオルームの料金は、各スタジオルームの詳細ページに記載されております。料金は全て税込価格です。</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>スタジオA - メインホール：3,500円/時間</li>
<li>スタジオB - 音楽スタジオ：2,800円/時間</li>
<li>スタジオC - コンパクトルーム：1,800円/時間</li>
<li>スタジオD - 配信・撮影スタジオ：4,200円/時間</li>
<li>スタジオE - フィットネスルーム：2,500円/時間</li>
<li>スタジオF - 和室スタジオ：3,200円/時間</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>料金以外の必要代金</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>お支払い方法により、以下の手数料が発生する場合があります：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>銀行振込の場合：振込手数料（お客様負担）</li>
<li>クレジットカード決済の場合：手数料なし</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>支払方法</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>クレジットカード決済（VISA、MasterCard、JCB、American Express、Diners Club）</li>
<li>銀行振込（前払い）</li>
<li>現地での現金支払い</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>支払時期</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li>クレジットカード決済：ご予約確定時</li>
<li>銀行振込：ご予約後3日以内</li>
<li>現金支払い：ご利用当日</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>サービスの提供時期</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ご予約いただいた日時に、スタジオをご利用いただけます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>キャンセル・変更について</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ご予約のキャンセル・変更については、以下のキャンセルポリシーが適用されます：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>利用日の7日前まで：キャンセル料なし</li>
<li>利用日の6日前～3日前：利用料金の30%</li>
<li>利用日の2日前～前日：利用料金の50%</li>
<li>利用日当日：利用料金の100%</li>
<li>無断キャンセル：利用料金の100%</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>キャンセル・変更のご連絡は、お電話またはメールにて承ります。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>返金について</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>キャンセル料を差し引いた金額を、お客様のご指定の口座にお振込みいたします。振込手数料はお客様のご負担とさせていただきます。返金処理には、キャンセルのご連絡から7営業日程度かかります。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>免責事項</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>以下の場合、当スタジオは責任を負いかねます：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>天災地変、その他不可抗力によりサービスを提供できない場合</li>
<li>お客様の故意または過失によって生じた損害</li>
<li>お客様がスタジオ内に持ち込まれた物品の紛失、盗難、破損</li>
<li>お客様間のトラブルや事故</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>お問い合わせ</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ご不明な点がございましたら、下記までお問い合わせください。</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>カシスタジオ</strong><br>
メール：' . esc_html($email) . '<br>
電話：' . esc_html($phone) . '<br>
受付時間：平日 10:00～19:00</p>
<!-- /wp:paragraph -->';

    $page_data = array(
        'post_title'    => '特定商取引法に基づく表記',
        'post_name'     => 'tokushoho',
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'comment_status' => 'closed',
        'ping_status'   => 'closed',
    );

    return wp_insert_post($page_data);
}

/**
 * 利用規約ページを作成
 */
function kashis_studio_create_terms_of_service(): int|bool {
    // 既存ページをチェック
    $existing = get_page_by_path('terms-of-service');
    if ($existing) {
        return $existing->ID;
    }

    $content = '<!-- wp:heading -->
<h2>はじめに</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>本利用規約（以下「本規約」）は、カシスタジオ（以下「当スタジオ」）が提供するレンタルスタジオサービス（以下「本サービス」）の利用条件を定めるものです。ご利用のお客様（以下「利用者」）は、本規約に同意したうえで本サービスをご利用いただくものとします。</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>第1条（適用）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>本規約は、利用者と当スタジオとの間の本サービスの利用に関わる一切の関係に適用されます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>第2条（定義）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>本規約において使用する用語の定義は、以下の通りとします：</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>「本サービス」とは、当スタジオが提供するレンタルスタジオサービスを指します</li>
<li>「利用者」とは、本サービスを利用する個人または法人を指します</li>
<li>「本スタジオ」とは、当スタジオが運営する各レンタルスタジオ施設を指します</li>
<li>「利用契約」とは、本規約に基づき、利用者と当スタジオとの間で締結される本サービスの利用契約を指します</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第3条（予約・申込）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>利用者は、当スタジオが定める方法により、本サービスの利用を申し込むものとします</li>
<li>利用申込は、当スタジオが承諾した時点で確定するものとします</li>
<li>当スタジオは、以下の場合、利用申込を承諾しないことがあります：
<ul>
<li>申込内容に虚偽、誤記、記入漏れがあった場合</li>
<li>過去に本規約違反があった場合</li>
<li>その他当スタジオが不適切と判断した場合</li>
</ul>
</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第4条（利用料金および支払い）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>利用者は、本サービスの利用料金として、各スタジオルームの料金表に定める金額を支払うものとします</li>
<li>利用料金の支払方法は、クレジットカード決済、銀行振込、現金払いとします</li>
<li>銀行振込の場合の振込手数料は、利用者の負担とします</li>
<li>延長利用が発生した場合、追加料金が発生します</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第5条（利用時のルール）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>利用者は、本スタジオ利用時において、以下の事項を遵守するものとします：</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>予約時間を厳守すること</li>
<li>施設・設備を丁寧に扱い、破損・汚損させないこと</li>
<li>他の利用者や近隣住民への迷惑行為をしないこと</li>
<li>火気の使用、喫煙、飲食（指定エリアを除く）をしないこと</li>
<li>当スタジオの許可なく、転貸、再利用させないこと</li>
<li>利用終了時に、原状回復および清掃を行うこと</li>
<li>機材の持ち出しをしないこと</li>
<li>危険物の持ち込みをしないこと</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第6条（禁止行為）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>利用者は、本サービスの利用にあたり、以下の行為を行ってはなりません：</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>法令または公序良俗に違反する行為</li>
<li>犯罪行為に関連する行為</li>
<li>当スタジオ、他の利用者、第三者の知的財産権、肖像権、プライバシー権、名誉その他の権利または利益を侵害する行為</li>
<li>暴力的な要求行為、脅迫的な言動、その他これに準ずる行為</li>
<li>本サービスの運営を妨害する行為</li>
<li>本サービスの信用を毀損する行為</li>
<li>宗教活動、政治活動、営利目的での勧誘行為</li>
<li>わいせつな行為、風俗営業に該当する行為</li>
<li>無許可での撮影、録音、配信</li>
<li>その他当スタジオが不適切と判断する行為</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第7条（キャンセルポリシー）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>予約のキャンセル・変更については、以下の通りキャンセル料が発生します：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>利用日の7日前まで：無料</li>
<li>利用日の6日前～3日前：利用料金の30%</li>
<li>利用日の2日前～前日：利用料金の50%</li>
<li>利用日当日：利用料金の100%</li>
<li>無断キャンセル：利用料金の100%</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第8条（損害賠償）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>利用者が本規約に違反し、または本サービスの利用に関連して当スタジオに損害を与えた場合、当スタジオに対して損害賠償責任を負うものとします</li>
<li>利用者が施設・設備を破損、汚損した場合、修理費用または原状回復費用を負担していただきます</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第9条（免責事項）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>当スタジオは、以下の事由により生じた損害について、責任を負いません：
<ul>
<li>天災地変、その他不可抗力によるもの</li>
<li>利用者の故意または過失によるもの</li>
<li>利用者が持ち込んだ物品の紛失、盗難、破損</li>
<li>利用者間のトラブルや事故</li>
</ul>
</li>
<li>当スタジオは、本サービスの一時的な中断、停止、終了により生じた損害について、責任を負いません</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第10条（個人情報の取り扱い）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、利用者の個人情報を、当スタジオの<a href="/privacy-policy">プライバシーポリシー</a>に基づき適切に取り扱います。</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>第11条（利用契約の解除）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、利用者が以下の各号のいずれかに該当する場合、事前通知なく利用契約を解除できるものとします：</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>本規約に違反した場合</li>
<li>料金の支払いを怠った場合</li>
<li>当スタジオからの連絡に対して応答がない場合</li>
<li>その他利用契約の継続が困難と判断した場合</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第12条（規約の変更）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>当スタジオは、本規約を変更できるものとします</li>
<li>変更後の本規約は、当スタジオのウェブサイトに掲載した時点から効力を生じるものとします</li>
<li>変更後、利用者が本サービスを利用した場合、変更後の本規約に同意したものとみなします</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第13条（準拠法および管轄裁判所）</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol>
<li>本規約の解釈は、日本法に準拠するものとします</li>
<li>本サービスに関する紛争については、当スタジオの所在地を管轄する裁判所を専属的合意管轄裁判所とします</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2>第14条（お問い合わせ）</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>本規約に関するお問い合わせは、以下までご連絡ください：</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>カシスタジオ</strong><br>
メール：info@kashis-studio.example.com<br>
電話：03-1234-5678<br>
受付時間：平日 10:00～19:00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>制定日：' . date('Y年n月j日') . '</em></p>
<!-- /wp:paragraph -->';

    $page_data = array(
        'post_title'    => '利用規約',
        'post_name'     => 'terms-of-service',
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'comment_status' => 'closed',
        'ping_status'   => 'closed',
    );

    return wp_insert_post($page_data);
}

/**
 * Cookieポリシーページを作成
 */
function kashis_studio_create_cookie_policy(): int|bool {
    // 既存ページをチェック
    $existing = get_page_by_path('cookie-policy');
    if ($existing) {
        return $existing->ID;
    }

    $content = '<!-- wp:heading -->
<h2>Cookieポリシーについて</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>カシスタジオ（以下「当スタジオ」）のウェブサイトでは、サービスの利便性向上およびお客様の利用状況の把握のため、Cookieを使用しています。本ポリシーでは、Cookieの使用目的や管理方法について説明します。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Cookieとは</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cookieとは、ウェブサイトを訪問した際に、お客様のコンピュータやスマートフォン、タブレットなどのデバイスに保存される小さなテキストファイルです。Cookieには、ウェブサイトの設定情報や閲覧履歴などが記録され、次回訪問時にその情報を読み取ることで、より快適にウェブサイトをご利用いただけます。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Cookieの使用目的</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオでは、以下の目的でCookieを使用しています：</p>
<!-- /wp:paragraph -->

<!-- wp:list {"ordered":true} -->
<ol>
<li><strong>ウェブサイトの機能提供</strong>
<ul>
<li>お気に入り機能の保存</li>
<li>スタジオルーム比較機能の保存</li>
<li>検索条件の記憶</li>
<li>ログイン状態の維持</li>
</ul>
</li>
<li><strong>ウェブサイトの改善</strong>
<ul>
<li>アクセス解析による利用状況の把握</li>
<li>ページの表示速度の改善</li>
<li>ユーザー体験の向上</li>
</ul>
</li>
<li><strong>パーソナライゼーション</strong>
<ul>
<li>お客様の興味・関心に合わせた情報提供</li>
<li>カスタマイズされたコンテンツの表示</li>
</ul>
</li>
</ol>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>使用するCookieの種類</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオのウェブサイトでは、以下の種類のCookieを使用しています：</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>1. 必須Cookie（ファーストパーティCookie）</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ウェブサイトの基本的な機能を提供するために必要なCookieです。これらのCookieがないと、一部の機能が正常に動作しない場合があります。</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>セッション管理Cookie</li>
<li>セキュリティCookie</li>
<li>お気に入り・比較機能のCookie（kashis_favorites、kashis_comparison）</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":4} -->
<h4>2. 分析・パフォーマンスCookie</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ウェブサイトの利用状況を分析し、サービス向上に役立てるためのCookieです。</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>Google Analytics</strong>：アクセス解析ツール（_ga、_gid、_gat）
<ul>
<li>訪問者数、ページビュー、滞在時間などを匿名で収集</li>
<li>保存期間：最大2年</li>
<li>詳細：<a href="https://policies.google.com/privacy?hl=ja" target="_blank" rel="noopener">Googleプライバシーポリシー</a></li>
</ul>
</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":4} -->
<h4>3. 機能Cookie</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ウェブサイトの機能を拡張し、より快適にご利用いただくためのCookieです。</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li>言語設定の記憶</li>
<li>カラーテーマの保存</li>
<li>フォーム入力内容の一時保存</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":4} -->
<h4>4. ターゲティング・広告Cookie（サードパーティCookie）</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>現在、当スタジオでは広告目的のCookieは使用していません。将来的に使用する場合は、本ポリシーを更新してお知らせします。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Cookieの有効期限</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cookieには、以下の2種類の有効期限があります：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>セッションCookie</strong>：ブラウザを閉じると自動的に削除される一時的なCookie</li>
<li><strong>永続Cookie</strong>：指定された期間（最大2年）デバイスに保存されるCookie</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>Cookieの管理方法</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>お客様は、ブラウザの設定により、Cookieの受け入れを拒否したり、保存されているCookieを削除することができます。ただし、Cookieを無効にすると、当ウェブサイトの一部機能が利用できなくなる場合があります。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>主要ブラウザでのCookie設定方法</h4>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Google Chrome</strong>：設定 → プライバシーとセキュリティ → Cookie と他のサイトデータ</li>
<li><strong>Safari</strong>：環境設定 → プライバシー → Cookie とウェブサイトのデータ</li>
<li><strong>Firefox</strong>：設定 → プライバシーとセキュリティ → Cookie とサイトデータ</li>
<li><strong>Microsoft Edge</strong>：設定 → プライバシー、検索、サービス → Cookie とサイトのアクセス許可</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":4} -->
<h4>Google Analyticsのオプトアウト</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Google Analyticsによる情報収集を無効にしたい場合は、Googleが提供する<a href="https://tools.google.com/dlpage/gaoptout?hl=ja" target="_blank" rel="noopener">オプトアウトアドオン</a>をブラウザにインストールしてください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>お気に入り・比較機能のCookieについて</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当ウェブサイトの「お気に入り」および「比較」機能では、以下のCookieを使用します：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>kashis_favorites</strong>：お気に入りに追加したスタジオルームのIDを保存</li>
<li><strong>kashis_comparison</strong>：比較リストに追加したスタジオルーム（最大3件）のIDを保存</li>
<li>保存期間：30日間</li>
<li>これらのCookieには個人を特定できる情報は含まれません</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":3} -->
<h3>第三者サービスのCookie</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当ウェブサイトでは、以下の第三者サービスを利用しており、これらのサービスがCookieを設定する場合があります：</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>Google Analytics</strong>：<a href="https://policies.google.com/privacy?hl=ja" target="_blank" rel="noopener">プライバシーポリシー</a></li>
<li><strong>Google Fonts</strong>：<a href="https://policies.google.com/privacy?hl=ja" target="_blank" rel="noopener">プライバシーポリシー</a></li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>これらの第三者サービスのCookieについては、各サービスのプライバシーポリシーをご確認ください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Cookie使用の同意</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当ウェブサイトを継続してご利用いただくことで、本Cookieポリシーに同意したものとみなします。Cookie使用に同意されない場合は、ブラウザの設定でCookieを無効にしてください。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>本ポリシーの変更</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>当スタジオは、法令の変更やサービス内容の変更等により、本Cookieポリシーを予告なく変更することがあります。変更後のCookieポリシーは、当ウェブサイトに掲載した時点から効力を生じるものとします。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>お問い合わせ</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Cookieの使用に関するご質問やご不明な点がございましたら、以下までお問い合わせください：</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>カシスタジオ</strong><br>
メール：info@kashis-studio.example.com<br>
電話：03-1234-5678<br>
受付時間：平日 10:00～19:00</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><em>最終更新日：' . date('Y年n月j日') . '</em></p>
<!-- /wp:paragraph -->';

    $page_data = array(
        'post_title'    => 'Cookieポリシー',
        'post_name'     => 'cookie-policy',
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
        'comment_status' => 'closed',
        'ping_status'   => 'closed',
    );

    return wp_insert_post($page_data);
}

/**
 * 管理画面に法的ページ作成ボタンを追加
 */
function kashis_studio_add_legal_pages_admin_notice(): void {
    $legal_pages = get_option('kashis_studio_legal_pages', false);

    if (!$legal_pages) {
        ?>
        <div class="notice notice-info is-dismissible">
            <p><strong>カシスタジオ：</strong>法的ページ（プライバシーポリシー、特商法、利用規約、Cookie）を作成できます。</p>
            <p>
                <a href="<?php echo esc_url(admin_url('themes.php?page=kashis-studio-settings&action=create_legal_pages')); ?>" class="button button-primary">
                    法的ページを作成する
                </a>
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'kashis_studio_add_legal_pages_admin_notice');

/**
 * 法的ページ作成アクションを処理
 */
function kashis_studio_handle_legal_pages_creation(): void {
    if (!isset($_GET['action']) || $_GET['action'] !== 'create_legal_pages') {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('権限がありません');
    }

    $result = kashis_studio_create_legal_pages();

    if ($result) {
        add_settings_error(
            'kashis_studio_messages',
            'legal_pages_created',
            '法的ページが正常に作成されました。',
            'updated'
        );
    } else {
        add_settings_error(
            'kashis_studio_messages',
            'legal_pages_error',
            '法的ページの作成に失敗しました。',
            'error'
        );
    }

    set_transient('settings_errors', get_settings_errors(), 30);

    $redirect = add_query_arg('settings-updated', 'true', admin_url('themes.php?page=kashis-studio-settings'));
    wp_safe_redirect($redirect);
    exit;
}
add_action('admin_init', 'kashis_studio_handle_legal_pages_creation');