<?php

namespace App\Repositories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Helpers\SlugHelper;

class HotelRepository extends Model
{

    /**
     * @return Collection
     */
    public function getListForHome() : Collection
    {
        return Hotel::query()
            ->oldest()
            ->limit(6)
            ->get();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Hotel::query()
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
        return Hotel::query()
            ->get()
            ->map(function (Hotel $hotel) {
                $key = 'hotel_' . $hotel->id;
                $val = $hotel->name . ' (' . __('global.hotels') . ')';
                return [$key => $val];
            })->collapse();
    }

    /**
     * @param Hotel $hotel
     *
     * @return array
     */
    public function getRelatedDictionaryIds(Hotel $hotel) : array
    {
        return $hotel
            ->dictionaries
            ->pluck('id')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return Hotel::query()
            ->latest()
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCollectionToExport() : Collection
    {
        return Hotel::query()
            ->with('dictionaries')
            ->latest()
            ->get();
    }

    /**
     * @param array $data
     *
     * @return Hotel
     */
    public function saveHotel(array $data) : Hotel
    {
        $hotel = new Hotel($data);
        $hotel->slug = SlugHelper::generate(new Hotel(), $data['name']);
        $hotel->save();

        return $hotel->refresh();
    }

    /**
     * @param array    $data
     * @param Hotel $hotel
     *
     * @return Hotel
     */
    public function updateData(array $data, Hotel $hotel) : Hotel
    {
        $hotel->slug = SlugHelper::generate(new Hotel(), $data['name']);
        $hotel->update($data);

        return $hotel->refresh();
    }

    /**
     * @param array $ids
     *
     * @throws \Exception
     */
    public function deleteIds(array $ids) : void
    {
        Hotel::query()
            ->whereIn('id', $ids)
            ->get()
            ->each(function (Hotel $hotel) {
                $hotel->delete();
            });
    }

}
