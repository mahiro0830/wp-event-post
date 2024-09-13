interface Calendar {
  element: HTMLElement | null;
  dateElemts: NodeListOf<HTMLElement> | [];
  cellElements: NodeListOf<HTMLElement> | [];
  yearDisplay: HTMLElement | null;
  monthDisplay: HTMLElement | null;
  year: string | number;
  month: string | number;
  apiPath: string;
  loading: boolean;
  loadingElement: HTMLElement | null;
}

class Calendar {
  /**
   * constructor
   * @param { HTMLElement } element
   */
  public constructor(element: HTMLElement) {
    this.element = element || null;
    this.dateElemts = element.querySelectorAll('.p-calendar__date') || [];
    this.cellElements = element.querySelectorAll('.js-cell') || [];
    this.yearDisplay = element.querySelector('.js-year') || null;
    this.monthDisplay = element.querySelector('.js-month') || null;
    this.year = '';
    this.month = '';
    this.apiPath = element.closest('#mc-calendar')?.getAttribute('data-api-path') || '';
    this.loading = false;
    this.loadingElement = document.querySelector('.js-loading') || null;
  };

  /**
   * 初期化
   * カレンダーの描画
   * @param { number } 年
   * @param { number } 月
   * @return { void }
   */
  public init(year = new Date().getFullYear(), month = new Date().getMonth() + 1): void {
    this.year = year;
    this.month = month;
    this.drawCalendar(this.year, this.month);
  };

  /**
   * カレンダーを描画
   * @param { number } 年
   * @param { number } 月
   * @return { void }
   */
  public drawCalendar(year: string | number = this.year, month: string | number = this.month): void {
    // ローディングを表示
    this.loading = true;
    if (this.loadingElement) this.loadingElement.style.display = 'block';

    this.year = Number(year);
    this.month = Number(month);

    // 月初めの曜日を取得
    const firstDay = new Date(this.year, this.month - 1, 1).getDay() === 0 ? 6 : new Date(this.year, this.month - 1, 1).getDay() - 1;
    // 月末の日付を取得
    const lastDate = new Date(this.year, this.month, 0).getDate();

    if (this.yearDisplay) this.yearDisplay.textContent = String(this.year);
    if (this.monthDisplay) this.monthDisplay.textContent = String(this.month);

    // 日付を描画
    if (this.cellElements.length) {
      this.cellElements.forEach((cell: HTMLElement | null, index: number) => {
        if (cell) {
          if (index < firstDay || index >= lastDate + firstDay) {
            const dayElement = cell.querySelector('.day');
            if (dayElement) {
              dayElement.textContent = '';
            }
          } else {
            const dayElement = cell.querySelector('.day');
            if (dayElement) {
              dayElement.textContent = String(index - firstDay + 1);
            }
          }
        }
      });
    }

    // イベントをリフレッシュ
    this.cellElements.forEach((cell: HTMLElement | null) => {
      const eventIcons = cell?.querySelectorAll('.p-calendar__events-icon');
      const events = cell?.querySelectorAll('.p-calendar__events-item');

      eventIcons?.forEach((icon) => {
        icon.remove();
      });
      events?.forEach((event) => {
        event.remove();
      });
    });

    // イベントを描画
    setTimeout(() => {
      const events = this.fetchEvents(this.year, this.month);
      events.then((data) => {
        data.forEach((item: any) => {
          const date = new Date(item.event_meta.event_start);
          const day = date.getDate();
          const targetCell = this.cellElements[day + firstDay - 1];
          const eventsParent = targetCell?.querySelector('.p-calendar__events');
          const iconWrapper = targetCell?.querySelector('.p-calendar__events-icons');
          const eventWrapper = targetCell?.querySelector('.p-calendar__events-list');
          if (targetCell) {
            // イベント要素を生成

            // アイコンを反映
            const eventIconSrc: string = item.event_meta.event_icon;
            const eventIcon = document.createElement('div');
            eventIcon.classList.add('mc-event-icon');
            const eventIconInner = document.createElement('span');
            if (eventIconSrc) {
              const eventIconImage = document.createElement('img');
              eventIcon.classList.add('p-calendar__events-icon');
              eventIconImage.src = item.event_meta.event_icon;
              eventIcon.appendChild(eventIconInner);
              eventIconInner.appendChild(eventIconImage);
            }
            iconWrapper?.appendChild(eventIcon);

            // イベント名・イベント詳細を反映
            const eventElement = document.createElement('div');
            eventElement.classList.add('p-calendar__events-item', 'mc-event-item');
            eventElement.textContent = item.title.rendered;
            eventElement?.setAttribute('data-detail', item.event_meta.event_details);
            // イベント日をdata属性に反映
            const eventDate = new Date(item.event_meta.event_start);
            const year = eventDate.getFullYear();
            const month = eventDate.getMonth() + 1;
            const day = eventDate.getDate();
            const week = ['日', '月', '火', '水', '木', '金', '土'][eventDate.getDay()];
            eventElement?.setAttribute('data-date', `${year}年${month}月${day}日(${week})`);
            eventWrapper?.appendChild(eventElement);

            // カテゴリーを取得
            const eventCategoryId = item['mc-event-category'][0];
            if (eventCategoryId) {
              const term = this.fetchTerm('mc-event-category', eventCategoryId);
              term.then((data) => {
                eventIcon?.setAttribute('style', 'background: linear-gradient(to bottom, #'+ data.slug + '1A' +' 50%, transparent 50%)');
                eventIcon?.setAttribute('data-color', '#'+ data.slug + '1A');
                eventIcon?.setAttribute('data-color-accent', '#'+ data.slug);
                eventsParent?.setAttribute('style', 'background-color: #' + data.slug + '1A');
              });
            }
          }
        });

        // ローディングを非表示
        this.loading = false;
        if (this.loadingElement) this.loadingElement.style.display = 'none';
      });
    }, 100);
  };

  /**
   * WordPress REST APIからイベントを取得
   *
   * @param { string | number } year
   * @param { string | number } month
   */
  private async fetchEvents(year: string | number, month: string | number) {
    try {
      const response = await fetch(`${this.apiPath}/mc-event?event_start_month=${year}-${month}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }

  /**
   * WordPress REST APIからターム情報を取得
   *
   * @param { string } taxonomy_slug
   * @param { id } term_id
   * @return { Promise<any> }
   * @private
   */
  private async fetchTerm(taxonomy_slug: string, term_id: number): Promise<any> {
    try {
      const response = await fetch(`${this.apiPath}/${taxonomy_slug}/${term_id}`);
      const data = await response.json();
      return data;
    } catch (error) {
      console.error(error);
    }
  }
}

export default Calendar;
