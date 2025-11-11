<?php
/**
 * Title: 料金表
 * Slug: kashis-studio/pricing-table
 * Categories: kashis-studio
 * Description: スタジオの料金プランを表示
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

    <!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}},"typography":{"fontSize":"2.5rem","fontWeight":"800"}}} -->
    <h2 class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50);font-size:2.5rem;font-weight:800">料金プラン</h2>
    <!-- /wp:heading -->

    <!-- wp:table {"hasFixedLayout":false,"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
    <figure class="wp-block-table" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)">
        <table>
            <thead>
                <tr>
                    <th>スタジオ</th>
                    <th>広さ</th>
                    <th>定員</th>
                    <th class="has-text-align-right" data-align="right">1時間</th>
                    <th class="has-text-align-right" data-align="right">3時間パック</th>
                    <th class="has-text-align-right" data-align="right">1日パック</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Aスタジオ</strong></td>
                    <td>40㎡</td>
                    <td>20名</td>
                    <td class="has-text-align-right" data-align="right">¥3,000</td>
                    <td class="has-text-align-right" data-align="right">¥8,000</td>
                    <td class="has-text-align-right" data-align="right">¥18,000</td>
                </tr>
                <tr>
                    <td><strong>Bスタジオ</strong></td>
                    <td>20㎡</td>
                    <td>8名</td>
                    <td class="has-text-align-right" data-align="right">¥1,800</td>
                    <td class="has-text-align-right" data-align="right">¥4,800</td>
                    <td class="has-text-align-right" data-align="right">¥10,000</td>
                </tr>
                <tr>
                    <td><strong>Cスタジオ</strong></td>
                    <td>30㎡</td>
                    <td>15名</td>
                    <td class="has-text-align-right" data-align="right">¥2,500</td>
                    <td class="has-text-align-right" data-align="right">¥6,800</td>
                    <td class="has-text-align-right" data-align="right">¥15,000</td>
                </tr>
            </tbody>
        </table>
    </figure>
    <!-- /wp:table -->

    <!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|30"}}}} -->
    <h3 style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--30)">オプション料金</h3>
    <!-- /wp:heading -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
    <div class="wp-block-columns">

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:list -->
            <ul>
                <li><strong>音響機材レンタル:</strong> ¥1,000/回</li>
                <li><strong>照明機材レンタル:</strong> ¥1,500/回</li>
                <li><strong>プロジェクターレンタル:</strong> ¥2,000/回</li>
            </ul>
            <!-- /wp:list -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:list -->
            <ul>
                <li><strong>鏡追加:</strong> ¥500/枚</li>
                <li><strong>延長料金:</strong> 通常料金の1.2倍</li>
                <li><strong>早朝・深夜:</strong> 通常料金の1.3倍</li>
            </ul>
            <!-- /wp:list -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}},"typography":{"fontSize":"0.875rem"},"elements":{"link":{"color":{"text":"var:preset|color|contrast-2"}}}},"textColor":"contrast-2"} -->
    <p class="has-text-align-center has-contrast-2-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--50);font-size:0.875rem">※ 価格は全て税込表示です。学生割引・団体割引もご用意しております。詳しくはお問い合わせください。</p>
    <!-- /wp:paragraph -->

</div>
<!-- /wp:group -->
