<?php
/**
 * Timeline/History Block
 *
 * A vertical timeline block for displaying studio history or process steps.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the Timeline block
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_timeline_block(): void {
    register_block_type('kashis-studio/timeline', array(
        'attributes' => array(
            'items' => array(
                'type' => 'string',
                'default' => json_encode(array(
                    array(
                        'year' => '2020',
                        'title' => 'スタジオ開設',
                        'description' => '渋谷に最初のスタジオをオープン',
                    ),
                    array(
                        'year' => '2021',
                        'title' => '2号店オープン',
                        'description' => '新宿に2号店を開設',
                    ),
                    array(
                        'year' => '2022',
                        'title' => 'リニューアル',
                        'description' => '最新設備を導入し全面リニューアル',
                    ),
                    array(
                        'year' => '2023',
                        'title' => '3号店オープン',
                        'description' => '池袋に3号店を開設',
                    ),
                )),
            ),
        ),
        'render_callback' => 'kashis_studio_render_timeline_block',
    ));
}

/**
 * Render the Timeline block
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_timeline_block(array $attributes): string {
    $items_json = isset($attributes['items']) ? $attributes['items'] : '';
    $items = json_decode($items_json, true);

    if (empty($items) || !is_array($items)) {
        return '<div class="kashis-timeline-empty">タイムライン項目を設定してください。</div>';
    }

    ob_start();
    ?>
    <div class="kashis-timeline-block">
        <div class="kashis-timeline">
            <?php foreach ($items as $index => $item): ?>
                <div class="kashis-timeline-item" data-animate="fade-left" data-animate-delay="<?php echo ($index * 100); ?>">
                    <div class="kashis-timeline-marker">
                        <div class="kashis-timeline-dot"></div>
                    </div>
                    <div class="kashis-timeline-content">
                        <div class="kashis-timeline-year"><?php echo esc_html($item['year']); ?></div>
                        <h3 class="kashis-timeline-title"><?php echo esc_html($item['title']); ?></h3>
                        <p class="kashis-timeline-description"><?php echo esc_html($item['description']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .kashis-timeline-block {
            margin: 3rem 0;
            max-width: 800px;
        }

        .kashis-timeline {
            position: relative;
            padding-left: 2rem;
        }

        .kashis-timeline::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(180deg, #0052CC 0%, #DEEBFF 100%);
        }

        .kashis-timeline-item {
            position: relative;
            padding-bottom: 2.5rem;
        }

        .kashis-timeline-item:last-child {
            padding-bottom: 0;
        }

        .kashis-timeline-marker {
            position: absolute;
            left: -2rem;
            top: 0;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kashis-timeline-dot {
            width: 16px;
            height: 16px;
            background: #0052CC;
            border: 3px solid #FFFFFF;
            border-radius: 50%;
            box-shadow: 0 0 0 4px #DEEBFF;
            transition: transform 200ms ease;
        }

        .kashis-timeline-item:hover .kashis-timeline-dot {
            transform: scale(1.3);
        }

        .kashis-timeline-content {
            background: #FFFFFF;
            border: 2px solid #DFE1E6;
            border-radius: 8px;
            padding: 1.5rem;
            transition: border-color 200ms ease, box-shadow 200ms ease;
        }

        .kashis-timeline-item:hover .kashis-timeline-content {
            border-color: #0052CC;
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.1);
        }

        .kashis-timeline-year {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #0052CC;
            color: #FFFFFF;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
        }

        .kashis-timeline-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #091E42;
            margin: 0 0 0.5rem 0;
        }

        .kashis-timeline-description {
            font-size: 0.9375rem;
            color: #42526E;
            line-height: 1.6;
            margin: 0;
        }

        .kashis-timeline-empty {
            text-align: center;
            padding: 3rem;
            background: #F4F5F7;
            border-radius: 8px;
            color: #5E6C84;
        }

        @media (max-width: 768px) {
            .kashis-timeline {
                padding-left: 1.5rem;
            }

            .kashis-timeline-marker {
                left: -1.5rem;
            }
        }
    </style>
    <?php
    return ob_get_clean();
}
