<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\FrontController;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class SearchController extends FrontController
{
    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        return view('front.pages.search');
    }

    /**
     * @param Request $request
     * @param SearchService $searchService
     * @return array
     */
    public function search(Request $request, SearchService $searchService) : array
    {
        return $searchService->search($request->input('query'));
    }

}
