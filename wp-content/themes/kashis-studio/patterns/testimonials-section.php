<?php
/**
 * Title: Testimonials Section
 * Slug: kashis-studio/testimonials-section
 * Categories: kashis-studio
 * Description: Customer testimonials section with reviews and ratings
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)">

    <!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xx-large"} -->
    <h2 class="wp-block-heading has-text-align-center has-xx-large-font-size">お客様の声</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}}} -->
    <p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--60)">
        実際にご利用いただいたお客様からの評価をご覧ください
    </p>
    <!-- /wp:paragraph -->

    <!-- wp:kashis-studio/testimonial {"columns":3} /-->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
    <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60)">
        <!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">すべてのレビューを見る</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

</div>
<!-- /wp:group -->
