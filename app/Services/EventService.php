<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Events\StoreEventRequest;
use App\Http\Requests\Admin\Events\UpdateEventRequest;
use App\Models\Event;
use App\Repositories\EventRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\MediaHelper;
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
            ->addColumn('eventholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('slug', fn ($row) => $row->slug)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('recommended', fn ($row) => LabelHelper::boolLabel($row->recommended))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'events'))
            ->rawColumns(['actions', 'eventholder', 'active', 'recommended', 'image'])
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

        return $this->repository->updateData($request->validated(), $event);
    }

    /**
     * @param StoreEventRequest|UpdateEventRequest   $request
     * @param Event $event
     */
    private function handleMediaFiles($request, Event $event) : void
    {
        MediaHelper::handleMedia($event, 'image', $request->image);
        MediaHelper::handleMedia($event, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($event, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Event $event
     * @param StoreEventRequest|UpdateEventRequest $request
     */
    private function handleRelationships(Event $event, $request) : void
    {
        $event->dictionaries()->sync($request->dictionary_ids);
    }

}
