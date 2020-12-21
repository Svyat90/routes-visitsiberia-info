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
     * @param Meal $meal
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Meal $meal) : array
    {
        return $meal
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
        $meal = new Meal($data);
        $meal->slug = SlugHelper::generate(new Meal(), $data['name']);
        $meal->save();

        return $meal->refresh();
    }

    /**
     * @param array    $data
     * @param Meal $meal
     *
     * @return Meal
     */
    public function updateData(array $data, Meal $meal) : Meal
    {
        $meal->slug = SlugHelper::generate(new Meal(), $data['name']);
        $meal->update($data);

        return $meal->refresh();
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
            ->each(function (Meal $meal) {
                $meal->delete();
            });
    }

}
