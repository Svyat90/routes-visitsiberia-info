<?php

namespace App\Helpers;

class YandexGeoHelper
{
    const API_KEY = '';

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
     * @param $lat
     * @param $lng
     */
    public static function getCity($lat, $lng)
    {
        $key = self::API_KEY;
        $link = "https://geocode-maps.yandex.ru/1.x/?apikey={$key}&geocode=$lat,$lng";
    }

}
