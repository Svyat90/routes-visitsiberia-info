<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Models\Hotel;
use App\Services\DictionaryService;
use App\Services\HotelService;
use App\Helpers\CollectionHelper;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Front\Hotels\IndexHotelRequest;

class HotelController extends FrontController
{
    /**
     * @var HotelService
     */
    private HotelService $service;

    /**
     * HotelController constructor.
     *
     * @param HotelService $service
     */
    public function __construct(HotelService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param IndexHotelRequest $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(IndexHotelRequest $request, DictionaryService $dictionaryService)
    {
        $cityList = $dictionaryService->getCityList();
        $distanceList = $dictionaryService->getDistanceList();
        $placementList = $dictionaryService->getPlacementList();

        $data = $this->service->getFilteredHotels($request);

        $geoData = $data->map(function (Hotel $hotel) {
            return ['lat' => $hotel->lat, 'lng' => $hotel->lng, 'name' => $hotel->name];
        });

        $hotels = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'city_id' => $request->city_id,
                'distance_id' => $request->distance_id,
                'placement_id' => $request->placement_id
            ]);

        return view('front.hotels.index', compact(
            'hotels',
            'cityList',
            'distanceList',
            'placementList',
            'geoData'
        ));
    }

    /**
     * @param Request $request
     * @param Hotel   $hotel
     *
     * @return Application|Factory|View
     */
    public function show(Request $request, Hotel $hotel)
    {
        $hotel->load('reviews', 'reviews.replies');

        [$events, $meals, $places, $nearGeoData] = $this->service->getNearData($hotel);

        $socialLinks = $this->service->repository->getSocialLinks($hotel);
        $aggregatorLinks = $this->service->repository->getAggregatorLinks($hotel);
        $phones = $this->service->repository->getPhones($hotel);

        return view('front.hotels.show', compact(
            'hotel',
            'events',
            'meals',
            'places',
            'nearGeoData',
            'socialLinks',
            'aggregatorLinks',
            'phones'
        ));
    }
}
