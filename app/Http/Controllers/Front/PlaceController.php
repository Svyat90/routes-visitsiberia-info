<?php

namespace App\Http\Controllers\Front;

use App\Services\PlaceService;
use App\Services\DictionaryService;
use App\Helpers\CollectionHelper;
use App\Http\Requests\Front\Places\IndexPlaceRequest;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\FrontController;

class PlaceController extends FrontController
{

    /**
     * @var PlaceService
     */
    private PlaceService $service;

    /**
     * PlaceController constructor.
     *
     * @param PlaceService $service
     */
    public function __construct(PlaceService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function index(IndexPlaceRequest $request, DictionaryService $dictionaryService)
    {
        $typeList = $dictionaryService->getTypesList();
        $seasonList = $dictionaryService->getSeasonList();
        $categoryList = $dictionaryService->getCategoryPlaceList();
        $whomList = $dictionaryService->getWhomList();
        $data = $this->service->repository->getCollectionToIndex();

        $places = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'season_id' => $request->season_id,
                'category_id' => $request->category_id,
                'whom_id' => $request->whom_id
            ]);

        $geoData = $data->map(function (Place $place) {
            return ['lat' => $place->lat, 'lng' => $place->lng];
        });

        return view('front.places.index', compact(
            'places',
            'typeList',
            'seasonList',
            'categoryList',
            'whomList',
            'geoData'
        ));
    }

    /**
     * @param Request $request
     * @param Place   $place
     *
     * @return Application|Factory|View
     */
    public function show(Request $request, Place $place)
    {
        return view('front.places.show', compact('place'));
    }

}
