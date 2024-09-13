<?php

/**
 * Plugin Name: WP Event Post
 * Description: カスタム投稿タイプ「イベント」に登録した予定をカレンダーで可視化できます。
 * Version: 1.0.0
 */

require_once plugin_dir_path(__FILE__) . 'inc/Admin.php';
require_once plugin_dir_path(__FILE__) . 'inc/View.php';

use WpAdminPost\Admin;
use WpEventPost\View;

$admin = new Admin();
$view = new View();

/**
 * CSS, JSの読み込み
 *
 * @return void
 */
function wp_event_post_scripts()
{
    wp_enqueue_style( 'wp-event-post-style', plugins_url( 'public/css/style.css', __FILE__ ), array(), '1.0.0', 'all' );
    wp_enqueue_script( 'wp-event-post-script', plugins_url( 'public/js/main.js', __FILE__ ), array(), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'wp_event_post_scripts');

/**
 * 管理画面のCSS, JSの読み込み
 */
function wp_event_post_admin_scripts()
{
    wp_enqueue_style( 'wp-event-post-admin-style', plugins_url( 'public/admin/style.css', __FILE__ ), array(), '1.0.0', 'all' );
    wp_enqueue_script( 'wp-event-post-admin-script', plugins_url( 'public/admin/main.js', __FILE__ ), array(), '1.0.0', true );
}
add_action('admin_enqueue_scripts', 'wp_event_post_admin_scripts');
