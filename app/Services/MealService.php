<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Meals\StoreMealRequest;
use App\Http\Requests\Admin\Meals\UpdateMealRequest;
use App\Models\Meal;
use App\Repositories\MealRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\MediaHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Collection;
use App\Http\Requests\Front\Meals\IndexMealRequest;

class MealService extends BaseService
{
    /**
     * @var MealRepository
     */
    public MealRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param MealRepository $repository
     */
    public function __construct(MealRepository $repository)
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
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'meals'))
            ->rawColumns(['actions', 'placeholder', 'active', 'recommended', 'image'])
            ->make(true);
    }

    /**
     * @param StoreMealRequest $request
     *
     * @return Meal
     */
    public function createMeal(StoreMealRequest $request) : Meal
    {
        $meal = $this->repository->saveMeal($request->all());

        $this->handleMediaFiles($request, $meal);
        $this->handleRelationships($meal, $request);

        return $meal;
    }

    /**
     * @param UpdateMealRequest $request
     * @param Meal              $meal
     *
     * @return Meal
     */
    public function updateMeal(UpdateMealRequest $request, Meal $meal) : Meal
    {
        $this->handleMediaFiles($request, $meal);
        $this->handleRelationships($meal, $request);

        return $this->repository->updateData($request->all(), $meal);
    }

    /**
     * @param IndexMealRequest $request
     *
     * @return Collection
     */
    public function getFilteredMeals(IndexMealRequest $request) : Collection
    {
        return Meal::query()
            ->active()
            ->get()
            ->filter(function (Meal $meal) use ($request) {
                $dictionaryIds = $meal->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
    }

    /**
     * @param Meal $meal
     *
     * @return array
     */
    public function getNearData(Meal $meal)
    {
        $events = $this->getNearObjects('events', $meal->lat, $meal->lng);
        $places = $this->getNearObjects('places', $meal->lat, $meal->lng);
        $hotels = $this->getNearObjects('hotels', $meal->lat, $meal->lng);

        $geoData = $events
            ->merge($hotels)
            ->merge($places);

        return [$events, $hotels, $places, $geoData];
    }

    /**
     * @param Collection        $dictionaryIds
     * @param IndexMealRequest $request
     *
     * @return bool
     */
    private function setFilters(Collection $dictionaryIds, IndexMealRequest $request) : bool
    {
        $this->setDictionaryIds($dictionaryIds);

        return $this->filterDictionaries(
            $request->category_id,
            $request->season_id,
            $request->delivery_id
        );
    }

    /**
     * @param StoreMealRequest|UpdateMealRequest   $request
     * @param Meal $meal
     */
    private function handleMediaFiles($request, Meal $meal) : void
    {
        MediaHelper::handleMedia($meal, 'image', $request->image);
        MediaHelper::handleMediaCollect($meal, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Meal $meal
     * @param StoreMealRequest|UpdateMealRequest $request
     */
    private function handleRelationships(Meal $meal, $request) : void
    {
        $meal->dictionaries()->sync($request->dictionary_ids);

        if ($request instanceof UpdateMealRequest) {
            $meal->socialFields()->delete();
        }

        $this->saveSocialLinks($meal, $request);
        $this->saveAggregatorLinks($meal, $request);
        $this->savePhones($meal, $request);
    }

}
