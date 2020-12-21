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
     * @param Request           $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(Request $request, DictionaryService $dictionaryService)
    {
        $data = $this->service->repository->getCollectionToIndex();

        $geoData = $data->map(function (Event $event) {
            return ['lat' => $event->lat, 'lng' => $event->lng, 'name' => $event->name];
        });

        $events = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'season_id' => $request->season_id,
                'category_id' => $request->category_id,
                'whom_id' => $request->whom_id
            ]);

        return view('front.events.index', compact(
            'events',
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
        return view('front.events.show', compact('event'));
    }

}
