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

        <div id="mc-calendar" class="p-calendar" data-api-path="<?php echo esc_url_raw( rest_url( 'wp/v2/mc-event' ) ); ?>">
            <div class="p-calendar__loading js-loading">
                <div class="p-calendar__loading-icon"></div>
            </div>
            <button class="p-calendar__move js-prev" type="button" data-prev-year="" data-prev-month=""></button>
            <button class="p-calendar__move js-next" type="button" data-next-year="" data-next-month=""></button>
            <div class="p-calendar__body">
                <div class="p-calendar__item js-calendar" data-year="", data-month="">
                    <div class="p-calendar__label"><span class="js-year">----</span>年<span class="js-month">--</span>月</div>
                    <table class="p-calendar__table">
                        <thead>
                            <th class="p-calendar__day">月</th>
                            <th class="p-calendar__day">火</th>
                            <th class="p-calendar__day">水</th>
                            <th class="p-calendar__day">木</th>
                            <th class="p-calendar__day">金</th>
                            <th class="p-calendar__day">土</th>
                            <th class="p-calendar__day">日</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-calendar__item js-calendar" data-year="" data-month="">
                    <div class="p-calendar__label"><span class="js-year">----</span>年<span class="js-month">--</span>月</div>
                    <table class="p-calendar__table">
                        <thead>
                            <tr>
                                <th class="p-calendar__day">月</th>
                                <th class="p-calendar__day">火</th>
                                <th class="p-calendar__day">水</th>
                                <th class="p-calendar__day">木</th>
                                <th class="p-calendar__day">金</th>
                                <th class="p-calendar__day">土</th>
                                <th class="p-calendar__day">日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                                <td class="p-calendar__date" data-status="">
                                    <a href="javascript:void(0)" class="js-cell">
                                        <span class="day">-</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-calendar-modal js-modal">
                <div class="p-calendar-modal__box">

                </div>
            </div>
        </div>

        <?php
        return ob_get_clean();
    }
}
