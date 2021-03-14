<?php

namespace App\Http\Controllers\Front;

use App\Services\BaseService;
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

    /**
     * @param IndexPlaceRequest $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(IndexPlaceRequest $request, DictionaryService $dictionaryService)
    {
        $typeList = $dictionaryService->getTypesList();
        $seasonList = $dictionaryService->getSeasonList();
        $categoryList = $dictionaryService->getCategoryPlaceList();
        $whomList = $dictionaryService->getWhomList();

        $data = $this->service->getFilteredPlaces($request);

        $ids = array_map(function ($model) {
            return $model['id'];
        }, $data->toArray());

        $geoData = BaseService::getListGeoData(Place::make(), $ids);

        $places = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'season_id' => $request->season_id,
                'category_id' => $request->category_id,
                'whom_id' => $request->whom_id
            ]);

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
        $place->load('reviews', 'reviews.replies');

        [$events, $meals, $hotels, $nearGeoData] = $this->service->getNearData($place);

        $socialLinks = $this->service->repository->getSocialLinks($place);
        $additionalLinks = $this->service->repository->getAdditionalLinks($place);
        $phoneLinks = $this->service->repository->getPhoneLinks($place);

        return view('front.places.show', compact(
            'place',
            'events',
            'meals',
            'hotels',
            'nearGeoData',
            'socialLinks',
            'additionalLinks',
            'phoneLinks'
        ));
    }

}
