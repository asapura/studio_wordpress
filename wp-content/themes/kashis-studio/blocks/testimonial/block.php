<?php
/**
 * Testimonial/Review Block
 *
 * A block for displaying customer testimonials with ratings and photos.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the Testimonial block
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_testimonial_block(): void {
    register_block_type('kashis-studio/testimonial', array(
        'attributes' => array(
            'testimonials' => array(
                'type' => 'string',
                'default' => json_encode(array(
                    array(
                        'name' => '山田太郎',
                        'role' => 'フォトグラファー',
                        'rating' => 5,
                        'comment' => '素晴らしいスタジオです。設備も充実しており、スタッフの対応も丁寧で安心して撮影できました。',
                        'image' => '',
                    ),
                    array(
                        'name' => '佐藤花子',
                        'role' => 'YouTuber',
                        'rating' => 5,
                        'comment' => '動画撮影に最適な環境が整っています。音響設備も素晴らしく、とても満足しています。',
                        'image' => '',
                    ),
                    array(
                        'name' => '鈴木一郎',
                        'role' => 'イベントプランナー',
                        'rating' => 4,
                        'comment' => '広いスペースで様々なイベントに対応できます。アクセスも良く、利用しやすいです。',
                        'image' => '',
                    ),
                )),
            ),
            'columns' => array(
                'type' => 'number',
                'default' => 3,
            ),
        ),
        'render_callback' => 'kashis_studio_render_testimonial_block',
    ));
}

/**
 * Render the Testimonial block
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_testimonial_block(array $attributes): string {
    $testimonials_json = isset($attributes['testimonials']) ? $attributes['testimonials'] : '';
    $testimonials = json_decode($testimonials_json, true);
    $columns = isset($attributes['columns']) ? intval($attributes['columns']) : 3;

    if (empty($testimonials) || !is_array($testimonials)) {
        return '<div class="kashis-testimonial-empty">お客様の声を設定してください。</div>';
    }

    ob_start();
    ?>
    <div class="kashis-testimonial-block">
        <div class="kashis-testimonial-grid" style="--columns: <?php echo esc_attr($columns); ?>;">
            <?php foreach ($testimonials as $index => $testimonial): ?>
                <div class="kashis-testimonial-card" data-animate="fade-up" data-animate-delay="<?php echo ($index * 100); ?>">
                    <div class="kashis-testimonial-header">
                        <?php if (!empty($testimonial['image'])): ?>
                            <img src="<?php echo esc_url($testimonial['image']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>" class="kashis-testimonial-avatar">
                        <?php else: ?>
                            <div class="kashis-testimonial-avatar-placeholder">
                                <?php echo esc_html(mb_substr($testimonial['name'], 0, 1)); ?>
                            </div>
                        <?php endif; ?>
                        <div class="kashis-testimonial-info">
                            <div class="kashis-testimonial-name"><?php echo esc_html($testimonial['name']); ?></div>
                            <div class="kashis-testimonial-role"><?php echo esc_html($testimonial['role']); ?></div>
                        </div>
                    </div>

                    <div class="kashis-testimonial-rating">
                        <?php
                        $rating = isset($testimonial['rating']) ? intval($testimonial['rating']) : 5;
                        for ($i = 1; $i <= 5; $i++):
                        ?>
                            <span class="kashis-star <?php echo $i <= $rating ? 'filled' : ''; ?>">★</span>
                        <?php endfor; ?>
                    </div>

                    <div class="kashis-testimonial-comment">
                        "<?php echo esc_html($testimonial['comment']); ?>"
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style>
        .kashis-testimonial-block {
            margin: 3rem 0;
        }

        .kashis-testimonial-grid {
            display: grid;
            grid-template-columns: repeat(var(--columns, 3), 1fr);
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .kashis-testimonial-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 768px) {
            .kashis-testimonial-grid {
                grid-template-columns: 1fr !important;
            }
        }

        .kashis-testimonial-card {
            background: #FFFFFF;
            border: 2px solid #DFE1E6;
            border-radius: 8px;
            padding: 2rem;
            transition: border-color 200ms ease, box-shadow 200ms ease, transform 200ms ease;
        }

        .kashis-testimonial-card:hover {
            border-color: #0052CC;
            box-shadow: 0 8px 16px rgba(0, 82, 204, 0.1);
            transform: translateY(-4px);
        }

        .kashis-testimonial-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .kashis-testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #DEEBFF;
        }

        .kashis-testimonial-avatar-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0052CC, #2684FF);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            border: 3px solid #DEEBFF;
        }

        .kashis-testimonial-info {
            flex: 1;
        }

        .kashis-testimonial-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: #091E42;
            margin-bottom: 0.25rem;
        }

        .kashis-testimonial-role {
            font-size: 0.875rem;
            color: #5E6C84;
        }

        .kashis-testimonial-rating {
            margin-bottom: 1rem;
            display: flex;
            gap: 0.25rem;
        }

        .kashis-star {
            font-size: 1.25rem;
            color: #DFE1E6;
        }

        .kashis-star.filled {
            color: #FFAB00;
        }

        .kashis-testimonial-comment {
            font-size: 0.9375rem;
            color: #42526E;
            line-height: 1.7;
            font-style: italic;
        }

        .kashis-testimonial-empty {
            text-align: center;
            padding: 3rem;
            background: #F4F5F7;
            border-radius: 8px;
            color: #5E6C84;
        }
    </style>
    <?php
    return ob_get_clean();
}
