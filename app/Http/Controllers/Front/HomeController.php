<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\FrontController;
use Illuminate\Http\Request;
use App\Repositories\RouteRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use App\Repositories\EventRepository;
use App\Services\DictionaryService;

class HomeController extends FrontController
{

    /**
     * @param Request           $request
     * @param RouteRepository   $routeRepository
     * @param EventRepository   $eventRepository
     * @param DictionaryService $dictionaryService
     *
     * @return Application|Factory|View
     */
    public function index(
        Request $request,
        RouteRepository $routeRepository,
        EventRepository $eventRepository,
        DictionaryService $dictionaryService
    ) {
        return view('front.home', [
            'routes' => $routeRepository->getListForHome(),
            'events' => $eventRepository->getListForHome(),
            'typeList' => $dictionaryService->getTypesList(),
            'transportList' => $dictionaryService->getTransportList(),
            'whomList' => $dictionaryService->getWhomList(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function redirectToHome() : RedirectResponse
    {
        return response()->redirectToRoute('front.home');
    }

}
