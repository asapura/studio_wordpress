<?php
/**
 * Title: ヒーローセクション
 * Slug: kashis-studio/hero-section
 * Categories: kashis-studio
 * Description: トップページのメインビジュアルセクション
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/hero-placeholder.jpg","dimRatio":50,"overlayColor":"primary","gradient":"vivid-cyan-blue-to-vivid-purple","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}}} -->
<div class="wp-block-cover alignfull">
    <span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim has-background-gradient has-vivid-cyan-blue-to-vivid-purple-gradient-background"></span>
    <div class="wp-block-cover__inner-container">

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3.5rem","fontWeight":"800"},"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
        <h1 class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40);font-size:3.5rem;font-weight:800">カシスタジオ</h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.375rem"},"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
        <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50);font-size:1.375rem">都心で気軽に使える本格レンタルスタジオ<br>ダンス・ヨガ・演劇・撮影まで幅広く対応</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"className":"is-style-fill"} -->
            <div class="wp-block-button is-style-fill">
                <a class="wp-block-button__link wp-element-button">今すぐ予約</a>
            </div>
            <!-- /wp:button -->

            <!-- wp:button {"className":"is-style-outline"} -->
            <div class="wp-block-button is-style-outline">
                <a class="wp-block-button__link wp-element-button">スタジオを見る</a>
            </div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->

    </div>
</div>
<!-- /wp:cover -->
