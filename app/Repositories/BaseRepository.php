<?php

namespace App\Repositories;

use App\Helpers\YandexGeoHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository extends Model
{

    /**
     * @param $lng
     * @param $lat
     * @return array
     */
    protected function detectCity($lng, $lat) : array
    {
        $city = YandexGeoHelper::getAddress($lng, $lat);
        if (! $city) {
            return [
                'ru' => null,
                'en' => null
            ];;
        }

        return [
            'ru' => $city,
            'en' => $city
        ];
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getSocialLinks(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'social_links')
            ->where('type', 'site')
            ->get();
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getAggregatorLinks(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'aggregator_links')
            ->where('type', 'site')
            ->get();
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getPhones(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'phones')
            ->where('type', 'phone')
            ->get();
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getPhoneLinks(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'link_phones')
            ->where('type', 'phone')
            ->get();
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getAdditionalLinks(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'additional_links')
            ->where('type', 'site')
            ->get();
    }

    /**
     * @param Model $model
     * @return Collection
     */
    public function getAddresses(Model $model) : Collection
    {
        return $model
            ->socialFields()
            ->where('field', 'addresses')
            ->where('type', 'site')
            ->get();
    }
}
