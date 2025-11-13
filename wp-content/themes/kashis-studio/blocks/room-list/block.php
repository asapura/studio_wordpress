<?php
/**
 * Dynamic Studio Room List Block
 *
 * A filterable, dynamic block that displays studio rooms with
 * category filtering and layout options.
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the Room List block
 *
 * Registers a dynamic block for displaying studio rooms with
 * filtering capabilities and customizable layouts.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_room_list_block(): void {
    register_block_type('kashis-studio/room-list', array(
        'attributes' => array(
            'postsPerPage' => array(
                'type' => 'number',
                'default' => 6,
            ),
            'columns' => array(
                'type' => 'number',
                'default' => 3,
            ),
            'category' => array(
                'type' => 'string',
                'default' => '',
            ),
            'showExcerpt' => array(
                'type' => 'boolean',
                'default' => true,
            ),
            'showFilters' => array(
                'type' => 'boolean',
                'default' => false,
            ),
        ),
        'render_callback' => 'kashis_studio_render_room_list_block',
    ));
}

/**
 * Render the Room List block
 *
 * Outputs the HTML for the dynamic room list with optional filtering.
 *
 * @since 1.0.8
 * @param array $attributes Block attributes
 * @return string HTML output
 */
function kashis_studio_render_room_list_block(array $attributes): string {
    $posts_per_page = isset($attributes['postsPerPage']) ? intval($attributes['postsPerPage']) : 6;
    $columns = isset($attributes['columns']) ? intval($attributes['columns']) : 3;
    $category = isset($attributes['category']) ? sanitize_text_field($attributes['category']) : '';
    $show_excerpt = isset($attributes['showExcerpt']) ? (bool)$attributes['showExcerpt'] : true;
    $show_filters = isset($attributes['showFilters']) ? (bool)$attributes['showFilters'] : false;

    // Build query args
    $args = array(
        'post_type' => 'studio_room',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'room_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if (!$query->have_posts()) {
        return '<div class="kashis-room-list-empty">現在、表示できるスタジオルームはありません。</div>';
    }

    $unique_id = 'room-list-' . uniqid();

    ob_start();
    ?>
    <div class="kashis-room-list-block" data-block-id="<?php echo esc_attr($unique_id); ?>">
        <?php if ($show_filters): ?>
            <div class="kashis-room-filters">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'room_category',
                    'hide_empty' => true,
                ));
                if (!empty($categories) && !is_wp_error($categories)):
                ?>
                    <button class="kashis-filter-btn active" data-category="">すべて</button>
                    <?php foreach ($categories as $cat): ?>
                        <button class="kashis-filter-btn" data-category="<?php echo esc_attr($cat->slug); ?>">
                            <?php echo esc_html($cat->name); ?>
                        </button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="kashis-room-grid" style="--columns: <?php echo esc_attr($columns); ?>;">
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <article class="kashis-room-item" data-animate="fade-up">
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

                        <?php if ($show_excerpt): ?>
                            <div class="kashis-room-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" class="kashis-room-button">
                            詳細を見る →
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </div>

    <style>
        .kashis-room-list-block {
            margin: 2rem 0;
        }

        .kashis-room-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .kashis-filter-btn {
            padding: 0.5rem 1rem;
            background: #F4F5F7;
            border: 2px solid transparent;
            border-radius: 3px;
            color: #42526E;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 150ms ease;
        }

        .kashis-filter-btn:hover {
            background: #DEEBFF;
            color: #0052CC;
        }

        .kashis-filter-btn.active {
            background: #0052CC;
            color: #FFFFFF;
            border-color: #0052CC;
        }

        .kashis-room-grid {
            display: grid;
            grid-template-columns: repeat(var(--columns, 3), 1fr);
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .kashis-room-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }
        }

        @media (max-width: 768px) {
            .kashis-room-grid {
                grid-template-columns: 1fr !important;
            }
        }

        .kashis-room-item {
            background: #FFFFFF;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 4px 8px -2px rgba(9, 30, 66, 0.25), 0 0 1px rgba(9, 30, 66, 0.31);
            transition: transform 200ms ease, box-shadow 200ms ease;
        }

        .kashis-room-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px -4px rgba(9, 30, 66, 0.25), 0 0 1px rgba(9, 30, 66, 0.31);
        }

        .kashis-room-image img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
        }

        .kashis-room-content {
            padding: 1.5rem;
        }

        .kashis-room-title {
            margin: 0 0 0.75rem 0;
            font-size: 1.25rem;
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
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .kashis-room-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #0052CC;
            color: #FFFFFF !important;
            text-decoration: none !important;
            border-radius: 3px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 150ms ease;
        }

        .kashis-room-button:hover {
            background: #0747A6;
        }

        .kashis-room-list-empty {
            text-align: center;
            padding: 3rem 1.5rem;
            background: #F4F5F7;
            border-radius: 3px;
            color: #5E6C84;
        }
    </style>

    <?php if ($show_filters): ?>
    <script>
    (function() {
        const blockId = '<?php echo esc_js($unique_id); ?>';
        const block = document.querySelector('[data-block-id="' + blockId + '"]');
        if (!block) return;

        const filters = block.querySelectorAll('.kashis-filter-btn');
        const rooms = block.querySelectorAll('.kashis-room-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                const category = this.getAttribute('data-category');

                // Update active state
                filters.forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                // Filter rooms
                rooms.forEach(room => {
                    if (!category || room.classList.contains('category-' + category)) {
                        room.style.display = 'block';
                    } else {
                        room.style.display = 'none';
                    }
                });
            });
        });
    })();
    </script>
    <?php endif; ?>

    <?php
    wp_reset_postdata();
    return ob_get_clean();
}
