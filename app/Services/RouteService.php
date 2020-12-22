<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Routes\StoreRouteRequest;
use App\Http\Requests\Admin\Routes\UpdateRouteRequest;
use App\Models\Route;
use App\Repositories\RouteRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\MediaHelper;
use App\Helpers\ImageHelper;
use App\Repositories\PlaceRepository;
use App\Repositories\HotelRepository;
use App\Repositories\MealRepository;
use App\Repositories\EventRepository;
use App\Models\Routable;
use Ramsey\Collection\Collection;

class RouteService
{
    /**
     * @var RouteRepository
     */
    public RouteRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param RouteRepository $repository
     */
    public function __construct(RouteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getDatatablesData()
    {
        $collection = $this->repository->getCollectionToIndex();

        return Datatables::of($collection)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('slug', fn ($row) => $row->slug)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('recommended', fn ($row) => LabelHelper::boolLabel($row->recommended))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'routes'))
            ->rawColumns(['actions', 'placeholder', 'active', 'recommended', 'image'])
            ->make(true);
    }

    /**
     * @param StoreRouteRequest $request
     *
     * @return Route
     */
    public function createRoute(StoreRouteRequest $request) : Route
    {
        $route = $this->repository->saveRoute($request->all());

        $this->repository->saveRoutableList($route, $request->routable_ids);

        $this->handleMediaFiles($request, $route);
        $this->handleRelationships($route, $request);

        return $route;
    }

    /**
     * @param UpdateRouteRequest $request
     * @param Route              $route
     *
     * @return Route
     */
    public function updateRoute(UpdateRouteRequest $request, Route $route) : Route
    {
        $this->syncRoutableIds($route, $request->routable_ids);

        $this->handleMediaFiles($request, $route);
        $this->handleRelationships($route, $request);

        return $this->repository->updateData($request->all(), $route);
    }

    /**
     * @return array
     */
    public function getRoutableList()
    {
        $places = (new PlaceRepository())->getListForRoutable();
        $hotels = (new HotelRepository())->getListForRoutable();
        $meals = (new MealRepository())->getListForRoutable();
        $events = (new EventRepository())->getListForRoutable();

        return $places
            ->merge($hotels)
            ->merge($meals)
            ->merge($events)
            ->toArray();
    }

    /**
     * @param Route $route
     * @param array $routableIds
     */
    public function syncRoutableIds(Route $route, array $routableIds) : void
    {
        $relatedData = $this->repository->getRelatedRoutableIds($route);
        if (! $relatedData->count()) {
            $this->repository->saveRoutableList($route, $routableIds);
            return;
        }

        $inputData = collect($routableIds);

        $toDelete = $relatedData->diff($inputData)->toArray();
        $toInsert = $inputData->diff($relatedData)->toArray();

        $this->repository->saveRoutableList($route, $toInsert);
        $this->repository->deleteRoutableList($route, $toDelete);
    }

    /**
     * @param StoreRouteRequest|UpdateRouteRequest   $request
     * @param Route $route
     */
    private function handleMediaFiles($request, Route $route) : void
    {
        MediaHelper::handleMedia($route, 'image', $request->image);
        MediaHelper::handleMedia($route, 'image_history', $request->image_history);
        MediaHelper::handleMedia($route, 'pdf_map', $request->pdf_map);

        MediaHelper::handleMediaCollect($route, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Route $route
     * @param StoreRouteRequest|UpdateRouteRequest $request
     */
    private function handleRelationships(Route $route, $request) : void
    {
        $route->dictionaries()->sync($request->dictionary_ids);
    }

}
