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
     * @param IndexEventRequest $request
     *
     * @return Collection
     */
    public function getFilteredEvents(IndexEventRequest $request) : Collection
    {
        /** @var Builder $queryBuilder */
        $queryBuilder =  Event::query()->active();

//        if ($request->date_from && $request->date_to) {
//            $queryBuilder->where(function (Builder $builder) use ($request) {
//                $builder->where(function (Builder $builder) use ($request) {
//                    $builder->whereDate('date_from', '>=', DB::raw($request->date_from));
//                    $builder->whereDate('date_from', '<=', DB::raw($request->date_to));
//                });
//
//                $builder->orWhere(function (Builder $builder) use ($request) {
//                    $builder->whereDate('date_to', '<=', DB::raw($request->date_to));
//                    $builder->whereDate('date_to', '>=', DB::raw($request->date_from));
//                });
//            });
//        }
//        dd(
//            date('d-m-Y', $request->date_from), $request->date_from,
//            date('d-m-Y', $request->date_to), $request->date_to,
//            Event::query()->first()->date_from->format('d-m-Y'),
//            Event::query()->first()->date_to->format('d-m-Y'),
//            SqlHelper::getSql($queryBuilder),
//        );

        return $queryBuilder->get()
            ->filter(function (Event $place) use ($request) {
                $dictionaryIds = $place->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
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
        );
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
