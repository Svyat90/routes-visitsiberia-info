<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{

    /**
     * @var array
     */
    private array $pages = [
        [
            'name' => [
                'ru' => 'Home Name',
                'ro' => 'Home Name',
                'en' => 'Home Name',
            ],
            'title' => [
                'ru' => 'Home Title',
                'ro' => 'Home Title',
                'en' => 'Home Title',
            ],
            'meta_title' => [
                'ru' => 'Home Meta Title',
                'ro' => 'Home Meta Title',
                'en' => 'Home Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Home Meta Description',
                'ro' => 'Home Meta Description',
                'en' => 'Home Meta Description',
            ],
            'slug' => 'home'
        ],
        [
            'name' => [
                'ru' => 'Attractions Name',
                'ro' => 'Attractions Name',
                'en' => 'Attractions Name',
            ],
            'title' => [
                'ru' => 'Attractions Title',
                'ro' => 'Attractions Title',
                'en' => 'Attractions Title',
            ],
            'meta_title' => [
                'ru' => 'Attractions Meta Title',
                'ro' => 'Attractions Meta Title',
                'en' => 'Attractions Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Attractions Meta Description',
                'ro' => 'Attractions Meta Description',
                'en' => 'Attractions Meta Description',
            ],
            'slug' => 'attractions'
        ],
        [
            'name' => [
                'ru' => 'Routes Name',
                'ro' => 'Routes Name',
                'en' => 'Routes Name',
            ],
            'title' => [
                'ru' => 'Routes Title',
                'ro' => 'Routes Title',
                'en' => 'Routes Title',
            ],
            'meta_title' => [
                'ru' => 'Routes Meta Title',
                'ro' => 'Routes Meta Title',
                'en' => 'Routes Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Routes Meta Description',
                'ro' => 'Routes Meta Description',
                'en' => 'Routes Meta Description',
            ],
            'slug' => 'routes'
        ],
        [
            'name' => [
                'ru' => 'Events Name',
                'ro' => 'Events Name',
                'en' => 'Events Name',
            ],
            'title' => [
                'ru' => 'Events Title',
                'ro' => 'Events Title',
                'en' => 'Events Title',
            ],
            'meta_title' => [
                'ru' => 'Events Meta Title',
                'ro' => 'Events Meta Title',
                'en' => 'Events Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Events Meta Description',
                'ro' => 'Events Meta Description',
                'en' => 'Events Meta Description',
            ],
            'slug' => 'events'
        ],
        [
            'name' => [
                'ru' => 'Meals Name',
                'ro' => 'Meals Name',
                'en' => 'Meals Name',
            ],
            'title' => [
                'ru' => 'Meals Title',
                'ro' => 'Meals Title',
                'en' => 'Meals Title',
            ],
            'meta_title' => [
                'ru' => 'Meals Meta Title',
                'ro' => 'Meals Meta Title',
                'en' => 'Meals Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Meals Meta Description',
                'ro' => 'Meals Meta Description',
                'en' => 'Meals Meta Description',
            ],
            'slug' => 'meals'
        ],
        [
            'name' => [
                'ru' => 'Hotels Name',
                'ro' => 'Hotels Name',
                'en' => 'Hotels Name',
            ],
            'title' => [
                'ru' => 'Hotels Title',
                'ro' => 'Hotels Title',
                'en' => 'Hotels Title',
            ],
            'meta_title' => [
                'ru' => 'Hotels Meta Title',
                'ro' => 'Hotels Meta Title',
                'en' => 'Hotels Meta Title',
            ],
            'meta_description' => [
                'ru' => 'Hotels Meta Description',
                'ro' => 'Hotels Meta Description',
                'en' => 'Hotels Meta Description',
            ],
            'slug' => 'hotels'
        ],
    ];


    public function run() : void
    {
        collect($this->pages)->each(function (array $pageData) {
            Page::query()->create($pageData);
        });
    }

}
