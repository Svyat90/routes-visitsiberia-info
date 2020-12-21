<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Meal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Meals\StoreMealRequest;
use App\Http\Requests\Admin\Meals\UpdateMealRequest;
use App\Http\Requests\Admin\Meals\MassDestroyMealRequest;
use App\Services\MealService;
use App\Repositories\DictionaryRepository;

class MealController extends AdminController
{
    /**
     * @var MealService
     */
    private MealService $service;

    /**
     * MealController constructor.
     *
     * @param MealService    $service
     */
    public function __construct(MealService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatablesData();
        }

        return view('admin.meals.index');
    }

    /**
     * @param Meal          $meal
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return View
     */
    public function create(Meal $meal, DictionaryRepository $dictionaryRepository) : View
    {
        $dictionaryChildren = $dictionaryRepository->getChildrenForSelect();

        return view('admin.meals.create', compact('meal', 'dictionaryChildren'));
    }

    /**
     * @param StoreMealRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreMealRequest $request)
    {
        $meal = $this->service->createMeal($request);

        return redirect()->route('admin.meals.show', $meal->id);
    }

    /**
     * @param Meal $meal
     *
     * @return Application|Factory|View
     */
    public function show(Meal $meal)
    {
        $meal->load('dictionaries');

        return view('admin.meals.show', compact('meal'));
    }

    /**
     * @param Meal                $meal
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return Application|Factory|View
     */
    public function edit(Meal $meal, DictionaryRepository $dictionaryRepository)
    {
        return view('admin.meals.edit', [
            'meal' => $meal,
            'dictionaryChildren' => $dictionaryRepository->getChildrenForSelect(),
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($meal)
        ]);
    }

    /**
     * @param UpdateMealRequest $request
     * @param Meal              $meal
     *
     * @return RedirectResponse
     */
    public function update(UpdateMealRequest $request, Meal $meal)
    {
        $meal = $this->service->updateMeal($request, $meal);

        return redirect()->route('admin.meals.show', $meal->id);
    }

    /**
     * @param Meal $meal
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Meal $meal) : RedirectResponse
    {
        $meal->delete();

        return back();
    }

    /**
     * @param MassDestroyMealRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyMealRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
