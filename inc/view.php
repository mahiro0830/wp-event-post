<?php

namespace WpEventPost;

class View
{
    /**
     * View constructor.
     *
     * @return void
     */
    public function __construct()
    {
        add_shortcode( 'event_calendar', array( $this, 'event_calendar' ) );
    }

    /**
     * ショートコード「イベントカレンダーの表示」
     *
     * @return string
     */
    public function event_calendar()
    {
        ob_start();
        ?>

        <div id="mc-calendar">
            これはカレンダーです。
        </div>

        <?php
        return ob_get_clean();
    }
}
