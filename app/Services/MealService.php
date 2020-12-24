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
            ->editColumn('slug', fn ($row) => $row->slug)
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
        $place = $this->repository->saveMeal($request->all());

        $this->handleMediaFiles($request, $place);
        $this->handleRelationships($place, $request);

        return $place;
    }

    /**
     * @param UpdateMealRequest $request
     * @param Meal              $place
     *
     * @return Meal
     */
    public function updateMeal(UpdateMealRequest $request, Meal $place) : Meal
    {
        $this->handleMediaFiles($request, $place);
        $this->handleRelationships($place, $request);

        return $this->repository->updateData($request->all(), $place);
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
            ->filter(function (Meal $place) use ($request) {
                $dictionaryIds = $place->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
    }

    /**
     * @param Collection        $dictionaryIds
     * @param IndexMealRequest $request
     *
     * @return bool
     */
    private function setFilters(Collection $dictionaryIds, IndexMealRequest $request)
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
     * @param Meal $place
     */
    private function handleMediaFiles($request, Meal $place) : void
    {
        MediaHelper::handleMedia($place, 'image', $request->image);
        MediaHelper::handleMedia($place, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($place, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Meal $place
     * @param StoreMealRequest|UpdateMealRequest $request
     */
    private function handleRelationships(Meal $place, $request) : void
    {
        $place->dictionaries()->sync($request->dictionary_ids);
    }

}
