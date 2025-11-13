<?php
/**
 * Custom Shortcodes
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Shortcode to embed STORES reservation system
 *
 * Outputs a reservation system embed area with configurable height.
 * Displays the reservation code from theme settings with XSS protection.
 *
 * Usage: [reservation_embed height="600px"]
 *
 * @since 1.0.6
 * @param array $atts Shortcode attributes (height)
 * @return string HTML output for reservation embed area
 */
function kashis_studio_reservation_embed($atts) {
    $atts = shortcode_atts(array(
        'height' => '600px',
    ), $atts);

    ob_start();
    ?>
    <div class="reservation-embed" style="min-height: <?php echo esc_attr($atts['height']); ?>;">
        <div class="reservation-placeholder">
            <h3>予約システム</h3>
            <p>ここにSTORES予約の埋め込みコードを設置してください。</p>
            <p>管理画面から「外観」→「ウィジェット」または「カスタマイズ」で設定できます。</p>
        </div>
        <!-- STORES予約埋め込みコードをここに配置 -->
        <?php
        // カスタムフィールドから埋め込みコードを取得
        $reservation_code = get_option('kashis_studio_reservation_code');
        if (!empty($reservation_code)) {
            // HTMLコードをサニタイズして出力（XSS対策）
            echo wp_kses_post($reservation_code);
        }
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('reservation_embed', 'kashis_studio_reservation_embed');

/**
 * Shortcode to display studio room listing with filters
 *
 * Displays a grid of studio rooms with optional category filtering and limit.
 * Uses Atlassian Design System styling for consistent appearance.
 *
 * Usage: [kashis_rooms limit="6" category="" columns="3" style="grid"]
 *
 * @since 1.0.8
 * @param array $atts Shortcode attributes (limit, category, columns, style)
 * @return string HTML output for room listing
 */
function kashis_studio_rooms_shortcode(array $atts): string {
    $atts = shortcode_atts(array(
        'limit'    => 6,
        'category' => '',
        'columns'  => 3,
        'style'    => 'grid', // grid or list
    ), $atts, 'kashis_rooms');

    $args = array(
        'post_type'      => 'studio_room',
        'posts_per_page' => intval($atts['limit']),
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    );

    // Add category filter if specified
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'room_category',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($atts['category']),
            ),
        );
    }

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<p class="kashis-rooms-empty">現在、表示できるスタジオルームはありません。</p>';
    }

    $columns = min(max(intval($atts['columns']), 1), 4); // Limit between 1-4
    $style = in_array($atts['style'], array('grid', 'list')) ? $atts['style'] : 'grid';

    ob_start();
    ?>
    <div class="kashis-rooms-container kashis-rooms-<?php echo esc_attr($style); ?> kashis-rooms-columns-<?php echo esc_attr($columns); ?>">
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <article class="kashis-room-card">
                <?php if (has_post_thumbnail()): ?>
                    <div class="kashis-room-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="kashis-room-content">
                    <h3 class="kashis-room-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="kashis-room-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="kashis-room-link">詳細を見る →</a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
    <style>
        .kashis-rooms-container {
            margin: 24px 0;
        }
        .kashis-rooms-grid {
            display: grid;
            gap: 24px;
        }
        .kashis-rooms-columns-2 { grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); }
        .kashis-rooms-columns-3 { grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); }
        .kashis-rooms-columns-4 { grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); }
        .kashis-rooms-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .kashis-room-card {
            background: #FFFFFF;
            border-radius: 6px;
            box-shadow: 0 4px 8px -2px rgba(9, 30, 66, 0.25), 0 0 1px rgba(9, 30, 66, 0.31);
            overflow: hidden;
            transition: box-shadow 200ms ease, transform 200ms ease;
        }
        .kashis-room-card:hover {
            box-shadow: 0 8px 16px -4px rgba(9, 30, 66, 0.25), 0 0 1px rgba(9, 30, 66, 0.31);
            transform: translateY(-2px);
        }
        .kashis-room-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .kashis-room-content {
            padding: 20px;
        }
        .kashis-room-title {
            margin: 0 0 12px 0;
            font-size: 20px;
            font-weight: 500;
        }
        .kashis-room-title a {
            color: #0052CC;
            text-decoration: none;
        }
        .kashis-room-title a:hover {
            color: #0747A6;
        }
        .kashis-room-excerpt {
            color: #5E6C84;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
        }
        .kashis-room-link {
            display: inline-block;
            color: #0052CC;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }
        .kashis-room-link:hover {
            text-decoration: underline;
        }
        .kashis-rooms-empty {
            text-align: center;
            padding: 48px 24px;
            background: #F4F5F7;
            border-radius: 3px;
            color: #5E6C84;
        }
        @media (max-width: 768px) {
            .kashis-rooms-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('kashis_rooms', 'kashis_studio_rooms_shortcode');

/**
 * Shortcode to display contact information
 *
 * Displays studio contact information (phone, email) with icons and
 * formatted layout using data from theme settings.
 *
 * Usage: [kashis_contact style="card"]
 *
 * @since 1.0.8
 * @param array $atts Shortcode attributes (style)
 * @return string HTML output for contact information
 */
function kashis_studio_contact_shortcode(array $atts): string {
    $atts = shortcode_atts(array(
        'style' => 'card', // card or inline
    ), $atts, 'kashis_contact');

    $phone = kashis_get_studio_info('phone');
    $email = kashis_get_studio_info('email');

    $style = in_array($atts['style'], array('card', 'inline')) ? $atts['style'] : 'card';

    ob_start();
    ?>
    <div class="kashis-contact kashis-contact-<?php echo esc_attr($style); ?>">
        <?php if (!empty($phone)): ?>
            <div class="kashis-contact-item">
                <span class="kashis-contact-icon">📞</span>
                <div class="kashis-contact-content">
                    <span class="kashis-contact-label">電話番号</span>
                    <a href="tel:<?php echo esc_attr(str_replace('-', '', $phone)); ?>" class="kashis-contact-value">
                        <?php echo esc_html($phone); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($email)): ?>
            <div class="kashis-contact-item">
                <span class="kashis-contact-icon">✉️</span>
                <div class="kashis-contact-content">
                    <span class="kashis-contact-label">メールアドレス</span>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="kashis-contact-value">
                        <?php echo esc_html($email); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <style>
        .kashis-contact {
            margin: 24px 0;
        }
        .kashis-contact-card {
            background: #FFFFFF;
            border: 2px solid #DFE1E6;
            border-radius: 6px;
            padding: 24px;
        }
        .kashis-contact-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }
        .kashis-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
        }
        .kashis-contact-inline .kashis-contact-item {
            margin-bottom: 0;
        }
        .kashis-contact-item:last-child {
            margin-bottom: 0;
        }
        .kashis-contact-icon {
            font-size: 24px;
            line-height: 1;
        }
        .kashis-contact-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .kashis-contact-label {
            font-size: 12px;
            color: #5E6C84;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kashis-contact-value {
            font-size: 18px;
            font-weight: 500;
            color: #0052CC;
            text-decoration: none;
        }
        .kashis-contact-value:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .kashis-contact-inline {
                flex-direction: column;
                gap: 16px;
            }
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('kashis_contact', 'kashis_studio_contact_shortcode');

