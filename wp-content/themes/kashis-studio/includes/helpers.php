<?php
/**
 * Helper Functions
 *
 * Utility functions used throughout the theme
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Get studio information by key
 *
 * Retrieves studio contact information and details from WordPress options
 * with static caching for better performance. Returns empty string if key doesn't exist.
 *
 * Available keys: phone, email, address, hours, access
 *
 * @since 1.0.6
 * @param string $key The information key to retrieve
 * @return string The requested studio information or empty string
 */
function kashis_get_studio_info(string $key): string {
    static $info = null;

    // キャッシュが未初期化の場合のみget_option()を実行
    if ($info === null) {
        $info = array(
            'phone'   => get_option('kashis_studio_phone', KASHIS_STUDIO_DEFAULT_PHONE),
            'email'   => get_option('kashis_studio_email', KASHIS_STUDIO_DEFAULT_EMAIL),
            'address' => get_option('kashis_studio_address', KASHIS_STUDIO_DEFAULT_ADDRESS),
            'hours'   => get_option('kashis_studio_hours', KASHIS_STUDIO_DEFAULT_HOURS),
            'access'  => get_option('kashis_studio_access', KASHIS_STUDIO_DEFAULT_ACCESS),
        );
    }

    return isset($info[$key]) ? $info[$key] : '';
}

/**
 * Display breadcrumbs navigation
 *
 * Outputs a hierarchical breadcrumb trail for improved navigation and SEO.
 * Supports posts, pages, archives, categories, and custom post types.
 *
 * @since 1.0.8
 * @return void
 */
function kashis_studio_breadcrumbs(): void {
    if (is_front_page()) {
        return;
    }

    $separator = ' › ';
    $home_title = 'ホーム';

    echo '<nav class="kashis-breadcrumbs" aria-label="パンくずリスト">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a>';

    if (is_category() || is_single()) {
        echo $separator;
        the_category(', ');
        if (is_single()) {
            echo $separator;
            the_title();
        }
    } elseif (is_page()) {
        if ($post = get_post()) {
            if ($post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                    $parent_id = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $separator . $crumb;
                }
            }
            echo $separator;
            the_title();
        }
    } elseif (is_search()) {
        echo $separator . '検索結果';
    } elseif (is_404()) {
        echo $separator . 'ページが見つかりません';
    } elseif (is_post_type_archive('studio_room')) {
        echo $separator . 'スタジオルーム一覧';
    } elseif (is_singular('studio_room')) {
        echo $separator . '<a href="' . esc_url(get_post_type_archive_link('studio_room')) . '">スタジオルーム一覧</a>';
        echo $separator;
        the_title();
    }

    echo '</nav>';

    // Add breadcrumb styles
    ?>
    <style>
        .kashis-breadcrumbs {
            padding: 1rem 0;
            font-size: 0.875rem;
            color: #5E6C84;
        }

        .kashis-breadcrumbs a {
            color: #0052CC;
            text-decoration: none;
            transition: color 150ms ease;
        }

        .kashis-breadcrumbs a:hover {
            color: #0747A6;
            text-decoration: underline;
        }
    </style>
    <?php
}
