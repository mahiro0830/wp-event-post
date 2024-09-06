import CalendarDrawer from './_CalendarDrawer';

document.addEventListener('DOMContentLoaded', (): void => {
  const calendarElements: NodeListOf<HTMLElement> | [] = document.querySelectorAll('.js-calendar') || [];
  const calendarPrev: HTMLElement | null = document.querySelector('.js-prev') || null;
  const calendarNext: HTMLElement | null = document.querySelector('.js-next') || null;
  let calendarDrawer: CalendarDrawer[] = [];

  if(!calendarElements.length) return;
  /**
   * CalendarDrawerクラスをインスタンス化
   * カレンダーを描画する
   */
  let count: number = 0;
  calendarElements.forEach((element: HTMLElement | null) => {
    if (!element) return;
    count++;
    calendarDrawer[count] = new CalendarDrawer(element);
    if (count === 1) {
      calendarDrawer[count].init();
    } else {
      // 2つ目以降のカレンダーは次の年月をセットして描画
      // 現在の年月を取得
      const nowYear: string | number = calendarDrawer[count - 1].year;
      const nowMonth: string | number = calendarDrawer[count - 1].month;

      // 次の年月を取得
      const nextMonth: string | number = (Number(nowMonth) + 1) === 13 ? 1 : Number(nowMonth) + 1;
      const nextYear: string | number = ((Number(nowMonth) + 1) === 13) ? Number(nowYear) + 1 : Number(nowYear);

      // 前の年月を取得
      const prevMonth = (Number(nowMonth) - 1) === 0 ? 12 : Number(nowMonth) - 1;
      const prevYear = ((Number(nowMonth) - 1) === 0) ? Number(nowYear) - 1 : Number(nowYear);

      // [data-prev-year][data-prev-month]に値をセット
      if (calendarPrev) {
        calendarPrev.dataset.prevYear = String(prevYear);
        calendarPrev.dataset.prevMonth = String(prevMonth);
      }
      // [data-next-year][data-next-month]に値をセット
      if (calendarNext) {
        calendarNext.dataset.nextYear = String(nextYear);
        calendarNext.dataset.nextMonth = String(nextMonth);
      }

      calendarDrawer[count].init(nextYear, nextMonth);
    }
  });

  if(!calendarPrev || !calendarNext) return;
  /**
   * 前のカレンダーを表示
   */
  calendarPrev.addEventListener('click', (e) => {
    // 前の年月を取得
    const prevYear = Number(calendarPrev.getAttribute('data-prev-year'));
    const prevMonth = Number(calendarPrev.getAttribute('data-prev-month'));

    // 次の年月を取得
    const nextMonth = (prevMonth + 1) === 13 ? 1 : prevMonth + 1;
    const nextYear = ((prevMonth + 1) === 13) ? prevYear + 1 : prevYear;

    // 前前の年月を取得
    const prev2Month = (prevMonth - 1) === 0 ? 12 : prevMonth - 1;
    const prev2Year = ((prevMonth - 1) === 0) ? prevYear - 1 : prevYear;

    // dataを更新
    if (!calendarPrev || !calendarNext) return
    calendarPrev.dataset.prevYear = String(prev2Year);
    calendarPrev.dataset.prevMonth = String(prev2Month);
    calendarNext.dataset.nextYear = String(nextYear);
    calendarNext.dataset.nextMonth = String(nextMonth);

    // カレンダーを描画
    calendarDrawer[2].drawCalendar(calendarDrawer[1].year, calendarDrawer[1].month);
    calendarDrawer[1].drawCalendar(prevYear, prevMonth);
  });

  /**
   * 次のカレンダーを表示
   */
  calendarNext.addEventListener('click', (e) => {
    // 次の年月を取得
    const nextYear = Number(calendarNext.getAttribute('data-next-year'));
    const nextMonth = Number(calendarNext.getAttribute('data-next-month'));

    // 前の年月を取得
    const prevMonth = (nextMonth - 1) === 0 ? 12 : nextMonth - 1;
    const prevYear = ((nextMonth - 1) === 0) ? nextYear - 1 : nextYear;

    // 次次の年月を取得
    const next2Year = ((nextMonth + 1) === 13) ? nextYear + 1 : nextYear;
    const next2Month = (nextMonth + 1) === 13 ? 1 : nextMonth + 1;

    // dataを更新
    if (!calendarPrev || !calendarNext) return
    calendarNext.dataset.nextYear = String(next2Year);
    calendarNext.dataset.nextMonth = String(next2Month);
    calendarPrev.dataset.prevYear = String(prevYear);
    calendarPrev.dataset.prevMonth = String(prevMonth);

    // カレンダーを描画
    calendarDrawer[2].drawCalendar(next2Year, next2Month);
    calendarDrawer[1].drawCalendar(nextYear, nextMonth);
  });
});
