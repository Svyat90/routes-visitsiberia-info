<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Route;
use App\Services\DictionaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Routes\StoreRouteRequest;
use App\Http\Requests\Admin\Routes\UpdateRouteRequest;
use App\Http\Requests\Admin\Routes\MassDestroyRouteRequest;
use App\Services\RouteService;

class RouteController extends AdminController
{
    /**
     * @var RouteService
     */
    private RouteService $service;

    /**
     * RouteController constructor.
     *
     * @param RouteService    $service
     */
    public function __construct(RouteService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatablesData();
        }

        return view('admin.routes.index');
    }

    /**
     * @param DictionaryService $dictionaryService
     * @return View
     */
    public function create(DictionaryService $dictionaryService) : View
    {
        $routableList = $this->service->getRoutableList();

        return view('admin.routes.create', [
            'routableList' => $routableList,
            'placeList' => $dictionaryService->getCategoryPlaceList(),
            'seasonList' => $dictionaryService->getSeasonList(),
            'typesList' => $dictionaryService->getTypesList(),
            'whomList' => $dictionaryService->getWhomList()
        ]);
    }

    /**
     * @param StoreRouteRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRouteRequest $request)
    {
        $route = $this->service->createRoute($request);

        return redirect()->route('admin.routes.show', $route->id);
    }

    /**
     * @param Route        $route
     *
     * @return Application|Factory|View
     */
    public function show(Route $route)
    {
        $route->load('dictionaries', 'socialFields');

        $socialLinks = $this->service->repository->getSocialLinks($route);
        $additionalLinks = $this->service->repository->getAdditionalLinks($route);
        $phoneLinks = $this->service->repository->getPhoneLinks($route);
        $addresses = $this->service->repository->getAddresses($route);
        $routableList = $this->service->getRoutableList();

        return view('admin.routes.show', compact('route', 'socialLinks', 'additionalLinks', 'phoneLinks', 'addresses', 'routableList'));
    }

    /**
     * @param Route $route
     * @param DictionaryService $dictionaryService
     * @return Application|Factory|View
     */
    public function edit(Route $route, DictionaryService $dictionaryService)
    {
        return view('admin.routes.edit', [
            'route' => $route,
            'placeList' => $dictionaryService->getCategoryPlaceList(),
            'seasonList' => $dictionaryService->getSeasonList(),
            'typesList' => $dictionaryService->getTypesList(),
            'whomList' => $dictionaryService->getWhomList(),
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($route),
            'routableList' => $this->service->getRoutableList(),
            'routableIds' => $this->service->repository->getRelatedRoutableIds($route)->toArray(),
            'socialLinks' => $this->service->repository->getSocialLinks($route),
            'additionalLinks' => $this->service->repository->getAdditionalLinks($route),
            'linkPhones' => $this->service->repository->getPhoneLinks($route),
            'addresses' => $this->service->repository->getAddresses($route),
        ]);
    }

    /**
     * @param UpdateRouteRequest $request
     * @param Route              $route
     *
     * @return RedirectResponse
     */
    public function update(UpdateRouteRequest $request, Route $route)
    {
        $route = $this->service->updateRoute($request, $route);

        return redirect()->route('admin.routes.show', $route->id);
    }

    /**
     * @param Route $route
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Route $route) : RedirectResponse
    {
        $route->delete();

        return back();
    }

    /**
     * @param MassDestroyRouteRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyRouteRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
