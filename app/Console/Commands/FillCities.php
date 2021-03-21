<?php

namespace App\Console\Commands;

use App\Helpers\YandexGeoHelper;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class FillCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cities:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle() : void
    {
        $this->fillCities(new Place());
        $this->fillCities(new Hotel());
        $this->fillCities(new Meal());
        $this->fillCities(new Event());
        $this->fillCities(new Route());
    }

    /**
     * @param Model $model
     */
    private function fillCities(Model $model) : void
    {
        $model->query()
            ->whereNull('city->ru')
            ->orWhereNull('city->en')
            ->orWhere('city->ru', "")
            ->orWhere('city->en', "")
            ->get(['id', 'lat', 'lng'])
            ->each(function (Model $item) {
                if ($item->lng && $item->lat) {
                    $city = YandexGeoHelper::getAddress($item->lng, $item->lat);
                    if ($city) {
                        $item->update([
                            'city' => [
                                'ru' => $city,
                                'en' => $city
                            ]
                        ]);

                        $this->info(get_class($item) . " #" .  $item->id);
                    }
                }
            });
    }

}
