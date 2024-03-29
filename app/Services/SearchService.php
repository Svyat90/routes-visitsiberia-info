<?php

namespace App\Services;

use App\Helpers\YandexGeoHelper;
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
            ->whereRaw("LOWER(json_extract(`name`, '$.\"{$locale}\"')) LIKE '%" . mb_strtolower($query) . "%';")
            ->get(['id', 'name', 'city', 'lng', 'lat'])
            ->map(function ($model) {
                $model->averageRating = $model->averageRating() ?? 0;
                if (! $model->city) {
                    $model->city = [
                        'ru' => '',
                        'en' => ''
                    ];
                }
                $model->geoLink = YandexGeoHelper::yandexMapLink($model->lng, $model->lat);
                return $model;
            });
    }

}
