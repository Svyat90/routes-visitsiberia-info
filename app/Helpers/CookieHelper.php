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
            $places = self::normalizeIds('favourite-places');
            $hotels = self::normalizeIds('favourite-hotels');
            $meals = self::normalizeIds('favourite-meals');
            $events = self::normalizeIds('favourite-events');

            return collect()
                ->push(['places' => $places])
                ->push(['hotels' => $hotels])
                ->push(['meals' => $meals])
                ->push(['events' => $events])
                ->collapse()
                ->toArray();
        }

        return self::normalizeIds('favourite-' . $type)->toArray();
    }

    /**
     * @return array
     */
    public static function getRouteList() : array
    {
        $places = self::normalizeIds('route-places');
        $hotels = self::normalizeIds('route-hotels');
        $meals = self::normalizeIds('route-meals');
        $events = self::normalizeIds('route-events');

        return collect()
            ->push(['places' => $places])
            ->push(['hotels' => $hotels])
            ->push(['meals' => $meals])
            ->push(['events' => $events])
            ->collapse()
            ->toArray();
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
