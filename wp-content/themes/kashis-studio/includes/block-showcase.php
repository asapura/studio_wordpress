<?php
/**
 * Block Showcase Page Generator
 *
 * Automatically generates a showcase page demonstrating all custom blocks.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Create block showcase page
 *
 * Generates a page showcasing all custom Gutenberg blocks with examples.
 *
 * @since 1.0.8
 * @return int|false Page ID on success, false on failure
 */
function kashis_studio_create_block_showcase_page() {
    // Check if page already exists
    $existing = get_page_by_path('block-showcase');
    if ($existing) {
        return $existing->ID;
    }

    $content = '<!-- wp:heading {"level":1,"textAlign":"center","fontSize":"35"} -->
<h1 class="has-text-align-center has-35-font-size">🎨 カスタムブロック ショーケース</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"neutral-500"} -->
<p class="has-text-align-center has-neutral-500-color has-text-color">カシスタジオテーマで利用可能なすべてのカスタムブロックの使用例です。</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>1. Dynamic Room List Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>スタジオルームを動的に表示するブロックです。カテゴリーフィルターとグリッドレイアウトをサポートしています。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/room-list {"postsPerPage":6,"columns":3,"showFilters":true} /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>2. Pricing Table Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>料金プランを美しく表示するブロックです。最大3つのプランを並べて比較できます。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/pricing-table /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>3. Accordion/FAQ Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>よくある質問を折りたたみ式で表示するブロックです。スムーズなアニメーションが特徴です。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/accordion /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>4. Timeline Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>会社の歴史やプロジェクトの進行状況を時系列で表示するブロックです。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/timeline /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>5. Testimonial Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>お客様の声や評価を表示するブロックです。5段階の星評価をサポートしています。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/testimonial {"columns":3} /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>6. Call-to-Action Block</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>目立つCTAセクションを作成するブロックです。4種類の背景カラーから選択できます。</p>
<!-- /wp:paragraph -->

<!-- wp:kashis-studio/cta {"backgroundColor":"blue"} /-->

<!-- wp:spacer {"height":"24px"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:kashis-studio/cta {"backgroundColor":"green","title":"グリーンスタイルのCTA","description":"成功やエコをイメージさせるグリーン系のCTAです。"} /-->

<!-- wp:spacer {"height":"48px"} -->
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2} -->
<h2>ボーナス: Block Style Variations</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>標準ブロックにも様々なスタイルバリエーションが追加されています。</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>ボタンスタイル</h3>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">プライマリー</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-secondary"} -->
<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button">セカンダリー</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-success"} -->
<div class="wp-block-button is-style-success"><a class="wp-block-button__link wp-element-button">成功</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-warning"} -->
<div class="wp-block-button is-style-warning"><a class="wp-block-button__link wp-element-button">警告</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-danger"} -->
<div class="wp-block-button is-style-danger"><a class="wp-block-button__link wp-element-button">危険</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:spacer {"height":"24px"} -->
<div style="height:24px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:heading {"level":3} -->
<h3>グループ/カードスタイル</h3>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"is-style-elevated","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-group is-style-elevated" style="padding-top:24px;padding-bottom:24px;padding-left:24px;padding-right:24px">
<!-- wp:heading {"level":4} -->
<h4>Elevated</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>シャドウ付きで浮き上がって見えるスタイル</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"is-style-bordered","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-group is-style-bordered" style="padding-top:24px;padding-bottom:24px;padding-left:24px;padding-right:24px">
<!-- wp:heading {"level":4} -->
<h4>Bordered</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>ボーダーでシンプルに囲むスタイル</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:group {"className":"is-style-flat","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-group is-style-flat" style="padding-top:24px;padding-bottom:24px;padding-left:24px;padding-right:24px">
<!-- wp:heading {"level":4} -->
<h4>Flat</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>フラットな背景色のみのスタイル</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->';

    $page_data = array(
        'post_title'   => 'ブロックショーケース',
        'post_content' => $content,
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_name'    => 'block-showcase',
    );

    $page_id = wp_insert_post($page_data);

    if (is_wp_error($page_id)) {
        error_log('Failed to create block showcase page: ' . $page_id->get_error_message());
        return false;
    }

    return $page_id;
}

/**
 * Add showcase page creation to admin menu
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_add_showcase_admin_action(): void {
    if (isset($_GET['kashis_create_showcase']) &&
        isset($_GET['_wpnonce']) &&
        wp_verify_nonce($_GET['_wpnonce'], 'create_showcase')) {

        if (current_user_can('manage_options')) {
            $page_id = kashis_studio_create_block_showcase_page();

            if ($page_id) {
                wp_safe_redirect(admin_url('post.php?post=' . $page_id . '&action=edit&showcase_created=1'));
                exit;
            }
        }
    }
}
add_action('admin_init', 'kashis_studio_add_showcase_admin_action');
