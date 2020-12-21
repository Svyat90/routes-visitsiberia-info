<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Places\StorePlaceRequest;
use App\Http\Requests\Admin\Places\UpdatePlaceRequest;
use App\Http\Requests\Admin\Places\MassDestroyPlaceRequest;
use App\Services\PlaceService;
use App\Repositories\DictionaryRepository;

class PlaceController extends AdminController
{
    /**
     * @var PlaceService
     */
    private PlaceService $service;

    /**
     * PlaceController constructor.
     *
     * @param PlaceService    $service
     */
    public function __construct(PlaceService $service)
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
        return view('admin.places.index');
    }

    /**
     * @param Place          $place
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return View
     */
    public function create(Place $place, DictionaryRepository $dictionaryRepository) : View
    {
        $dictionaryChildren = $dictionaryRepository->getChildrenForSelect();
        return view('admin.places.create', compact('place', 'dictionaryChildren'));
    }

    /**
     * @param StorePlaceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePlaceRequest $request)
    {
        $place = $this->service->createPlace($request);

        return redirect()->route('admin.places.show', $place->id);
    }

    /**
     * @param Place $place
     *
     * @return Application|Factory|View
     */
    public function show(Place $place)
    {
        $place->load('dictionaries');

        return view('admin.places.show', compact('place'));
    }

    /**
     * @param Place                $place
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return Application|Factory|View
     */
    public function edit(Place $place, DictionaryRepository $dictionaryRepository)
    {
        return view('admin.places.edit', [
            'place' => $place,
            'dictionaryChildren' => $dictionaryRepository->getChildrenForSelect(),
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($place)
        ]);
    }

    /**
     * @param UpdatePlaceRequest $request
     * @param Place              $place
     *
     * @return RedirectResponse
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place = $this->service->updatePlace($request, $place);

        return redirect()->route('admin.places.show', $place->id);
    }

    /**
     * @param Place $place
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Place $place) : RedirectResponse
    {
        $place->delete();

        return back();
    }

    /**
     * @param MassDestroyPlaceRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyPlaceRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
