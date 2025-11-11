<?php
/**
 * Title: アクセス情報
 * Slug: kashis-studio/access-info
 * Categories: kashis-studio
 * Description: スタジオへのアクセス方法と地図
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
    <h2 class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50);font-size:2.5rem;font-weight:800">アクセス</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column {"width":"50%"} -->
        <div class="wp-block-column" style="flex-basis:50%">

            <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}},"border":{"radius":"12px"}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-base-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

                <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
                <h3 style="margin-bottom:var(--wp--preset--spacing--30)">スタジオ情報</h3>
                <!-- /wp:heading -->

                <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
                <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"/>
                <!-- /wp:separator -->

                <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--20)"><strong>📍 住所</strong><br>〒150-0001<br>東京都渋谷区神宮前1-2-3<br>カシスビル3F</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
                <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"/>
                <!-- /wp:separator -->

                <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--20)"><strong>🚃 電車でお越しの方</strong><br>JR山手線「原宿駅」徒歩5分<br>東京メトロ千代田線・副都心線「明治神宮前駅」徒歩3分</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
                <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"/>
                <!-- /wp:separator -->

                <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}}} -->
                <p style="margin-bottom:var(--wp--preset--spacing--20)"><strong>🚗 お車でお越しの方</strong><br>首都高速3号渋谷線「渋谷IC」より約10分<br>※専用駐車場はございません。近隣のコインパーキングをご利用ください。</p>
                <!-- /wp:paragraph -->

                <!-- wp:separator {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
                <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)"/>
                <!-- /wp:separator -->

                <!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"0"}}}} -->
                <p style="margin-bottom:0"><strong>⏰ 営業時間</strong><br>10:00〜22:00（年中無休）<br>※年末年始は営業時間が異なります</p>
                <!-- /wp:paragraph -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"50%"} -->
        <div class="wp-block-column" style="flex-basis:50%">

            <!-- wp:html -->
            <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600;">
                Google Map<br>（地図を埋め込んでください）
            </div>
            <!-- /wp:html -->

            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}},"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"}}}},"textColor":"contrast-2"} -->
            <p class="has-text-align-center has-contrast-2-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--30);font-size:0.875rem">※ Google Mapの埋め込みコードをHTMLブロックに貼り付けてください</p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->
