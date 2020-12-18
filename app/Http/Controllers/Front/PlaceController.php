<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\PlaceService;

class PlaceController extends Controller
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
        $this->service = $service;
    }

    public function index()
    {
        $places = $this->service->repository->getCollectionToIndex();

        return view('front.places.index', compact('places'));
    }

    public function show()
    {
        return view('front.places.show');
    }

}
