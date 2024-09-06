<?php

/**
 * Plugin Name: WP Event Post
 * Description: カスタム投稿タイプ「イベント」に登録した予定をカレンダーで可視化できます。
 * Version: 1.0.0
 */

require_once plugin_dir_path(__FILE__) . 'inc/admin.php';
require_once plugin_dir_path(__FILE__) . 'inc/view.php';

use WpAdminPost\Admin;
use WpEventPost\View;

$admin = new Admin();
$view = new View();
