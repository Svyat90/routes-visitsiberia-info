<?php

namespace App\Helpers;

use \Illuminate\Support\Collection;

class CookieHelper
{

    /**
     * @param string|null $type
     * @return array
     */
    public static function getFavourites(? string $type = null) : array
    {
        if (! $type) {
            $places = self::normalizeIds('places');
            $hotels = self::normalizeIds('hotels');
            $meals = self::normalizeIds('meals');
            $events = self::normalizeIds('events');

            return collect()
                ->push(['places' => $places])
                ->push(['hotels' => $hotels])
                ->push(['meals' => $meals])
                ->push(['events' => $events])
                ->collapse()
                ->toArray();
        }

        return self::normalizeIds($type)->toArray();
    }

    /**
     * @param string $type
     * @return Collection
     */
    private static function normalizeIds(string $type) : Collection
    {
        $idsStr = $_COOKIE[$type] ?? null;

        if (! $idsStr) {
            return collect();
        }

        return collect(explode(",", $idsStr));
    }

}
