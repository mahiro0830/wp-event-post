<?php

namespace WpAdminPost;

class Admin
{
    /**
     * Admin constructor.
     *
     * @return void
     */
    public function __construct()
    {
        add_action( 'init', array( $this, 'create_event_post' ), 1 );
        add_action( 'add_meta_boxes', array( $this, 'event_add_meta_box' ) );
        add_action( 'save_post', array( $this, 'event_save_meta_box_data' ) );
        add_action( 'rest_api_init', array( $this, 'add_custom_fields_to_rest_api' ) );
        add_filter( 'rest_mc-event_query', array( $this, 'filter_events_by_event_start' ), 10, 2 );
    }

    /**
     * カスタム投稿タイプ「イベント」を追加
     *
     * @return void
     */
    public function create_event_post()
    {
        register_post_type(
            'mc-event',
            array(
                'label' => 'イベント',
                'description' => '',
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_rest' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'rewrite' => array("slug" => "event", "with_front" => false),
                'has_archive' => false,
                'exclude_from_search' => false,
                'menu_position' => 2,
                'menu_icon' => 'dashicons-calendar',
                'supports' => array(
                    'title',
                ),
                'labels' => array(
                    'name' => 'イベント',
                    'all_items' => 'イベント一覧',
                    'add_new' => '新しいイベントを追加',
                    'add_new_item' => '新しいイベントを追加',
                    'edit_item' => 'イベントを編集',
                    'new_item' => '新しいイベント',
                    'view_item' => 'イベントを表示',
                    'search_items' => 'イベントを検索',
                    'not_found' => 'イベントが見つかりません',
                    'not_found_in_trash' => 'ゴミ箱にイベントはありません',
                ),
            )
        );

        // カスタムタクソノミー「イベントカテゴリー」を追加
        register_taxonomy(
            'mc-event-category',
            'mc-event',
            array(
                'label' => 'イベントカテゴリー',
                'public' => true,
                'show_ui' => true,
                'show_in_rest' => true,
                'hierarchical' => true,
                'publicly_queryable' => false,
                'capabilities' => array(
                    'assign_terms' => 'edit_posts',
                    'edit_terms' => 'publish_posts',
                ),
                'labels' => array(
                    'name' => 'イベントカテゴリー',
                    'singular_name' => 'イベントカテゴリー',
                    'search_items' => 'イベントカテゴリーを検索',
                    'popular_items' => 'よく使われているイベントカテゴリー',
                    'all_items' => 'すべてのイベントカテゴリー',
                    'edit_item' => 'イベントカテゴリーを編集',
                    'update_item' => 'イベントカテゴリーを更新',
                    'add_new_item' => '新しいイベントカテゴリーを追加',
                    'new_item_name' => '新しいイベントカテゴリー',
                    'separate_items_with_commas' => 'カンマで区切ってイベントカテゴリーを追加',
                    'add_or_remove_items' => 'イベントカテゴリーを追加または削除',
                    'choose_from_most_used' => 'よく使われているイベントカテゴリーから選択',
                ),
            )
        );
    }

    /**
     * カスタム投稿タイプ「イベント」のカスタムフィールドを追加
     *
     * @return void
     */
    public function event_add_meta_box() {
        add_meta_box(
            'event_details_meta_box', // メタボックスのID
            'イベント詳細', // メタボックスのタイトル
            array( $this, 'event_meta_box_html' ), // コールバック関数
            'mc-event', // 投稿タイプ
            'normal', // 表示位置
            'default' // 表示優先度
        );
    }

