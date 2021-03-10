<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Places\StorePlaceRequest;
use App\Http\Requests\Admin\Places\UpdatePlaceRequest;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use Illuminate\Database\Eloquent\Model;
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
     * @param Place $place
     *
     * @return array
     */
    public function getNearData(Place $place)
    {
        $events = $this->getNearObjects('events', $place->lat, $place->lng);
        $meals = $this->getNearObjects('meals', $place->lat, $place->lng);
        $hotels = $this->getNearObjects('hotels', $place->lat, $place->lng);

        $geoData = $events
            ->merge($meals)
            ->merge($hotels);

        return [$events, $meals, $hotels, $geoData];
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

        if ($request instanceof UpdatePlaceRequest) {
            $place->socialFields()->delete();
        }

        $this->saveSocialLinks($place, $request);
        $this->saveAdditionalLinks($place, $request);
        $this->savePhoneLinks($place, $request);
    }

    /**
     * @param Model $model
     * @param $request
     */
    private function saveAdditionalLinks(Model $model, $request) : void
    {
        if (! $request->additional_links) {
            return;
        }

        $urls = $request->additional_links['url'];
        $texts = $request->additional_links['title'];
        $types = $request->additional_links['type'];

        $insertData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'additional_links'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    private function savePhoneLinks(Model $model, $request) : void
    {
        if (! $request->link_phones) {
            return;
        }

        $urls = $request->link_phones['url'];
        $texts = $request->link_phones['title'];
        $types = $request->link_phones['type'];

        $insertData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'link_phones'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertData));
    }

}
