<?php

namespace App\Services;

use App\Helpers\ModelHelper;
use App\Helpers\RouteHelper;
use App\Repositories\DictionaryRepository;
use Illuminate\Database\Eloquent\Model;
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
     * @param Model $model
     * @param $request
     */
    protected function saveSocialLinks(Model $model, $request) : void
    {
        if (! $request->social_links) {
            return;
        }

        $urls = $request->social_links['url'];
        $texts = $request->social_links['title'];
        $types = $request->social_links['type'];

        $insertSocialData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'social_links'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertSocialData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    protected function saveAggregatorLinks(Model $model, $request) : void
    {
        if (! $request->aggregator_links) {
            return;
        }

        $urls = $request->aggregator_links['url'];
        $texts = $request->aggregator_links['title'];
        $types = $request->aggregator_links['type'];

        $insertSocialData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'aggregator_links'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertSocialData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    protected function savePhones(Model $model, $request) : void
    {
        if (! $request->phones) {
            return;
        }

        $urls = $request->phones['url'];
        $types = $request->phones['type'];

        $insertSocialData = array_map(function ($url, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => '', 'type' => $type, 'field' => 'phones'];
        }, $urls, $types);

        $model->socialFields()->createMany(array_filter($insertSocialData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    protected function saveAdditionalLinks(Model $model, $request) : void
    {
        if (! $request->additional_links) {
            return;
        }

        $urls = $request->additional_links['url'];
        $texts = $request->additional_links['title'];
        $types = $request->additional_links['type'];

        $insertData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'additional_links'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    protected function savePhoneLinks(Model $model, $request) : void
    {
        if (! $request->link_phones) {
            return;
        }

        $urls = $request->link_phones['url'];
        $texts = $request->link_phones['title'];
        $types = $request->link_phones['type'];

        $insertData = array_map(function ($url, $text, $type) {
            if (! $url) return [];
            return ['url' => $url, 'title' => $text, 'type' => $type, 'field' => 'link_phones'];
        }, $urls, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertData));
    }

    /**
     * @param Model $model
     * @param $request
     */
    protected function saveAddresses(Model $model, $request) : void
    {
        if (! $request->addresses) {
            return;
        }

        $texts = $request->addresses['title'];
        $types = $request->addresses['type'];

        $insertData = array_map(function ($text, $type) {
            return ['url' => '', 'title' => $text, 'type' => $type, 'field' => 'addresses'];
        }, $texts, $types);

        $model->socialFields()->createMany(array_filter($insertData));
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
                {$table}.location,
                {$table}.lat,
                {$table}.lng,
                {$table}.site_link,
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
                    LIMIT 1) as media_data,
                (SELECT url
                    FROM social_fields
                    WHERE social_fields.sociable_id = {$table}.id
                    AND social_fields.type='phone'
                    AND (social_fields.field='phones' OR social_fields.field='link_phones')
                    AND social_fields.sociable_type='App\\\\Models\\\\" . ucfirst(Str::singular($table)) . "'
                    LIMIT 1) as phone
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
                $locations = json_decode($item->location);
                $cities = json_decode($item->city);
                $name = $names->$locale ?? $names->$defaultLocale ?? '';
                $location = $locations->$locale ?? $locations->$defaultLocale ?? '';

                $item->name = $name ? str_replace("\"", "'", $name) : '';
                $item->location = $location ? str_replace("\"", "'", $location) : '';
                $item->city = $cities->$locale ?? $cities->$defaultLocale ?? '';
                $item->distance = round($item->distance, 2);
                $item->type = $table;
                $item->label = __("global.types.$table");
                $item->imagePath = $this->urlForImage($item,'near');
                $item->averageRating = $this->getAverageRating($item->id, $table);
                $item->link = route('front.' . $table . '.show', $item->id);

                unset($item->media_data, $item->distance, $item->type);

                return $item;
            });
    }

    /**
     * @param Model $model
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Collection
     */
    public static function getListGeoData(Model $model, array $ids)
    {
        $models = $model::query()
            ->with('socialFields')
            ->whereIn('id', $ids)
            ->get(['id', 'name', 'location', 'lat', 'lng', 'site_link', 'city']);

        return $models->map(function (Model $model) {
            $output = [];
            $namespace = RouteHelper::namespace($model);

            $output['lat'] = $model->lat ?? '';
            $output['lng'] = $model->lng ?? '';
            $output['name'] = $model->name ? str_replace("\"", "'", $model->name) : '';
            $output['location'] = $model->location ? str_replace("\"", "'", $model->location) : '';
            $output['city'] = $model->city ?? '';
            $output['site_link'] = $model->site_link ?? '';
            $output['type'] = __('global.types.' . $namespace);

            $output['phone'] = $model->socialFields()
                ->where(function ($query) {
                    $query->where('field', 'link_phones')
                        ->orWhere('field', 'phones');
                })
                ->where('type', 'phone')
                ->first()->url ?? "";

            $output['label'] = __("global.types.$namespace");
            $output['link'] = route('front.' . $namespace . '.show', $model->id);

            return $output;
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
//                return "{$table}.cost,";
                return "";
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
     * @param Model $model
     */
    protected function handleCityDictionary(Model $model) : void
    {
        $cityName = $model->city;
        if (! $cityName) {
            return;
        }

        $dictionaryRepository = app(DictionaryRepository::class);
        $parent = $dictionaryRepository->getParentCityDictionary();
        $dictionaryIds = $parent->children->pluck('id', 'name')->toArray();

        if (! isset($dictionaryIds[$cityName])) {
            $dictionary = $dictionaryRepository->saveChildDictionary([
                'dictionary_id' => $parent->id,
                'name' => [
                    'ru' => $cityName,
                    'en' => $cityName
                ]
            ]);

            $idToAttach = $dictionary->id;

        } else {
            $idToAttach = $dictionaryIds[$cityName];
        }

        $model->dictionaries()->attach($idToAttach);
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
