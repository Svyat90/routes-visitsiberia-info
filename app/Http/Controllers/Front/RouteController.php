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
use App\Models\Place;
use App\Services\PlaceService;
use App\Services\EventService;
use App\Models\Hotel;
use App\Services\HotelService;
use App\Services\MealService;
use App\Models\Meal;
use App\Models\Event;

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

        $routeType = $request->has('transport_id') && $request->transport_id
            ? $dictionaryService->repository->getDictionary($request->transport_id)->type
            : null;

        return view('front.routes.index', compact(
            'routes',
            'geoData',
            'transportList',
            'whomList',
            'typeList',
            'routes',
            'routeType'
        ));
    }

    /**
     * @param Route        $route
     * @param PlaceService $placeService
     * @param EventService $eventService
     * @param HotelService $hotelService
     * @param MealService  $mealService
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function show(
        Route $route,
        PlaceService $placeService,
        EventService $eventService,
        HotelService $hotelService,
        MealService $mealService,
        DictionaryService $dictionaryService
    ) {
        $route->load('reviews', 'reviews.replies');

        $routable = $this->service->repository->getRoutableEntities($route);

        $route->hotels = collect();
        $route->meals = collect();
        $route->events = collect();

        $eventsAll = $mealsAll = $placesAll = $hotelsAll = $nearGeoDataAll = collect();
        $routable->map(function (Model $model) use ($route, $placeService, $eventService, $hotelService, $mealService, &$eventsAll, &$mealsAll, &$placesAll, &$hotelsAll, &$nearGeoDataAll) {
            switch (true) {
                case $model instanceof Place:
                    [$events, $meals, $hotels, $nearGeoData] = $placeService->getNearData($model);
                    $eventsAll->push($events);
                    $mealsAll->push($meals);
                    $hotelsAll->push($hotels);
                    $nearGeoDataAll->push($nearGeoData);
                    break;
                case $model instanceof Hotel:
                    [$events, $meals, $places, $nearGeoData] = $hotelService->getNearData($model);
                    $eventsAll->push($events);
                    $mealsAll->push($meals);
                    $placesAll->push($places);
                    $nearGeoDataAll->push($nearGeoData);
                    break;
                case $model instanceof Meal:
                    [$events, $hotels, $places, $nearGeoData] = $mealService->getNearData($model);
                    $eventsAll->push($events);
                    $hotelsAll->push($hotels);
                    $placesAll->push($places);
                    $nearGeoDataAll->push($nearGeoData);
                    break;
                case $model instanceof Event:
                    [$hotels, $meals, $places, $nearGeoData] = $eventService->getNearData($model);
                    $mealsAll->push($meals);
                    $hotelsAll->push($hotels);
                    $placesAll->push($places);
                    $nearGeoDataAll->push($nearGeoData);
            }

            if ($hotels ?? null) {
                $route->hotels->push($hotels);
            }
            if ($events ?? null) {
                $route->events->push($events);
            }
            if ($meals ?? null) {
                $route->meals->push($meals);
            }

            $model->nearObjects = $mealsAll
                ->merge($hotelsAll)
                ->merge($placesAll)
                ->merge($eventsAll)
                ->unique()
                ->collapse();

            return $model;
        });

        $route->hotels = $route->hotels->collapse()->unique();
        $route->events = $route->events->collapse()->unique();
        $route->meals = $route->meals->collapse()->unique();

        $nearGeoDataAll = $nearGeoDataAll->unique()->collapse();

        $geoData = $routable->map(function (Model $model) {
            return ['lat' => $model->lat, 'lng' => $model->lng];
        });

        $routeType = $dictionaryService->getRouteTransportType($route);

        return view('front.routes.show', compact(
            'route',
            'routable',
            'geoData',
            'nearGeoDataAll',
            'routeType'
        ));
    }

}
