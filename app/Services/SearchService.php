<?php

namespace App\Services;

use App\Helpers\LabelHelper;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Route;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Collection;
use \Illuminate\Database\Eloquent\Builder;

class SearchService
{

    /**
     * @param string $query
     * @return array
     */
    public function search(string $query) : array
    {
        return collect()
            ->push(['routes' => $this->searchEntity(new Route, $query)])
            ->push(['places' => $this->searchEntity(new Place, $query)])
            ->push(['hotels' => $this->searchEntity(new Hotel, $query)])
            ->push(['meals' => $this->searchEntity(new Meal, $query)])
            ->push(['events' => $this->searchEntity(new Event, $query)])
            ->collapse()
            ->toArray();
    }

    /**
     * @param Model $model
     * @param string $query
     * @return Builder[]|Collection
     */
    private function searchEntity(Model $model, string $query)
    {
        $locale = app()->getLocale();

        return $model::query()
            ->whereRaw("json_unquote(json_extract(`name`, '$.\"{$locale}\"')) LIKE '%" . $query . "%';")
            ->get([
                'id', 'name', 'city'
            ]);
    }

}
