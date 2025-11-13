<?php
/**
 * Pricing Table Block
 *
 * A customizable pricing table block for displaying pricing plans
 * with features and CTA buttons.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the Pricing Table block
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_pricing_table_block(): void {
    register_block_type('kashis-studio/pricing-table', array(
        'attributes' => array(
            'plans' => array(
                'type' => 'string',
                'default' => json_encode(array(
                    array(
                        'name' => 'ベーシック',
                        'price' => '¥5,000',
                        'period' => '/ 1時間',
                        'features' => array('20㎡のスペース', '基本照明', 'Wi-Fi完備'),
                        'buttonText' => '予約する',
                        'buttonUrl' => '#',
                        'featured' => false,
                    ),
                    array(
                        'name' => 'スタンダード',
                        'price' => '¥8,000',
                        'period' => '/ 1時間',
                        'features' => array('40㎡のスペース', 'プロ照明', 'Wi-Fi完備', '音響設備'),
                        'buttonText' => '予約する',
                        'buttonUrl' => '#',
                        'featured' => true,
                    ),
                    array(
                        'name' => 'プレミアム',
                        'price' => '¥12,000',
                        'period' => '/ 1時間',
                        'features' => array('60㎡のスペース', 'プロ照明・音響', 'Wi-Fi完備', '撮影機材', 'スタッフサポート'),
                        'buttonText' => '予約する',
                        'buttonUrl' => '#',
                        'featured' => false,
                    ),
                )),
            ),
        ),
        'render_callback' => 'kashis_studio_render_pricing_table_block',
    ));
}

/**
 * Render the Pricing Table block
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_pricing_table_block(array $attributes): string {
    $plans_json = isset($attributes['plans']) ? $attributes['plans'] : '';
    $plans = json_decode($plans_json, true);

    if (empty($plans) || !is_array($plans)) {
        return '<div class="kashis-pricing-empty">料金プランを設定してください。</div>';
    }

    ob_start();
    ?>
    <div class="kashis-pricing-table">
        <div class="kashis-pricing-grid">
            <?php foreach ($plans as $index => $plan): ?>
                <?php
                $featured = isset($plan['featured']) && $plan['featured'];
                ?>
                <div class="kashis-pricing-plan <?php echo $featured ? 'featured' : ''; ?>" data-animate="scale-up" data-animate-delay="<?php echo ($index * 100); ?>">
                    <?php if ($featured): ?>
                        <div class="kashis-plan-badge">おすすめ</div>
                    <?php endif; ?>

                    <div class="kashis-plan-header">
                        <h3 class="kashis-plan-name"><?php echo esc_html($plan['name']); ?></h3>
                        <div class="kashis-plan-price">
                            <span class="kashis-price-amount"><?php echo esc_html($plan['price']); ?></span>
                            <span class="kashis-price-period"><?php echo esc_html($plan['period']); ?></span>
                        </div>
                    </div>

                    <div class="kashis-plan-features">
                        <ul>
                            <?php foreach ($plan['features'] as $feature): ?>
                                <li>✓ <?php echo esc_html($feature); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="kashis-plan-footer">
                        <a href="<?php echo esc_url($plan['buttonUrl']); ?>" class="kashis-plan-button <?php echo $featured ? 'featured' : ''; ?>">
                            <?php echo esc_html($plan['buttonText']); ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .kashis-pricing-table {
            margin: 3rem 0;
        }

        .kashis-pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .kashis-pricing-plan {
            background: #FFFFFF;
            border: 2px solid #DFE1E6;
            border-radius: 8px;
            padding: 2rem;
            position: relative;
            transition: transform 200ms ease, box-shadow 200ms ease, border-color 200ms ease;
        }

        .kashis-pricing-plan:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px -4px rgba(9, 30, 66, 0.25);
            border-color: #0052CC;
        }

        .kashis-pricing-plan.featured {
            border-color: #0052CC;
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.15);
        }

        .kashis-plan-badge {
            position: absolute;
            top: -12px;
            right: 1.5rem;
            background: linear-gradient(135deg, #0052CC, #0747A6);
            color: #FFFFFF;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .kashis-plan-header {
            text-align: center;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #F4F5F7;
            margin-bottom: 1.5rem;
        }

        .kashis-plan-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #091E42;
            margin: 0 0 1rem 0;
        }

        .kashis-plan-price {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 0.25rem;
        }

        .kashis-price-amount {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0052CC;
        }

        .kashis-price-period {
            font-size: 1rem;
            color: #5E6C84;
        }

        .kashis-plan-features {
            margin-bottom: 2rem;
        }

        .kashis-plan-features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .kashis-plan-features li {
            padding: 0.75rem 0;
            color: #42526E;
            font-size: 0.9375rem;
            line-height: 1.6;
            border-bottom: 1px solid #F4F5F7;
        }

        .kashis-plan-features li:last-child {
            border-bottom: none;
        }

        .kashis-plan-footer {
            text-align: center;
        }

        .kashis-plan-button {
            display: inline-block;
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: #F4F5F7;
            color: #0052CC !important;
            text-decoration: none !important;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            transition: all 150ms ease;
        }

        .kashis-plan-button:hover {
            background: #DEEBFF;
            transform: translateY(-2px);
        }

        .kashis-plan-button.featured {
            background: #0052CC;
            color: #FFFFFF !important;
        }

        .kashis-plan-button.featured:hover {
            background: #0747A6;
        }

        .kashis-pricing-empty {
            text-align: center;
            padding: 3rem;
            background: #F4F5F7;
            border-radius: 8px;
            color: #5E6C84;
        }

        @media (max-width: 768px) {
            .kashis-pricing-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <?php
    return ob_get_clean();
}
