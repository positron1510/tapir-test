<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Advertisement;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Paginator;


class AdvertisementRepository extends BaseRepository
{
    /**
     * @return array
     *
     * Все объявления с учетом пагинации
     */
    public function getAll():array
    {
        $request = $this->getRequest();

        $sql = 'SELECT (SELECT p.url FROM photos p WHERE a.id=p.advertisement_id ORDER BY p.id ASC LIMIT 1) AS photo, 
                a.title,a.description,a.price
                 FROM advertisements a';

        $order_string = '';
        if (isset($request['order_by_price'])) {
            $order_string = sprintf(' ORDER BY a.price %s', mb_strtoupper($request['order_by_price']));
        }
        if (isset($request['order_by_created_at'])) {
            $order_string = sprintf(' ORDER BY a.created_at %s', mb_strtoupper($request['order_by_created_at']));
        }
        $sql .= $order_string;

        $per_page = $request['pagination_per_page'] ?? 1;
        $offset = Paginator::PAGINATION_LIMIT * ($per_page - 1);

        $sql .= sprintf(' LIMIT %s OFFSET %s', Paginator::PAGINATION_LIMIT, $offset);

        $records = DB::select($sql);

        return $records;
    }

    /**
     * @return int
     *
     * Сохраняем объявление и его фотки
     */
    public function StoreAndGetId():int
    {
        $request = $this->getRequest();

        $adv = Advertisement::create($request);
        $photos = array_map(function ($url){return new Photo(['url' => $url]);}, $request['photos']);
        Advertisement::find($adv->id)->photos()->saveMany($photos);

        return $adv->id;
    }

    /**
     * @return array
     *
     * Получаем объявление по идентификатору
     */
    public function getSingle():array
    {
        $request = $this->getRequest();

        $sql = 'SELECT (SELECT p.url FROM photos p WHERE a.id=p.advertisement_id ORDER BY p.id ASC LIMIT 1) AS photo, 
                a.title,a.description,a.price
                 FROM advertisements a WHERE a.id=:id';

        $record = DB::select($sql, ['id' => $request['id']]);
        if (!$record) {
            throw new ModelNotFoundException(sprintf("Объявление с идентификатором '%s' не существует", $request['id']));
        }

        return $record;
    }

    /**
     * @param int $per_page
     * @param string $route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Рендерим пагинацию
     */
    public function getPagination(int $per_page, string $route)
    {
        $request = $this->getRequest();
        if (isset($request['pagination_per_page'])) unset($request['pagination_per_page']);
        $query_string = sprintf('?%s', http_build_query($request));

        $total = DB::select('SELECT COUNT(*) AS count FROM advertisements')[0]->count;
        $paginator = new Paginator($total, $per_page, $route, $query_string);

        return $paginator->render();
    }
}
