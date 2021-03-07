<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository extends Model
{

    /**
     * @param Model $hotel
     * @return Collection
     */
    public function getSocialLinks(Model $hotel) : Collection
    {
        return $hotel
            ->socialFields()
            ->where('field', 'social_links')
            ->where('type', 'site')
            ->get();
    }

    /**
     * @param Model $hotel
     * @return Collection
     */
    public function getAggregatorLinks(Model $hotel) : Collection
    {
        return $hotel
            ->socialFields()
            ->where('field', 'aggregator_links')
            ->where('type', 'site')
            ->get();
    }

    /**
     * @param Model $hotel
     * @return Collection
     */
    public function getPhones(Model $hotel) : Collection
    {
        return $hotel
            ->socialFields()
            ->where('field', 'phones')
            ->where('type', 'phone')
            ->get();
    }

}
