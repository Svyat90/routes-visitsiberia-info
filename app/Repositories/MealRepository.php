<?php

namespace App\Repositories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Helpers\SlugHelper;

class MealRepository extends Model
{

    /**
     * @return Collection
     */
    public function getListForHome() : Collection
    {
        return Meal::query()
            ->oldest()
            ->limit(6)
            ->get();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Meal::query()
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                return $items->shift()->name;
            });
    }

    /**
     * @return Collection
     */
    public function getListForRoutable()
    {
        return Meal::query()
            ->get()
            ->map(function (Meal $meal) {
                $key = 'meal_' . $meal->id;
                $val = $meal->name . ' (' . __('global.meals') . ')';
                return [$key => $val];
            })->collapse();
    }

    /**
     * @param Meal $place
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Meal $place) : array
    {
        return $place
            ->dictionaries
            ->pluck('id')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return Meal::query()
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCollectionToExport() : Collection
    {
        return Meal::query()
            ->with('dictionaries')
            ->latest()
            ->get();
    }

    /**
     * @param array $data
     *
     * @return Meal
     */
    public function saveMeal(array $data) : Meal
    {
        $place = new Meal($data);
        $place->slug = SlugHelper::generate(new Meal(), $data['name']);
        $place->save();

        return $place->refresh();
    }

    /**
     * @param array    $data
     * @param Meal $place
     *
     * @return Meal
     */
    public function updateData(array $data, Meal $place) : Meal
    {
        $place->slug = SlugHelper::generate(new Meal(), $data['name']);
        $place->update($data);

        return $place->refresh();
    }

    /**
     * @param array $ids
     *
     * @throws \Exception
     */
    public function deleteIds(array $ids) : void
    {
        Meal::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Meal $place) {
                $place->delete();
            });
    }

}
