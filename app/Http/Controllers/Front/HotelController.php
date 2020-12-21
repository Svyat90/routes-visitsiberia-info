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
     * @param Request           $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(Request $request, DictionaryService $dictionaryService)
    {
        $data = $this->service->repository->getCollectionToIndex();

        $geoData = $data->map(function (Hotel $hotel) {
            return ['lat' => $hotel->lat, 'lng' => $hotel->lng, 'name' => $hotel->name];
        });

        $hotels = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'season_id' => $request->season_id,
                'category_id' => $request->category_id,
                'whom_id' => $request->whom_id
            ]);

        return view('front.hotels.index', compact(
            'hotels',
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
        return view('front.hotels.show', compact('hotel'));
    }
}
