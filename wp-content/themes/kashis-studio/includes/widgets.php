<?php
/**
 * Widget Areas
 *
 * @package Kashis_Studio
 * @since 1.0.6
 */

/**
 * Register widget areas (sidebars)
 *
 * Registers four widget-ready areas: one sidebar and three footer widget areas
 * with appropriate HTML markup for widgets and titles.
 *
 * @since 1.0.6
 * @return void
 */
function kashis_studio_widgets_init() {
    $sidebars = array(
        array(
            'name' => 'サイドバー',
            'id'   => 'sidebar-1',
            'description' => 'サイドバーウィジェットエリア',
        ),
        array(
            'name' => 'フッター1',
            'id'   => 'footer-1',
            'description' => 'フッターウィジェットエリア1',
        ),
        array(
            'name' => 'フッター2',
            'id'   => 'footer-2',
            'description' => 'フッターウィジェットエリア2',
        ),
        array(
            'name' => 'フッター3',
            'id'   => 'footer-3',
            'description' => 'フッターウィジェットエリア3',
        ),
    );

    foreach ($sidebars as $sidebar) {
        register_sidebar(array(
            'name'          => $sidebar['name'],
            'id'            => $sidebar['id'],
            'description'   => $sidebar['description'],
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'kashis_studio_widgets_init');

/**
 * Advanced Room Search Widget
 *
 * Custom widget for advanced studio room search with filters.
 *
 * @since 1.0.8
 */
class Kashis_Studio_Room_Search_Widget extends WP_Widget {
    /**
     * Constructor
     *
     * @since 1.0.8
     */
    public function __construct() {
        parent::__construct(
            'kashis_room_search',
            __('スタジオルーム検索', 'kashis-studio'),
            array('description' => __('高度なスタジオルーム検索ウィジェット', 'kashis-studio'))
        );
    }

    /**
     * Output widget content
     *
     * @since 1.0.8
     * @param array $args Widget arguments
     * @param array $instance Widget instance
     */
    public function widget($args, $instance): void {
        echo $args['before_widget'];

        $title = !empty($instance['title']) ? $instance['title'] : __('スタジオを探す', 'kashis-studio');
        echo $args['before_title'] . esc_html($title) . $args['after_title'];

        $categories = get_terms(array(
            'taxonomy' => 'room_category',
            'hide_empty' => true,
        ));

        ?>
        <form class="kashis-room-search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <input type="hidden" name="post_type" value="studio_room">

            <div class="search-field">
                <label for="room-search-keyword">キーワード</label>
                <input type="text" id="room-search-keyword" name="s" placeholder="スタジオ名・特徴で検索">
            </div>

            <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                <div class="search-field">
                    <label for="room-search-category">カテゴリー</label>
                    <select id="room-search-category" name="room_category">
                        <option value="">すべて</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?> (<?php echo esc_html($category->count); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <button type="submit" class="search-submit-button">検索する</button>
        </form>

        <style>
            .kashis-room-search-form {
                background: #F4F5F7;
                padding: 1.5rem;
                border-radius: 6px;
            }

            .search-field {
                margin-bottom: 1rem;
            }

            .search-field label {
                display: block;
                font-size: 0.875rem;
                font-weight: 600;
                color: #42526E;
                margin-bottom: 0.5rem;
            }

            .search-field input[type="text"],
            .search-field select {
                width: 100%;
                padding: 0.625rem;
                border: 2px solid #DFE1E6;
                border-radius: 3px;
                font-size: 0.9375rem;
                transition: border-color 150ms ease;
            }

            .search-field input[type="text"]:focus,
            .search-field select:focus {
                outline: none;
                border-color: #0052CC;
            }

            .search-submit-button {
                width: 100%;
                padding: 0.75rem 1rem;
                background: #0052CC;
                color: #FFFFFF;
                border: none;
                border-radius: 3px;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: background-color 150ms ease;
            }

            .search-submit-button:hover {
                background: #0747A6;
            }
        </style>
        <?php

        echo $args['after_widget'];
    }

    /**
     * Widget form in admin
     *
     * @since 1.0.8
     * @param array $instance Widget instance
     */
    public function form($instance): void {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('タイトル:', 'kashis-studio'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    /**
     * Update widget
     *
     * @since 1.0.8
     * @param array $new_instance New instance
     * @param array $old_instance Old instance
     * @return array Updated instance
     */
    public function update($new_instance, $old_instance): array {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

/**
 * Register custom widgets
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_register_custom_widgets(): void {
    register_widget('Kashis_Studio_Room_Search_Widget');
}
add_action('widgets_init', 'kashis_studio_register_custom_widgets');
