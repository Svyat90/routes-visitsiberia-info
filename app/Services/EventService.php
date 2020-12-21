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

class EventService
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
        $hotel = $this->repository->saveEvent($request->all());

        $this->handleMediaFiles($request, $hotel);
        $this->handleRelationships($hotel, $request);

        return $hotel;
    }

    /**
     * @param UpdateEventRequest $request
     * @param Event              $hotel
     *
     * @return Event
     */
    public function updateEvent(UpdateEventRequest $request, Event $hotel) : Event
    {
        $this->handleMediaFiles($request, $hotel);
        $this->handleRelationships($hotel, $request);

        return $this->repository->updateData($request->all(), $hotel);
    }

    /**
     * @param StoreEventRequest|UpdateEventRequest   $request
     * @param Event $hotel
     */
    private function handleMediaFiles($request, Event $hotel) : void
    {
        MediaHelper::handleMedia($hotel, 'image', $request->image);
        MediaHelper::handleMedia($hotel, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($hotel, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Event $hotel
     * @param StoreEventRequest|UpdateEventRequest $request
     */
    private function handleRelationships(Event $hotel, $request) : void
    {
        $hotel->dictionaries()->sync($request->dictionary_ids);
    }
}
