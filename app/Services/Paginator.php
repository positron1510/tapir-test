<?php

namespace App\Services;


class Paginator
{
    /**
     *
     * Лимит объявлений на странице
     */
    const PAGINATION_LIMIT = 10;

    /**
     * @var int
     *
     * Номер текущей страницы
     */
    public $per_page;

    /**
     * @var int
     *
     * Количество страниц
     */
    public $count;

    /**
     * @var int
     *
     * Номер предыдущей страницы
     */
    public $previous_page;

    /**
     * @var int
     *
     * Номер следующей страницы
     */
    public $next_page;

    /**
     * @var string
     *
     * Относительный путь формирования ссылок на страницы
     */
    public $route;

    /**
     * @var string
     *
     * Строка с get-параметрами
     */
    public $query_string;

    /**
     * Paginator constructor.
     * @param int $total
     * @param int $per_page
     * @param string $route
     * @param string $query_string
     *
     * В конструкторе определяем все свойства объекта пагинации
     */
    public function __construct(int $total, int $per_page, string $route, string $query_string='')
    {
        $this->per_page = $per_page;
        $this->count = $this->countPages($total);
        $this->previous_page = $this->previousPage();
        $this->next_page = $this->nextPage();
        $this->route = $route;
        $this->query_string = $query_string;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Рендерим html-код для пагинации
     */
    public function render()
    {
        return view('pagination.pagination', ['paginator' => $this]);
    }

    /**
     * @param int $total
     * @return int
     *
     * Определяем количество страниц с учетом количества записей в базе и лимита на страницу
     */
    private function countPages(int $total):int
    {
        $count_pages = 0;
        while (true) {
            $count_pages += (int)($total / self::PAGINATION_LIMIT);
            $remain = (int)($total % self::PAGINATION_LIMIT);
            if ($remain < self::PAGINATION_LIMIT) {
                $count_pages++;
                break;
            }
            $total = $remain;
        }

        return $count_pages;
    }

    /**
     * @return int
     *
     * Предыдущая страница
     */
    private function previousPage():int
    {
        return $this->per_page > 1 ? (int)$this->per_page - 1 : 0;
    }

    /**
     * @return int
     *
     * Следующая страница
     */
    private function nextPage():int
    {
        return $this->per_page < $this->count ? (int)$this->per_page + 1 : 0;
    }
}
