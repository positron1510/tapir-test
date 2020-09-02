<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    /**
     * @param Advertisement $advertisement
     * @param Request $request
     * @param int $per_page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @method GET
     * @route /{per_page?}
     *
     * Метод выводящий объявления с учетом пагинации
     */
    public function index(Advertisement $advertisement, Request $request, int $per_page=1)
    {
        $request = $request->all();
        $request['pagination_per_page'] = $per_page;
        $advertisement->repository->setRequest($request);
        $advertisements =  $advertisement->repository->getAll();
        $pagination = $advertisement->repository->getPagination($per_page, 'web.index');

        return view('index.index', ['advertisements' => $advertisements, 'pagination' => $pagination]);
    }
}