    /**
     * メタボックスのHTML
     *
     * @param $post
     * @return void
     */
    public function event_meta_box_html($post) {
        // メディアアップローダーを使用するために必要なスクリプトを読み込む
        // 管理画面用のスクリプトとスタイルを読み込む
        function enqueue_admin_scripts($hook) {
            // 投稿編集ページでのみスクリプトを読み込む
            if ('post.php' != $hook) {
                return;
            }

            // メディアライブラリのスクリプト
            wp_enqueue_media();

            // カスタムJavaScriptの読み込み
            wp_enqueue_script(
                'custom-media-uploader',
                plugin_dir_url(__FILE__) . 'js/custom-media-uploader.js',
                array('jquery'),
                null,
                true
            );
        }
        add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');
        wp_enqueue_media();

        // カスタムフィールドのデータを取得
        $data['event_icon']    = get_post_meta($post->ID, '_event_icon', true);
        $data['event_start']   = get_post_meta($post->ID, '_event_start', true);
        $data['event_end']     = get_post_meta($post->ID, '_event_end', true);
        $data['event_details'] = get_post_meta($post->ID, '_event_details', true);

        ?>
        <label for="event_icon">アイコンをアップロード:</label>
        <br />
        <img id="event_icon_preview" src="<?php echo esc_url($data['event_icon']); ?>" style="max-width: 100px; margin-top: 6px;" />
        <br />
        <input type="hidden" id="event_icon" name="event_icon" value="<?php echo esc_attr($data['event_icon']); ?>" />
        <button id="upload_event_icon_button" type="button" class="button">アイコンを選択</button>
        <hr />
        <label for="event_start">開始日時:</label>
        <input
            type="datetime-local"
            id="event_start"
            name="event_start"
            value="<?php echo esc_attr($data['event_start']); ?>"
        />
        <hr />
        <label for="event_end">終了日時:</label>
        <input
            type="datetime-local"
            id="event_end"
            name="event_end"
            value="<?php echo esc_attr($data['event_end']); ?>"
        />
        <hr />
        <label for="event_details">イベント詳細:</label>
        <textarea
            id="event_details"
            style="margin-top: 6px; width: 100%; height: 250px;"
            name="event_details"><?php echo esc_textarea($data['event_details']); ?></textarea>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var mediaUploader;

                $('#upload_event_icon_button').on('click', function(e) {
                    e.preventDefault();

                    // すでにメディアアップローダーが開いている場合は再利用
                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }

                    // 新しいメディアアップローダーを作成
                    mediaUploader = wp.media.frames.file_frame = wp.media({
                        title: 'アイコンを選択',
                        button: {
                            text: 'この画像を使用'
                        },
                        multiple: false // 単一画像のみ選択可能
                    });

                    // 画像が選択されたときの処理
                    mediaUploader.on('select', function() {
                        var attachment = mediaUploader.state().get('selection').first().toJSON();
                        $('#event_icon').val(attachment.url);
                        $('#event_icon_preview').attr('src', attachment.url);
                    });

                    // メディアライブラリを開く
                    mediaUploader.open();
                });
            });
        </script>
        <?php
    }

    /**
     * メタボックスのデータ保存
     *
     * @param $post_id
     * @return void
     */
    public function event_save_meta_box_data($post_id) {
        // 投稿が自動保存されている場合は処理しない
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // 権限チェック
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // フィールドデータの保存
        if (array_key_exists('event_icon', $_POST)) {
            update_post_meta(
                $post_id,
                '_event_icon',
                $_POST['event_icon']
            );
        }

        if (isset($_POST['event_start'])) {
            update_post_meta($post_id, '_event_start', sanitize_text_field($_POST['event_start']));
        }

        if (isset($_POST['event_end'])) {
            update_post_meta($post_id, '_event_end', sanitize_text_field($_POST['event_end']));
        }

        if (isset($_POST['event_details'])) {
            update_post_meta($post_id, '_event_details', sanitize_textarea_field($_POST['event_details']));
        }
    }

    /**
     * REST APIにカスタムフィールドを追加
     *
     * @return void
     */
    public function add_custom_fields_to_rest_api() {
        // 'mc-event' カスタム投稿タイプにカスタムフィールドを追加
        register_rest_field( 'mc-event',
            'event_meta',
            array(
                'get_callback'    => array( $this, 'get_event_meta_for_api' ),
                'update_callback' => null,
                'schema'          => null,
            )
        );
    }

    /**
     * REST API用のカスタムフィールドデータを取得
     *
     * @param array $object Details of current post.
     * @return array Event meta data
     */
    public function get_event_meta_for_api( $object ) {
        $post_id = $object['id'];
        $event_icon    = get_post_meta( $post_id, '_event_icon', true );
        $event_start   = get_post_meta( $post_id, '_event_start', true );
        $event_end     = get_post_meta( $post_id, '_event_end', true );
        $event_details = get_post_meta( $post_id, '_event_details', true );

        return array(
            'event_icon'    => $event_icon,
            'event_start'   => $event_start,
            'event_end'     => $event_end,
            'event_details' => $event_details,
        );
    }

    /**
     * イベントの開始日時でイベントをフィルタリング
     */
    public function filter_events_by_event_start( $args, $request ) {
        if ( isset( $request['event_start_month'] ) ) {
            $year_month = sanitize_text_field( $request['event_start_month'] );

            // 8月の開始日から終了日までを指定
            $start_date = $year_month . '-01 00:00:00';
            $end_date = $year_month . '-31 23:59:59';

            // WP_Query に meta_query を追加
            $args['meta_query'] = array(
                array(
                    'key'     => '_event_start',
                    'value'   => array( $start_date, $end_date ),
                    'compare' => 'BETWEEN',
                    'type'    => 'DATETIME',
                ),
            );
        }

        return $args;
    }
}
