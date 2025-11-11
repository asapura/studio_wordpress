<?php
/**
 * Title: スタジオルームカード
 * Slug: kashis-studio/studio-room-cards
 * Categories: kashis-studio
 * Description: スタジオルームを紹介するカードグリッド
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
    <h2 class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50);font-size:2.5rem;font-weight:800">スタジオルーム</h2>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"border":{"radius":"12px"}},"backgroundColor":"contrast","className":"card","layout":{"type":"constrained"}} -->
            <div class="wp-block-group card has-contrast-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"top":"12px","right":"12px"}}}} -->
                <figure class="wp-block-image size-large has-custom-border">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/studio-a-placeholder.jpg" alt="Aスタジオ" style="border-top-left-radius:12px;border-top-right-radius:12px"/>
                </figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"}}} -->
                    <h3 style="font-size:1.5rem;font-weight:700">Aスタジオ</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
                    <p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">広々とした40㎡のメインスタジオ。ダンスレッスン、ヨガ、ワークショップに最適です。</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"}}}},"textColor":"contrast-2"} -->
                    <p class="has-contrast-2-color has-text-color has-link-color" style="font-size:0.875rem">📐 40㎡ | 👥 最大20名 | 💰 ¥3,000/時間</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"width":100} -->
                        <div class="wp-block-button has-custom-width wp-block-button__width-100">
                            <a class="wp-block-button__link wp-element-button">詳細を見る</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"border":{"radius":"12px"}},"backgroundColor":"contrast","className":"card","layout":{"type":"constrained"}} -->
            <div class="wp-block-group card has-contrast-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"top":"12px","right":"12px"}}}} -->
                <figure class="wp-block-image size-large has-custom-border">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/studio-b-placeholder.jpg" alt="Bスタジオ" style="border-top-left-radius:12px;border-top-right-radius:12px"/>
                </figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"}}} -->
                    <h3 style="font-size:1.5rem;font-weight:700">Bスタジオ</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
                    <p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">コンパクトな20㎡の個人練習向けスタジオ。パーソナルレッスンや少人数での利用に。</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"}}}},"textColor":"contrast-2"} -->
                    <p class="has-contrast-2-color has-text-color has-link-color" style="font-size:0.875rem">📐 20㎡ | 👥 最大8名 | 💰 ¥1,800/時間</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"width":100} -->
                        <div class="wp-block-button has-custom-width wp-block-button__width-100">
                            <a class="wp-block-button__link wp-element-button">詳細を見る</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"border":{"radius":"12px"}},"backgroundColor":"contrast","className":"card","layout":{"type":"constrained"}} -->
            <div class="wp-block-group card has-contrast-background-color has-background" style="border-radius:12px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">

                <!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"top":"12px","right":"12px"}}}} -->
                <figure class="wp-block-image size-large has-custom-border">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/studio-c-placeholder.jpg" alt="Cスタジオ" style="border-top-left-radius:12px;border-top-right-radius:12px"/>
                </figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">

                    <!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"700"}}} -->
                    <h3 style="font-size:1.5rem;font-weight:700">Cスタジオ</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
                    <p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">撮影用照明完備の30㎡スタジオ。MV撮影、写真撮影、配信に最適な環境です。</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"}}}},"textColor":"contrast-2"} -->
                    <p class="has-contrast-2-color has-text-color has-link-color" style="font-size:0.875rem">📐 30㎡ | 👥 最大15名 | 💰 ¥2,500/時間</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"width":100} -->
                        <div class="wp-block-button has-custom-width wp-block-button__width-100">
                            <a class="wp-block-button__link wp-element-button">詳細を見る</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->
