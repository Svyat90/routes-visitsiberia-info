<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\BaseService;
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
        $seasonList = $dictionaryService->getSeasonList();

        $data = $this->service->getFilteredEvents($request);

        $ids = array_map(function ($model) {
            return $model['id'];
        }, $data->toArray());

        $geoData = BaseService::getListGeoData(Event::make(), $ids);

        $events = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'city_id' => $request->city_id,
                'whom_id' => $request->whom_id,
                'season_id' => $request->season_id
            ]);

        return view('front.events.index', compact(
            'events',
            'cityList',
            'whomList',
            'seasonList',
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
        $event->load('reviews', 'reviews.replies');

        [$hotels, $meals, $places, $nearGeoData] = $this->service->getNearData($event);

        $socialLinks = $this->service->repository->getSocialLinks($event);
        $additionalLinks = $this->service->repository->getAdditionalLinks($event);
        $phoneLinks = $this->service->repository->getPhoneLinks($event);
        $addresses = $this->service->repository->getAddresses($event);

        return view('front.events.show', compact(
            'event',
            'hotels',
            'meals',
            'places',
            'nearGeoData',
            'socialLinks',
            'additionalLinks',
            'phoneLinks',
            'addresses'
        ));
    }

}
