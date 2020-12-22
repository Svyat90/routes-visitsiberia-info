<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Services\DictionaryService;
use App\Services\TranslationService;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    /**
     * @var TranslationService
     */
    private TranslationService $translationService;

    /**
     * @var array|string[][]
     */
    private array $dictionaries = [
        'Доступность в сезон' => [
            'type' => DictionaryService::TYPE_SEASON,
            'values' => [
                'зима',
                'весна',
                'лето',
                'осень',
                'круглый год',
            ],
            'date_ranges' => [
                ["2020-12-01", "2021-02-28"],
                ["2021-03-01", "2021-05-30"],
                ["2021-06-01", "2021-08-01"],
                ["2021-09-01", "2021-12-31"],
                ["2021-01-01", "2021-12-31"],
            ]
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
            'type' => DictionaryService::TYPE_CATEGORY_PLACE,
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
        ],
        'Теги' => [
            'type' => DictionaryService::TYPE_TAG,
            'values' => [
                'на машыне',
                'пешком',
                'общественный транспорт'
            ]
        ],
        'Доступность для людей с дополнительными потребностями' => [
            'type' => DictionaryService::TYPE_TAG,
            'values' => [
                'для слабослышащих людей',
                'для слабовидящих людей',
                'для маломобильных'
            ]
        ],
    ];

    /**
     * DictionarySeeder constructor.
     * @param TranslationService $translationService
     */
    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function run()
    {
        collect($this->dictionaries)->each(function ($data, $parentName) {
            $this->command->info('Parent: ' . $parentName);

            $parent = new Dictionary(['type' => $data['type']]);
            $this->translationService->setLocaleTranslates($parent, 'name', $parentName);
            $parent->save();

            $dateRanges = $data['type'] === DictionaryService::TYPE_SEASON ? $data['date_ranges'] : [];

            collect($data['values'])->each(function ($childName, $key) use ($parent, $dateRanges) {
                $this->command->info('Child: ' . $childName);

                $child = new Dictionary([
                    'date_range_from' => ! empty($dateRanges[$key]) ? $dateRanges[$key][0] : null,
                    'date_range_to' => ! empty($dateRanges[$key]) ? $dateRanges[$key][1] : null,
                ]);

                $this->translationService->setLocaleTranslates($child, 'name', $childName);

                $parent->children()->save($child);
            });
        });
    }

}
