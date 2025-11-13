<?php
/**
 * Accordion/FAQ Block
 *
 * A collapsible accordion block for FAQs and Q&A sections.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the Accordion block
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_accordion_block(): void {
    register_block_type('kashis-studio/accordion', array(
        'attributes' => array(
            'items' => array(
                'type' => 'string',
                'default' => json_encode(array(
                    array(
                        'question' => 'スタジオの予約はどのようにすれば良いですか？',
                        'answer' => 'オンライン予約システムまたはお電話にて承っております。空き状況はリアルタイムで確認できます。',
                    ),
                    array(
                        'question' => '機材のレンタルは可能ですか？',
                        'answer' => '照明、音響、撮影機材など各種レンタルを行っております。詳しくは料金表をご確認ください。',
                    ),
                    array(
                        'question' => 'キャンセル料は発生しますか？',
                        'answer' => '予約日の3日前までは無料でキャンセル可能です。それ以降は料金の50%をキャンセル料として頂戴いたします。',
                    ),
                )),
            ),
            'allowMultiple' => array(
                'type' => 'boolean',
                'default' => false,
            ),
        ),
        'render_callback' => 'kashis_studio_render_accordion_block',
    ));
}

/**
 * Render the Accordion block
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_accordion_block(array $attributes): string {
    $items_json = isset($attributes['items']) ? $attributes['items'] : '';
    $items = json_decode($items_json, true);
    $allow_multiple = isset($attributes['allowMultiple']) ? (bool)$attributes['allowMultiple'] : false;

    if (empty($items) || !is_array($items)) {
        return '<div class="kashis-accordion-empty">アコーディオン項目を設定してください。</div>';
    }

    $unique_id = 'accordion-' . uniqid();

    ob_start();
    ?>
    <div class="kashis-accordion-block" data-block-id="<?php echo esc_attr($unique_id); ?>" data-allow-multiple="<?php echo $allow_multiple ? 'true' : 'false'; ?>">
        <?php foreach ($items as $index => $item): ?>
            <div class="kashis-accordion-item" data-animate="fade-up" data-animate-delay="<?php echo ($index * 100); ?>">
                <button class="kashis-accordion-header" aria-expanded="false">
                    <span class="kashis-accordion-question"><?php echo esc_html($item['question']); ?></span>
                    <span class="kashis-accordion-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="kashis-accordion-content">
                    <div class="kashis-accordion-answer">
                        <?php echo wp_kses_post(wpautop($item['answer'])); ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <style>
        .kashis-accordion-block {
            margin: 2rem 0;
            max-width: 800px;
        }

        .kashis-accordion-item {
            background: #FFFFFF;
            border: 2px solid #DFE1E6;
            border-radius: 6px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: border-color 150ms ease;
        }

        .kashis-accordion-item:hover {
            border-color: #0052CC;
        }

        .kashis-accordion-item.active {
            border-color: #0052CC;
            box-shadow: 0 2px 8px rgba(0, 82, 204, 0.1);
        }

        .kashis-accordion-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            font-size: 1rem;
            font-weight: 600;
            color: #091E42;
            transition: background-color 150ms ease;
        }

        .kashis-accordion-header:hover {
            background: #F4F5F7;
        }

        .kashis-accordion-question {
            flex: 1;
            padding-right: 1rem;
        }

        .kashis-accordion-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0052CC;
            transition: transform 200ms ease;
        }

        .kashis-accordion-item.active .kashis-accordion-icon {
            transform: rotate(180deg);
        }

        .kashis-accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 300ms ease;
        }

        .kashis-accordion-item.active .kashis-accordion-content {
            max-height: 1000px;
        }

        .kashis-accordion-answer {
            padding: 0 1.5rem 1.5rem 1.5rem;
            color: #42526E;
            font-size: 0.9375rem;
            line-height: 1.6;
        }

        .kashis-accordion-answer p {
            margin: 0 0 0.5rem 0;
        }

        .kashis-accordion-answer p:last-child {
            margin-bottom: 0;
        }

        .kashis-accordion-empty {
            text-align: center;
            padding: 3rem;
            background: #F4F5F7;
            border-radius: 6px;
            color: #5E6C84;
        }
    </style>

    <script>
    (function() {
        const blockId = '<?php echo esc_js($unique_id); ?>';
        const block = document.querySelector('[data-block-id="' + blockId + '"]');
        if (!block) return;

        const allowMultiple = block.getAttribute('data-allow-multiple') === 'true';
        const items = block.querySelectorAll('.kashis-accordion-item');

        items.forEach(item => {
            const header = item.querySelector('.kashis-accordion-header');
            if (!header) return;

            header.addEventListener('click', function() {
                const isActive = item.classList.contains('active');

                // Close all items if allowMultiple is false
                if (!allowMultiple && !isActive) {
                    items.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.kashis-accordion-header').setAttribute('aria-expanded', 'false');
                    });
                }

                // Toggle current item
                if (isActive) {
                    item.classList.remove('active');
                    header.setAttribute('aria-expanded', 'false');
                } else {
                    item.classList.add('active');
                    header.setAttribute('aria-expanded', 'true');
                }
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}
