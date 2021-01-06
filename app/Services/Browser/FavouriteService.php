<?php

namespace App\Services\Browser;

use App\Helpers\CookieHelper;
use App\Http\Requests\Front\Pages\IndexFavouritesRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class FavouriteService extends BrowserService
{

    /**
     * @param IndexFavouritesRequest $request
     * @return Collection
     */
    public function getFavouritesData(IndexFavouritesRequest $request) : Collection
    {
        if ($request->has('type')) {
            $favouriteTypeData = CookieHelper::getFavourites($request->type);
            $nameRepository = Str::singular($request->type) . 'Repository';

            return $this->$nameRepository->getListByIds($favouriteTypeData);
        }

        $favouriteData = CookieHelper::getFavourites();

        return $this->generateData($favouriteData);
    }

}
