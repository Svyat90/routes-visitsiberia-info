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

class MealService
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
            ->addColumn('mealholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('slug', fn ($row) => $row->slug)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('recommended', fn ($row) => LabelHelper::boolLabel($row->recommended))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'meals'))
            ->rawColumns(['actions', 'mealholder', 'active', 'recommended', 'image'])
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

        return $this->repository->updateData($request->validated(), $meal);
    }

    /**
     * @param StoreMealRequest|UpdateMealRequest   $request
     * @param Meal $meal
     */
    private function handleMediaFiles($request, Meal $meal) : void
    {
        MediaHelper::handleMedia($meal, 'image', $request->image);
        MediaHelper::handleMedia($meal, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($meal, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Meal $meal
     * @param StoreMealRequest|UpdateMealRequest $request
     */
    private function handleRelationships(Meal $meal, $request) : void
    {
        $meal->dictionaries()->sync($request->dictionary_ids);
    }

}
