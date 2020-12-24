<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use App\Services\DictionaryService;
use App\Services\RouteService;
use App\Models\Route;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CollectionHelper;
use App\Http\Requests\Front\Routes\IndexRouteRequest;

class RouteController extends FrontController
{
    /**
     * @var RouteService
     */
    private RouteService $service;

    /**
     * RouteController constructor.
     *
     * @param RouteService $service
     */
    public function __construct(RouteService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index(IndexRouteRequest $request, DictionaryService $dictionaryService)
    {
        $transportList = $dictionaryService->getTransportList();
        $whomList = $dictionaryService->getWhomList();
        $typeList = $dictionaryService->getTypesList();

        $geoData = collect();
        $data = $this->service->getFilteredRoutes($request)
            ->map(function (Route $route) use (&$geoData) {
                return $this->service->fillRouteData($route, $geoData);
            });

        $routes = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'transport_id' => $request->transport_id,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
                'whom_id' => $request->whom_id
            ]);

        return view('front.routes.index', compact(
            'routes',
            'geoData',
            'transportList',
            'whomList',
            'typeList'
        ));
    }

    /**
     * @param Request $request
     * @param Route   $route
     *
     * @return Application|Factory|View
     */
    public function show(Request $request, Route $route)
    {
        $routable = $this->service->repository->getRoutableEntities($route);

        $geoData = $routable->map(function (Model $model) {
            return ['lat' => $model->lat, 'lng' => $model->lng];
        });

        return view('front.routes.show', compact('route', 'routable', 'geoData'));
    }

}
