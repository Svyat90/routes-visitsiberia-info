<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Places\StorePlaceRequest;
use App\Http\Requests\Admin\Places\UpdatePlaceRequest;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\MediaHelper;
use App\Helpers\ImageHelper;
use App\Http\Requests\Front\Places\IndexPlaceRequest;
use Illuminate\Support\Collection;

class PlaceService extends BaseService
{
    /**
     * @var PlaceRepository
     */
    public PlaceRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param PlaceRepository $repository
     */
    public function __construct(PlaceRepository $repository)
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
            ->editColumn('recommended', fn ($row) => LabelHelper::boolLabel($row->recommended))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'places'))
            ->rawColumns(['actions', 'placeholder', 'active', 'recommended', 'image'])
            ->make(true);
    }

    /**
     * @param StorePlaceRequest $request
     *
     * @return Place
     */
    public function createPlace(StorePlaceRequest $request) : Place
    {
        $place = $this->repository->savePlace($request->all());

        $this->handleMediaFiles($request, $place);
        $this->handleRelationships($place, $request);

        return $place;
    }

    /**
     * @param UpdatePlaceRequest $request
     * @param Place              $place
     *
     * @return Place
     */
    public function updatePlace(UpdatePlaceRequest $request, Place $place) : Place
    {
        $this->handleMediaFiles($request, $place);
        $this->handleRelationships($place, $request);

        return $this->repository->updateData($request->all(), $place);
    }

    /**
     * @param IndexPlaceRequest $request
     *
     * @return Collection
     */
    public function getFilteredPlaces(IndexPlaceRequest $request) : Collection
    {
        return Place::query()
            ->active()
            ->get()
            ->filter(function (Place $place) use ($request) {
                $dictionaryIds = $place->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
    }

    /**
     * @param Collection        $dictionaryIds
     * @param IndexPlaceRequest $request
     *
     * @return bool
     */
    private function setFilters(Collection $dictionaryIds, IndexPlaceRequest $request)
    {
        $this->setDictionaryIds($dictionaryIds);

        return $this->filterDictionaries(
            $request->type_id,
            $request->category_id,
            $request->whom_id,
            $request->season_id
        );
    }

    /**
     * @param StorePlaceRequest|UpdatePlaceRequest   $request
     * @param Place $place
     */
    private function handleMediaFiles($request, Place $place) : void
    {
        MediaHelper::handleMedia($place, 'image', $request->image);
        MediaHelper::handleMedia($place, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($place, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Place $place
     * @param StorePlaceRequest|UpdatePlaceRequest $request
     */
    private function handleRelationships(Place $place, $request) : void
    {
        $place->dictionaries()->sync($request->dictionary_ids);
    }

}
