<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class BaseService
{

    /**
     * @var Collection
     */
    protected Collection $dictionaryIds;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->dictionaryIds = new Collection();
    }

    /**
     * @param Collection $dictionaryIds
     */
    public function setDictionaryIds(Collection $dictionaryIds) : void
    {
        $this->dictionaryIds = $dictionaryIds;
    }

    /**
     * @param string $table
     * @param float  $lat
     * @param float  $lng
     * @param int    $radius
     * @param int    $limit
     *
     * @return Collection
     */
    protected function getNearObjects(string $table, float $lat, float $lng, int $radius = 20, int $limit = 10)
    {
        $rawData = DB::select("
            SELECT
                {$table}.id,
                {$table}.name,
                {$table}.location,
                {$table}.lat,
                {$table}.lng,
                (6371 * acos(
                    cos(radians({$lat})) *
                    cos(radians(lat)) *
                    cos(radians(lng) - radians({$lng})) +
                    sin(radians({$lat})) *
                    sin(radians(lat))
                )) AS distance,
                media.file_name,
                media.id as media_id
            FROM {$table}
            LEFT JOIN media ON media.model_id = {$table}.id AND media.model_type='App\\\\Models\\\\" . ucfirst(Str::singular($table)) . "'
            HAVING distance < {$radius}
            ORDER BY distance
            LIMIT 0 , {$limit};"
        );

        $locale = app()->getLocale();

        return collect($rawData)->map(function (\stdClass $item) use ($locale, $table) {
            $item->name = json_decode($item->name)->$locale;
            $item->location = json_decode($item->location)->$locale;
            $item->distance = round($item->distance, 2);
            $item->type = $table;
            $item->imagePath = $item->file_name ? $item->media_id . '/' . $item->file_name : '';
            return $item;
        });
    }

    /**
     * @param mixed ...$data
     *
     * @return bool
     */
    protected function filterDictionaries(...$data) : bool
    {
        return collect($data)->map(function ($id) {
            return $this->filterDictionary($id);
        })->first(function (bool $val) {
            return $val === false;
        }, true);
    }

    /**
     * @param int|null $dictionaryId
     *
     * @return bool
     */
    private function filterDictionary(? int $dictionaryId) : bool
    {
        return $dictionaryId
            ? $this->dictionaryIds->contains($dictionaryId)
            : true;
    }

}
