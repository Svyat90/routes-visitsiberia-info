<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Repositories\EventRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Events\StoreEventRequest;
use App\Models\Event;
use App\Http\Requests\Admin\Events\UpdateEventRequest;
use App\Helpers\MediaHelper;
use App\Helpers\LabelHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Collection;
use App\Http\Requests\Front\Events\IndexEventRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Helpers\SqlHelper;
use Illuminate\Support\Facades\DB;

class EventService extends BaseService
{

    /**
     * @var EventRepository
     */
    public EventRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getDatatablesData()
    {
        $collection = $this->repository->getCollectionToIndex();

        return Datatables::of($collection)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('slug', fn ($row) => $row->slug)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('have_camping', fn ($row) => LabelHelper::boolLabel($row->have_camping))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'events'))
            ->rawColumns(['actions', 'placeholder', 'active', 'have_camping', 'image'])
            ->make(true);
    }

    /**
     * @param StoreEventRequest $request
     *
     * @return Event
     */
    public function createEvent(StoreEventRequest $request) : Event
    {
        $event = $this->repository->saveEvent($request->all());

        $this->handleMediaFiles($request, $event);
        $this->handleRelationships($event, $request);
        $this->handleCityDictionary($event);

        return $event;
    }

    /**
     * @param UpdateEventRequest $request
     * @param Event              $event
     *
     * @return Event
     */
    public function updateEvent(UpdateEventRequest $request, Event $event) : Event
    {
        $this->handleMediaFiles($request, $event);
        $this->handleRelationships($event, $request);

        return $this->repository->updateData($request->all(), $event);
    }

    /**
     * @param IndexEventRequest $request
     *
     * @return Collection
     */
    public function getFilteredEvents(IndexEventRequest $request) : Collection
    {
        /** @var Builder $queryBuilder */
        $queryBuilder =  Event::query()->active();

        return $queryBuilder->get()
            ->filter(function (Event $event) use ($request) {
                $dictionaryIds = $event->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
    }

    /**
     * @param Event $event
     *
     * @return array
     */
    public function getNearData(Event $event)
    {
        $hotels = $this->getNearObjects('hotels', $event->lat, $event->lng);
        $places = $this->getNearObjects('places', $event->lat, $event->lng);
        $meals = $this->getNearObjects('meals', $event->lat, $event->lng);

        $geoData = $hotels
            ->merge($meals)
            ->merge($places);

        return [$hotels, $meals, $places, $geoData];
    }

    /**
     * @param Collection        $dictionaryIds
     * @param IndexEventRequest $request
     *
     * @return bool
     */
    private function setFilters(Collection $dictionaryIds, IndexEventRequest $request)
    {
        $this->setDictionaryIds($dictionaryIds);

        return $this->filterDictionaries(
            $request->city_id,
            $request->whom_id,
            $request->season_id
        );
    }

    /**
     * @param StoreEventRequest|UpdateEventRequest   $request
     * @param Event $event
     */
    private function handleMediaFiles($request, Event $event) : void
    {
        MediaHelper::handleMedia($event, 'image', $request->image);
        MediaHelper::handleMediaCollect($event, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Event $event
     * @param StoreEventRequest|UpdateEventRequest $request
     */
    private function handleRelationships(Event $event, $request) : void
    {
        $event->dictionaries()->sync($request->dictionary_ids);

        if ($request instanceof UpdateEventRequest) {
            $event->socialFields()->delete();
        }

        $this->saveSocialLinks($event, $request);
        $this->saveAdditionalLinks($event, $request);
        $this->savePhoneLinks($event, $request);
        $this->saveAddresses($event, $request);
    }
}
