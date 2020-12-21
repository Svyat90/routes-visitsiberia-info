<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\MealService;
use Illuminate\Http\Request;
use App\Services\DictionaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Models\Meal;
use App\Helpers\CollectionHelper;

class MealController extends FrontController
{
    /**
     * @var MealService
     */
    private MealService $service;

    /**
     * MealController constructor.
     *
     * @param MealService $service
     */
    public function __construct(MealService $service)
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

        $geoData = $data->map(function (Meal $meal) {
            return ['lat' => $meal->lat, 'lng' => $meal->lng, 'name' => $meal->name];
        });

        $meals = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'type_id' => $request->type_id,
                'season_id' => $request->season_id,
                'category_id' => $request->category_id,
                'whom_id' => $request->whom_id
            ]);

        return view('front.meals.index', compact(
            'meals',
            'geoData'
        ));
    }

    /**
     * @param Request $request
     * @param Meal    $meal
     *
     * @return Application|Factory|View
     */
    public function show(Request $request, Meal $meal)
    {
        return view('front.meals.show', compact('meal'));
    }
}
