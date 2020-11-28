<?php

namespace App\Traits;

trait FilterConstantsTrait
{

    /**
     * @param string $prefix
     * @return array
     */
    public static function filterConstants(string $prefix) : array
    {
        $reflector = new \ReflectionClass(static::class);

        return collect($reflector->getConstants())
            ->filter(function ($item, $key) use ($prefix) {
                if (strpos($key, $prefix) !== false)
                    return true;
                else
                    return false;
            })
            ->values()
            ->toArray();
    }

}
