<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use App\Services\DictionaryService;
use App\Models\Event;
use App\Helpers\CollectionHelper;
use App\Services\EventService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Front\Events\IndexEventRequest;

class EventController extends FrontController
{
    /**
     * @var EventService
     */
    private EventService $service;

    /**
     * EventController constructor.
     *
     * @param EventService $service
     */
    public function __construct(EventService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param IndexEventRequest $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(IndexEventRequest $request, DictionaryService $dictionaryService)
    {
        $cityList = $dictionaryService->getCityList();
        $whomList = $dictionaryService->getWhomList();

        $data = $this->service->getFilteredEvents($request);

        $geoData = $data->map(function (Event $event) {
            return ['lat' => $event->lat, 'lng' => $event->lng, 'name' => $event->name];
        });

        $events = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'city_id' => $request->city_id,
                'whom_id' => $request->whom_id,
                'date_from' => $request->date_from,
                'date_to' => $request->date_to,
            ]);

        return view('front.events.index', compact(
            'events',
            'cityList',
            'whomList',
            'geoData'
        ));
    }

    /**
     * @param Request $request
     * @param Event   $event
     *
     * @return Application|Factory|View
     */
    public function show(Request $request, Event $event)
    {
        [$hotels, $meals, $places, $nearGeoData] = $this->service->getNearData($event);

        return view('front.events.show', compact(
            'event',
            'hotels',
            'meals',
            'places',
            'nearGeoData'
        ));
    }

}
