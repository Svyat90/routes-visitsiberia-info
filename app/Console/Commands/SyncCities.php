<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Route;
use App\Repositories\DictionaryRepository;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class SyncCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var DictionaryRepository
     */
    private DictionaryRepository $dictionaryRepository;

    /**
     * @var array
     */
    private array $dictionaryIds = [];

    /**
     * SyncCities constructor.
     * @param DictionaryRepository $dictionaryRepository
     */
    public function __construct(DictionaryRepository $dictionaryRepository)
    {
        parent::__construct();

        $this->dictionaryRepository = $dictionaryRepository;
    }

    public function handle() : void
    {
        $this->syncDictionaryCities();

        $this->attachCityDictionary(new Hotel);
        $this->attachCityDictionary(new Meal);
        $this->attachCityDictionary(new Place);
        $this->attachCityDictionary(new Event);
        $this->attachCityDictionary(new Route);
    }

    /**
     * @param Model $model
     */
    private function attachCityDictionary(Model $model) : void
    {
        $model->query()
            ->get()
            ->each(function (Model $model) {
                $dictionaryId = $this->dictionaryIds[$model->city] ?? null;
                if ($dictionaryId) {
                    $model->dictionaries()->attach($dictionaryId);
                    $this->info(get_class($model) . " #" .  $model->id);
                }
            });
    }

    private function syncDictionaryCities() : void
    {
        $uniqueCities = \DB::select("
            select distinct(json_extract(`city`, '$.\"ru\"')) as city from hotels
            union
            select distinct(json_extract(`city`, '$.\"ru\"')) from meals
            union
            select distinct(json_extract(`city`, '$.\"ru\"')) from places
            union
            select distinct(json_extract(`city`, '$.\"ru\"')) from events
            union
            select distinct(json_extract(`city`, '$.\"ru\"')) from routes;
        ");

        $cities = array_filter(array_map(function ($city) {
            return str_replace("\"", '', $city->city);
        }, $uniqueCities));

        $parent = $this->dictionaryRepository->getParentCityDictionary();

        Dictionary::query()->where('parent_id', $parent->id)->delete();

        $this->dictionaryIds = collect($cities)->map(function ($name) use ($parent) {
            $child = $this->dictionaryRepository->saveChildDictionary([
                'dictionary_id' => $parent->id,
                'name' => [
                    'ru' => $name,
                    'en' => $name
                ]
            ]);

            return [$name => $child->id];

        })->collapse()->toArray();
    }
}
