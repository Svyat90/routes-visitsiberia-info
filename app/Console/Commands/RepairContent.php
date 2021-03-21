<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class RepairContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:content';

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
        $this->fillCities(new Place);
        $this->fillCities(new Hotel);
        $this->fillCities(new Meal);
        $this->fillCities(new Event);
        $this->fillCities(new Route);
    }

    /**
     * @param Model $model
     */
    private function fillCities(Model $model) : void
    {
        $model->query()
            ->get()
            ->each(function (Model $item) {
                $toUpdate = [];

                $fields = [
                    'name',
                    'location',
                    'page_desc',
                    'history_desc',
                    'contact_desc',
                    'life_hacks',
                    'conditions_accommodation',
                    'description',
                    'additional_services',
                    'location',
                    'rooms_fund',
                    'working_hours',
                    'city',
                    'features',
                    'static_info',
                    'duration',
                    'list_points',
                    'what_take',
                    'more_info',
                    'features_desc',
                    'statistic_info_desc'
                ];

                foreach ($fields as $field) {
                    $this->setField($item, $field, $toUpdate);
                }

                if (! empty($toUpdate)) {
                    $item->update($toUpdate);
                    $this->info(get_class($item) . " #" .  $item->id);
                }
            });
    }

    /**
     * @param Model $item
     * @param string $field
     * @param array $updateData
     */
    private function setField(Model $item, string $field, array &$updateData) : void
    {
        if (! in_array($field, $item->getTranslatable())) {
            return;
        }

        $fieldRu = $item->getTranslation($field, 'ru', false);
        $fieldEn = $item->getTranslation($field, 'en', false);

        if ($fieldRu && ! $fieldEn) {
            $updateData[$field] = [
                'ru' => $fieldRu,
                'en' => $fieldRu
            ];

        } elseif (! $fieldRu && $fieldEn) {
            $updateData[$field] = [
                'ru' => $fieldEn,
                'en' => $fieldEn
            ];
        }
    }

}
