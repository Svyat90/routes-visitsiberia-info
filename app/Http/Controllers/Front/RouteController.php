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
use Illuminate\Support\Collection;

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

    public function index(Request $request, DictionaryService $dictionaryService)
    {
        $data = $this->service->repository->getCollectionToIndex();

        $geoData = new Collection();
        $routes = $data->map(function (Route $route) use (&$geoData) {
            $routable = $this->service->repository->getRoutableEntities($route);

            $geoData[] = [
                'name' => $route->name,
                'items' => $routable->map(function (Model $model) {
                    return ['lat' => $model->lat, 'lng' => $model->lng];
                })->toArray()
            ];

            return [
                'model' => $route,
                'routable' => $routable
            ];
        });

        return view('front.routes.index', compact(
            'routes',
            'geoData'
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