/**
 * Shortcode to display business hours
 *
 * Displays studio operating hours with formatted layout using
 * data from theme settings.
 *
 * Usage: [kashis_hours style="box"]
 *
 * @since 1.0.8
 * @param array $atts Shortcode attributes (style)
 * @return string HTML output for business hours
 */
function kashis_studio_hours_shortcode(array $atts): string {
    $atts = shortcode_atts(array(
        'style' => 'box', // box or text
    ), $atts, 'kashis_hours');

    $hours = kashis_get_studio_info('hours');

    if (empty($hours)) {
        return '';
    }

    $style = in_array($atts['style'], array('box', 'text')) ? $atts['style'] : 'box';

    ob_start();
    ?>
    <div class="kashis-hours kashis-hours-<?php echo esc_attr($style); ?>">
        <div class="kashis-hours-icon">🕐</div>
        <div class="kashis-hours-content">
            <span class="kashis-hours-label">営業時間</span>
            <div class="kashis-hours-value"><?php echo esc_html($hours); ?></div>
        </div>
    </div>
    <style>
        .kashis-hours {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin: 24px 0;
        }
        .kashis-hours-box {
            background: #DEEBFF;
            border-left: 4px solid #0052CC;
            padding: 20px;
            border-radius: 3px;
        }
        .kashis-hours-text {
            padding: 12px 0;
        }
        .kashis-hours-icon {
            font-size: 28px;
            line-height: 1;
        }
        .kashis-hours-content {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .kashis-hours-label {
            font-size: 13px;
            color: #42526E;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kashis-hours-value {
            font-size: 18px;
            font-weight: 500;
            color: #091E42;
            line-height: 1.5;
            white-space: pre-line;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('kashis_hours', 'kashis_studio_hours_shortcode');

/**
 * Shortcode to display access information
 *
 * Displays studio access/location information with map-style layout
 * using data from theme settings.
 *
 * Usage: [kashis_access show_address="yes"]
 *
 * @since 1.0.8
 * @param array $atts Shortcode attributes (show_address)
 * @return string HTML output for access information
 */
function kashis_studio_access_shortcode(array $atts): string {
    $atts = shortcode_atts(array(
        'show_address' => 'yes',
    ), $atts, 'kashis_access');

    $address = kashis_get_studio_info('address');
    $access = kashis_get_studio_info('access');
    $show_address = ($atts['show_address'] === 'yes');

    if (empty($access) && (empty($address) || !$show_address)) {
        return '';
    }

    ob_start();
    ?>
    <div class="kashis-access">
        <div class="kashis-access-icon">📍</div>
        <div class="kashis-access-content">
            <span class="kashis-access-label">アクセス</span>
            <?php if ($show_address && !empty($address)): ?>
                <div class="kashis-access-address">
                    <strong>住所:</strong> <?php echo esc_html($address); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($access)): ?>
                <div class="kashis-access-directions">
                    <?php echo esc_html($access); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <style>
        .kashis-access {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin: 24px 0;
            background: #E3FCEF;
            border-left: 4px solid #00875A;
            padding: 20px;
            border-radius: 3px;
        }
        .kashis-access-icon {
            font-size: 28px;
            line-height: 1;
        }
        .kashis-access-content {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }
        .kashis-access-label {
            font-size: 13px;
            color: #42526E;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .kashis-access-address,
        .kashis-access-directions {
            font-size: 16px;
            color: #091E42;
            line-height: 1.6;
        }
        .kashis-access-address strong {
            font-weight: 600;
            color: #00875A;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('kashis_access', 'kashis_studio_access_shortcode');
