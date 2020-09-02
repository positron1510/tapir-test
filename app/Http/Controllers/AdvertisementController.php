<?php

namespace App\Http\Controllers;

use App\Http\Requests\AllRequest;
use App\Http\Requests\SingleRequest;
use App\Models\Advertisement;
use App\Http\Requests\StoreRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AdvertisementController extends Controller
{
    /**
     * @param Advertisement $advertisement
     * @param AllRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @method GET
     * @route /api/v1/advertisement
     *
     * Получение всех объявлений с учётом лимита пагинации
     */
    public function all(Advertisement $advertisement, AllRequest $request)
    {
        $advertisement->repository->setRequest($request->validated());
        $advertisements = $advertisement->repository->getAll();
        return response()->json($advertisements, 200);
    }

    /**
     * @param Advertisement $advertisement
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @method POST
     * @route /api/v1/advertisement
     *
     * Запись объявления в БД
     */
    public function store(Advertisement $advertisement, StoreRequest $request)
    {
        try {
            $advertisement->repository->setRequest($request->validated());
            $adv_id = $advertisement->repository->StoreAndGetId();
            return response()->json($adv_id, 201);
        }catch (\Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()], 500);
        }
    }

    /**
     * @param Advertisement $advertisement
     * @param SingleRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @method GET
     * @route /api/v1/advertisement/get
     *
     * Получение объявления по идентификатору
     */
    public function single(Advertisement $advertisement, SingleRequest $request)
    {
        $advertisement->repository->setRequest($request->validated());
        try {
            $adv = $advertisement->repository->getSingle();
            return response()->json($adv, 200);
        }catch (ModelNotFoundException $ex) {
            return response()->json(['errors' => $ex->getMessage()], 404);
        }
    }
}
