<?php
/**
 * Call-to-Action (CTA) Block
 *
 * A prominent CTA block with background options and customizable buttons.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the CTA block
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_cta_block(): void {
    register_block_type('kashis-studio/cta', array(
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => '今すぐ予約して、理想のスペースを確保しましょう',
            ),
            'description' => array(
                'type' => 'string',
                'default' => 'プロフェッショナルな設備とサポートで、あなたのクリエイティブな活動を全力でバックアップします。',
            ),
            'primaryButtonText' => array(
                'type' => 'string',
                'default' => '今すぐ予約',
            ),
            'primaryButtonUrl' => array(
                'type' => 'string',
                'default' => '#',
            ),
            'secondaryButtonText' => array(
                'type' => 'string',
                'default' => '詳しく見る',
            ),
            'secondaryButtonUrl' => array(
                'type' => 'string',
                'default' => '#',
            ),
            'showSecondaryButton' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'backgroundColor' => array(
                'type' => 'string',
                'default' => 'blue',
            ),
            'align' => array(
                'type' => 'string',
                'default' => 'center',
            ),
        ),
        'render_callback' => 'kashis_studio_render_cta_block',
    ));
}

/**
 * Render the CTA block
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_cta_block(array $attributes): string {
    $title = isset($attributes['title']) ? $attributes['title'] : '';
    $description = isset($attributes['description']) ? $attributes['description'] : '';
    $primary_text = isset($attributes['primaryButtonText']) ? $attributes['primaryButtonText'] : '';
    $primary_url = isset($attributes['primaryButtonUrl']) ? $attributes['primaryButtonUrl'] : '#';
    $secondary_text = isset($attributes['secondaryButtonText']) ? $attributes['secondaryButtonText'] : '';
    $secondary_url = isset($attributes['secondaryButtonUrl']) ? $attributes['secondaryButtonUrl'] : '#';
    $show_secondary = isset($attributes['showSecondaryButton']) ? (bool)$attributes['showSecondaryButton'] : true;
    $bg_color = isset($attributes['backgroundColor']) ? $attributes['backgroundColor'] : 'blue';
    $align = isset($attributes['align']) ? $attributes['align'] : 'center';

    $bg_classes = array(
        'blue' => 'kashis-cta-bg-blue',
        'green' => 'kashis-cta-bg-green',
        'dark' => 'kashis-cta-bg-dark',
        'light' => 'kashis-cta-bg-light',
    );

    $bg_class = isset($bg_classes[$bg_color]) ? $bg_classes[$bg_color] : $bg_classes['blue'];

    ob_start();
    ?>
    <div class="kashis-cta-block <?php echo esc_attr($bg_class); ?> kashis-cta-align-<?php echo esc_attr($align); ?>" data-animate="scale-up">
        <div class="kashis-cta-container">
            <?php if (!empty($title)): ?>
                <h2 class="kashis-cta-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($description)): ?>
                <p class="kashis-cta-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>

            <div class="kashis-cta-buttons">
                <?php if (!empty($primary_text)): ?>
                    <a href="<?php echo esc_url($primary_url); ?>" class="kashis-cta-button primary">
                        <?php echo esc_html($primary_text); ?>
                    </a>
                <?php endif; ?>

                <?php if ($show_secondary && !empty($secondary_text)): ?>
                    <a href="<?php echo esc_url($secondary_url); ?>" class="kashis-cta-button secondary">
                        <?php echo esc_html($secondary_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <style>
        .kashis-cta-block {
            margin: 3rem 0;
            padding: 4rem 2rem;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .kashis-cta-block::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            opacity: 0.95;
        }

        .kashis-cta-container {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Background Color Variations */
        .kashis-cta-bg-blue {
            background: linear-gradient(135deg, #0052CC 0%, #2684FF 100%);
            color: #FFFFFF;
        }

        .kashis-cta-bg-green {
            background: linear-gradient(135deg, #00875A 0%, #36B37E 100%);
            color: #FFFFFF;
        }

        .kashis-cta-bg-dark {
            background: linear-gradient(135deg, #091E42 0%, #172B4D 100%);
            color: #FFFFFF;
        }

        .kashis-cta-bg-light {
            background: linear-gradient(135deg, #F4F5F7 0%, #FFFFFF 100%);
            color: #091E42;
            border: 2px solid #DFE1E6;
        }

        /* Alignment */
        .kashis-cta-align-left {
            text-align: left;
        }

        .kashis-cta-align-center {
            text-align: center;
        }

        .kashis-cta-align-right {
            text-align: right;
        }

        .kashis-cta-title {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.3;
            margin: 0 0 1rem 0;
        }

        .kashis-cta-description {
            font-size: 1.125rem;
            line-height: 1.6;
            margin: 0 0 2rem 0;
            opacity: 0.95;
        }

        .kashis-cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .kashis-cta-align-center .kashis-cta-buttons {
            justify-content: center;
        }

        .kashis-cta-align-right .kashis-cta-buttons {
            justify-content: flex-end;
        }

        .kashis-cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: all 200ms ease;
            cursor: pointer;
        }

        .kashis-cta-bg-blue .kashis-cta-button.primary,
        .kashis-cta-bg-green .kashis-cta-button.primary,
        .kashis-cta-bg-dark .kashis-cta-button.primary {
            background: #FFFFFF;
            color: #0052CC !important;
        }

        .kashis-cta-bg-light .kashis-cta-button.primary {
            background: #0052CC;
            color: #FFFFFF !important;
        }

        .kashis-cta-button.primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .kashis-cta-bg-blue .kashis-cta-button.secondary,
        .kashis-cta-bg-green .kashis-cta-button.secondary,
        .kashis-cta-bg-dark .kashis-cta-button.secondary {
            background: transparent;
            color: #FFFFFF !important;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .kashis-cta-bg-light .kashis-cta-button.secondary {
            background: transparent;
            color: #0052CC !important;
            border: 2px solid #0052CC;
        }

        .kashis-cta-button.secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-3px);
        }

        .kashis-cta-bg-light .kashis-cta-button.secondary:hover {
            background: #DEEBFF;
        }

        @media (max-width: 768px) {
            .kashis-cta-block {
                padding: 3rem 1.5rem;
            }

            .kashis-cta-title {
                font-size: 1.5rem;
            }

            .kashis-cta-description {
                font-size: 1rem;
            }

            .kashis-cta-buttons {
                flex-direction: column;
            }

            .kashis-cta-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <?php
    return ob_get_clean();
}
