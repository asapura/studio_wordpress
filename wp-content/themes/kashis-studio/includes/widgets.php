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
