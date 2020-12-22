<?php

namespace App\Repositories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Helpers\SlugHelper;

class PlaceRepository extends Model
{

    /**
     * @return Collection
     */
    public function getListForHome() : Collection
    {
        return Place::query()
            ->oldest()
            ->limit(6)
            ->get();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Place::query()
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
        return Place::query()
            ->get()
            ->map(function (Place $place) {
                $key = 'place_' . $place->id;
                $val = $place->name . ' (' . __('global.places') . ')';
                return [$key => $val];
            })->collapse();
    }

    /**
     * @param Place $place
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Place $place) : array
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
        return Place::query()
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCollectionToExport() : Collection
    {
        return Place::query()
            ->with('dictionaries')
            ->latest()
            ->get();
    }

    /**
     * @param array $data
     *
     * @return Place
     */
    public function savePlace(array $data) : Place
    {
        $place = new Place($data);
        $place->slug = SlugHelper::generate(new Place(), $data['name']);
        $place->save();

        return $place->refresh();
    }

    /**
     * @param array    $data
     * @param Place $place
     *
     * @return Place
     */
    public function updateData(array $data, Place $place) : Place
    {
        $place->slug = SlugHelper::generate(new Place(), $data['name']);
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
        Place::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Place $place) {
                $place->delete();
            });
    }

}
