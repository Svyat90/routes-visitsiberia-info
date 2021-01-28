<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class DictionaryHelper
{

    /**
     * @param Collection $dictionaries
     * @return array
     */
    public static function group(Collection $dictionaries) : array
    {
        $output = [];
        foreach ($dictionaries as $dictionary) {
            if (! isset($output[$dictionary->parent->name])) {
                $output[$dictionary->parent->name] = [];
            }

            $output[$dictionary->parent->name][] = (object) [
                'id' => $dictionary->id,
                'name' => trim($dictionary->name),
            ];
        }

        return $output;
    }

}
