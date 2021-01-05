<?php

namespace App\Http\Controllers\Front;

use App\Helpers\CollectionHelper;
use App\Http\Requests\Front\Pages\IndexFavouritesRequest;
use App\Http\Controllers\FrontController;
use App\Services\FavouriteService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;

class FavouriteController extends FrontController
{

    /**
     * @param IndexFavouritesRequest $request
     * @param FavouriteService $favouriteService
     * @return Application|Factory|View
     */
    public function index(IndexFavouritesRequest $request, FavouriteService $favouriteService)
    {
        $favouritesData = $favouriteService->getFavouritesData($request);

        $data = CollectionHelper::paginate($favouritesData, $this->pageLimit)
            ->appends([
                'type' => $request->type
            ]);

        return view('front.pages.favourites', compact('data'));
    }

}
