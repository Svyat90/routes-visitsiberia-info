<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VarModel;

class VarsSeeder extends Seeder
{

    /**
     * @var array
     */
    private array $vars = [
        'base_list' => [
            'ru' => 'Список',
            'en' => 'List'
        ],
        'base_on_map' => [
            'ru' => 'На карте',
            'en' => 'On map'
        ],
        'base_add' => [
            'ru' => 'Добавить',
            'en' => 'Add'
        ],
        'base_showed' => [
            'ru' => 'Показано',
            'en' => 'Showed'
        ],
        'base_results' => [
            'ru' => 'результата',
            'en' => 'results'
        ],
        'base_help_info' => [
            'ru' => 'Полезная информация',
            'en' => 'Helpful information'
        ],
        'base_history' => [
            'ru' => 'История',
            'en' => 'History'
        ],
        'base_contacts' => [
            'ru' => 'Контакты',
            'en' => 'Contacts'
        ],
        'base_contacts_owners' => [
            'ru' => 'Контакты организаторов',
            'en' => 'Contacts owners'
        ],
        'base_how_to_get' => [
            'ru' => 'Как добраться',
            'en' => 'How to get there'
        ],
        'base_reviews' => [
            'ru' => 'Отзывы',
            'en' => 'Reviews'
        ],
        'base_desc' => [
            'ru' => 'Описание',
            'en' => 'Description'
        ],
        'base_photo' => [
            'ru' => 'Фото',
            'en' => 'Photo'
        ],
        'base_events_early' => [
            'ru' => 'События рядом',
            'en' => 'Events nearby'
        ],
        'base_where_to_stay' => [
            'ru' => 'Где остановиться',
            'en' => 'Where to stay'
        ],
        'base_where_to_stay_on_way' => [
            'ru' => 'Где остановиться в пути',
            'en' => 'Where to stay on the way'
        ],
        'base_where_to_eat' => [
            'ru' => 'Где покушать',
            'en' => 'Where to eat'
        ],
        'base_where_to_eat_desc' => [
            'ru' => 'Самые вкусные места на маршруте',
            'en' => 'The most delicious places on the route'
        ],
        'base_tic_recommended' => [
            'ru' => 'ТИЦ рекомендует',
            'en' => 'TIC recommends'
        ],
        'base_share' => [
            'ru' => 'Поделиться',
            'en' => 'Share'
        ],
        'base_go_to_route' => [
            'ru' => 'Перейти к маршруту',
            'en' => 'Go to route'
        ],
        'places_title' => [
            'ru' => 'Достопримечательности',
            'en' => 'Places'
        ],
        'places_type_rest' => [
            'ru' => 'Тип отдыха',
            'en' => 'Type of rest'
        ],
        'places_season' => [
            'ru' => 'Сезон',
            'en' => 'Season'
        ],
        'places_category' => [
            'ru' => 'Категория',
            'en' => 'Category'
        ],
        'places_whom' => [
            'ru' => 'С кем',
            'en' => 'Whom'
        ],
        'meals_title' => [
            'ru' => 'Еда',
            'en' => 'Food'
        ],
        '404_home' => [
            'ru' => 'Перейти на главную',
            'en' => 'Go to home'
        ],
        '404_title' => [
            'ru' => 'Страница не найдена',
            'en' => 'Page not found'
        ],
        '404_info' => [
            'ru' => 'К сожалению, запрашиваемый вами адрес неверный или страница не существует',
            'en' => 'Sorry, the address you requested is incorrect or the page does not exist'
        ],
        '500_reset' => [
            'ru' => 'Перезагрузить',
            'en' => 'Reboot'
        ],
        '500_title' => [
            'ru' => 'Ошибка связи с сервером',
            'en' => 'Server communication error'
        ],
        '500_info' => [
            'ru' => 'Перезагрузите страницу или попробуйте подключиться позже',
            'en' => 'Reload the page or try to try later'
        ],
    ];

    /**
     * @var array|string[]
     */
    private array $locales = ['ru', 'en'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateNow = now()->toDateString();

        collect($this->vars)->each(function ($var, $key) use ($dateNow) {
            $insertData = collect($this->locales)->map(function ($locale) use ($var, $key) {
                return [
                    'val_' . $locale => $var[$locale]
                ];
            })->collapse()->toArray();

            $insertData['key'] = $key;
            $insertData['created_at'] = $dateNow;
            $insertData['updated_at'] = $dateNow;

            VarModel::query()->insertOrIgnore($insertData);
        });
    }
}
