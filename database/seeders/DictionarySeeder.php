<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Services\DictionaryService;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    /**
     * @var array|string[][]
     */
    private array $dictionaries = [
        'Доступность в сезон' => [
            'type' => DictionaryService::TYPE_SEASON,
            'values' => [
                'лето',
                'осень',
                'зима',
                'весна',
                'круглый год',
            ],
        ],
        'Тип отдыха' => [
            'type' => DictionaryService::TYPE_REST,
            'values' => [
                'активно-приключенческий',
                'спокойный отдых',
                'культурно-познавательный',
            ]
        ],
        'Для кого рассчитано' => [
            'type' => DictionaryService::TYPE_WHOM,
            'values' => [
                'один или вдвоем',
                'семейный с ребенком / с детьми до 3-х лет',
                'семейный с ребенком / с детьми до 10-и лет',
                'семейный с подростком',
                'компания от 4-х человек',
            ]
        ],
        'Категория достопримечательности' => [
            'type' => DictionaryService::TYPE_CATEGORY_ATTRACTION,
            'values' => [
                'озера, реки и водопады',
                'горы и скалы',
                'места силы',
                'храмы и святыни',
                'парки и заповедники',
                'городские пространства',
                'музеи',
                'скульптура и архитектур'
            ]
        ],
        'Способ путешествия' => [
            'type' => DictionaryService::TYPE_WAY_TRAVEL,
            'values' => [
                'на своем автомобиле',
                'на общественном (рейсовом) транспорте',
                'пешком'
            ]
        ],
        'Категория места питания' => [
            'type' => DictionaryService::TYPE_CATEGORY_FOOD,
            'values' => [
                'кафе',
                'кофейни',
                'бары',
                'рестораны',
                'столовые',
                'булочные и кондитерские'
            ]
        ],
        'Тип места размещения' => [
            'type' => DictionaryService::TYPE_PLACEMENT,
            'values' => [
                'отели',
                'хостелы',
                'базы отдыха',
                'турбазы',
                'гостиницы для животных'
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->dictionaries)->each(function ($data, $parentName) {
            $this->command->info('Parent: ' . $parentName);

            $parent = Dictionary::query()->create([
                'name_ru' => $parentName,
                'name_en' => $parentName,
                'type' => $data['type']
            ]);

            collect($data['values'])->each(function ($childName) use ($parent) {
                $this->command->info('Child: ' . $childName);

                $parent->children()->save(new Dictionary([
                    'name_ru' => $childName,
                    'name_en' => $childName,
                ]));
            });
        });
    }

}
