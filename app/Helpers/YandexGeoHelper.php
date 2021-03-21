<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class YandexGeoHelper
{
    const GEOCODER_URL = 'https://geocode-maps.yandex.ru/1.x/';

    /**
     * @param $lng
     * @param $lat
     * @param int $zoom
     * @return string
     */
    public static function yandexMapLink($lng, $lat, int $zoom = 17) : string
    {
        if (! $lng || ! $lat) {
            return '';
        }

        return sprintf("https://yandex.ru/maps/?whatshere[point]=%s,%s&whatshere[zoom]=%d",
            $lng,
            $lat,
            $zoom
        );
    }

    /**
     * @param $lng
     * @param $lat
     * @return string
     */
    public static function getAddress($lng, $lat) : string
    {
        $queryData = [
            'apikey' => config('app.yandex_key'),
            'geocode' => "$lng,$lat",
            'format' => 'json',
            'kind' => 'locality',
            'results' => 1,
            'lang' => 'ru_RU'
        ];

        try {
            $response = Http::get(self::GEOCODER_URL . "?" . http_build_query($queryData));
            $data = json_decode($response->body());
            if (! empty($data->response->GeoObjectCollection->featureMember)) {
                return $data->response->GeoObjectCollection->featureMember[0]->GeoObject->name;
            }

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return "";
    }

}
