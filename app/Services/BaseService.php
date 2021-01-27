<?php

namespace App\Services;

use App\Helpers\ModelHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class BaseService
{
    private const DELIMITER = ':_:';

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
    protected function getNearObjects(string $table, float $lat, float $lng, int $radius = 20, int $limit = 10) : Collection
    {
        $additionalFields = $this->generateAdditionalFields($table);

        $rawData = DB::select("
            SELECT
                {$table}.id,
                {$table}.name,
                {$table}.city,
                {$table}.lat,
                {$table}.lng,
                (6371 * acos(
                    cos(radians({$lat})) *
                    cos(radians(lat)) *
                    cos(radians(lng) - radians({$lng})) +
                    sin(radians({$lat})) *
                    sin(radians(lat))
                )) AS distance,
                {$additionalFields}
                (SELECT CONCAT(id, '" . self::DELIMITER. "', file_name)
                    FROM media
                    WHERE media.model_id = {$table}.id
                    AND media.model_type='App\\\\Models\\\\" . ucfirst(Str::singular($table)) . "'
                    LIMIT 1) as media_data
            FROM {$table}
            HAVING distance < {$radius}
            ORDER BY distance
            LIMIT 0 , {$limit};"
        );

        $locale = app()->getLocale();

        return collect($rawData)
            ->unique()
            ->map(function (\stdClass $item) use ($locale, $table) {
                $defaultLocale = 'ru';
                $names = json_decode($item->name);
                $cities = json_decode($item->city);
                $item->name = $names->$locale ?? $names->$defaultLocale ?? '';
                $item->city = $cities->$locale ?? $cities->$defaultLocale ?? '';
                $item->distance = round($item->distance, 2);
                $item->type = $table;
                $item->imagePath = $this->urlForImage($item,'near');
                $item->averageRating = $this->getAverageRating($item->id, $table);
                return $item;
            });
    }

    /**
     * @param int $id
     * @param string $table
     * @return int
     */
    private function getAverageRating(int $id, string $table) : int
    {
        if (! in_array($table, ['hotels', 'meals'])) {
            return 0;
        }

        $model = ModelHelper::findModel($table, $id);

        return $model->averageRating() ?? 0;
    }

    /**
     * @param string $table
     * @return string
     */
    private function generateAdditionalFields(string $table) : string
    {
        switch (true) {
            case $table === 'hotels':
                return "{$table}.price,";
            case $table === 'meals':
                return "{$table}.cost,";
            case $table === 'events':
                return "{$table}.date_from," .
                       "{$table}.date_to,";
            default:
                return "";
        }
    }

    /**
     * @param $item
     * @param string $conversion
     * @return string
     */
    private function urlForImage($item, string $conversion) : string
    {
        if (! $item->media_data) {
            return "";
        }

        [$id, $fileName] = explode(self::DELIMITER, $item->media_data);
        $arr = explode(".", $fileName);
        if (count($arr) === 2) {
            $name = $arr[0];
            $exp = $arr[1];

        } else {
            preg_match('/(.?)*\./', $fileName, $matches);
            $name = rtrim($matches[0], ".");

            preg_match('/\.(.?){3,4}$/', $fileName, $matches);
            $exp = trim($matches[0], ".");
        }

        return sprintf("%s/conversions/%s-%s.%s", $id, $name, $conversion, $exp);
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
