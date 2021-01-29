<?php

namespace App\Helpers;

class YandexGeoHelper
{

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

}
