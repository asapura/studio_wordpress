<?php
/**
 * Title: Room Showcase
 * Slug: kashis-studio/room-showcase
 * Categories: kashis-studio
 * Description: Featured room showcase with filters
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--60)">

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:heading {"level":2,"fontSize":"x-large"} -->
            <h2 class="wp-block-heading has-x-large-font-size">スタジオルーム一覧</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>多様なニーズに対応する充実のラインナップ</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">
            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"className":"is-style-subtle"} -->
                <div class="wp-block-button is-style-subtle"><a class="wp-block-button__link wp-element-button">すべて表示</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

    <!-- wp:kashis-studio/room-list {"postsPerPage":9,"columns":3,"showFilters":true} /-->

</div>
<!-- /wp:group -->
