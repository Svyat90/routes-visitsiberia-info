<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\BaseService;
use App\Services\MealService;
use Illuminate\Http\Request;
use App\Services\DictionaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Models\Meal;
use App\Helpers\CollectionHelper;
use App\Http\Requests\Front\Meals\IndexMealRequest;

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
     * @param IndexMealRequest  $request
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(IndexMealRequest $request, DictionaryService $dictionaryService)
    {
        $cityList = $dictionaryService->getCityList();
        $categoryList = $dictionaryService->getCategoryFoodList();
        $deliveryList = $dictionaryService->getDeliveryFoodList();

        $data = $this->service->getFilteredMeals($request);

        $ids = array_map(function ($model) {
            return $model['id'];
        }, $data->toArray());

        $geoData = BaseService::getListGeoData(Meal::make(), $ids);

        $meals = CollectionHelper::paginate($data, $this->pageLimit)
            ->appends([
                'city_id' => $request->city_id,
                'category_id' => $request->category_id,
                'delivery_id' => $request->delivery_id,
                'have_breakfasts' => $request->have_breakfasts,
            ]);

        return view('front.meals.index', compact(
            'meals',
            'cityList',
            'categoryList',
            'deliveryList',
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
        $meal->load('reviews', 'reviews.replies');

        [$events, $hotels, $places, $nearGeoData] = $this->service->getNearData($meal);

        $socialLinks = $this->service->repository->getSocialLinks($meal);
        $aggregatorLinks = $this->service->repository->getAggregatorLinks($meal);
        $phones = $this->service->repository->getPhones($meal);

        return view('front.meals.show', compact(
            'meal',
            'events',
            'hotels',
            'places',
            'nearGeoData',
            'socialLinks',
            'aggregatorLinks',
            'phones'
        ));
    }
}
