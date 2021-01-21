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
        'header_home' => [
            'ru' => 'Главная',
            'en' => 'Home'
        ],
        'header_routes' => [
            'ru' => 'Маршруты',
            'en' => 'Routes'
        ],
        'header_places' => [
            'ru' => 'Достопримечательности',
            'en' => 'Places'
        ],
        'header_events' => [
            'ru' => 'События',
            'en' => 'Events'
        ],
        'header_hotels' => [
            'ru' => 'Проживание',
            'en' => 'Hotels'
        ],
        'header_meals' => [
            'ru' => 'Еда',
            'en' => 'Meals'
        ],
        'header_favourites' => [
            'ru' => 'Избранное',
            'en' => 'Favourites'
        ],
        'header_create_route' => [
            'ru' => 'Составить маршрут',
            'en' => 'Make a route'
        ],
        'footer_title' => [
            'ru' => 'Туристский <br> информационный центр',
            'en' => 'Tourist <br> Information Center'
        ],
        'footer_address' => [
            'ru' => 'Красноярск, ул. Ленина, 120',
            'en' => 'Красноярск, ул. Ленина, 120'
        ],
        'footer_phone' => [
            'ru' => '+7 (391) 215 00 02',
            'en' => '+7 (391) 215 00 02'
        ],
        'footer_mail' => [
            'ru' => 'itc.krsk@gmail.com',
            'en' => 'itc.krsk@gmail.com'
        ],
        'footer_news_title' => [
            'ru' => 'Получайте актуальные новости',
            'en' => 'Get the latest news'
        ],
        'footer_news_placeholder' => [
            'ru' => 'e-mail',
            'en' => 'e-mail'
        ],
        'footer_news_ok_button' => [
            'ru' => 'Ок',
            'en' => 'Ок'
        ],
        'footer_copyright' => [
            'ru' => 'Туристский портал Красноярского края',
            'en' => 'Tourist portal of the Krasnoyarsk Territory'
        ],
        'social_facebook' => [
            'ru' => '#',
            'en' => '#'
        ],
        'social_vkontakte' => [
            'ru' => '#',
            'en' => '#'
        ],
        'social_youtube' => [
            'ru' => '#',
            'en' => '#'
        ],
        'social_instagram' => [
            'ru' => '#',
            'en' => '#'
        ],
        'social_odnoklassniki' => [
            'ru' => '#',
            'en' => '#'
        ],
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
        'base_added' => [
            'ru' => 'Добавлено',
            'en' => 'Added'
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
        'filter_type_rest' => [
            'ru' => 'Тип отдыха',
            'en' => 'Type of rest'
        ],
        'filter_season' => [
            'ru' => 'Сезон',
            'en' => 'Season'
        ],
        'filter_place_category' => [
            'ru' => 'Категория',
            'en' => 'Category'
        ],
        'filter_food_category' => [
            'ru' => 'Категория',
            'en' => 'Category'
        ],
        'filter_delivery' => [
            'ru' => 'Доставка',
            'en' => 'Delivery'
        ],
        'filter_city' => [
            'ru' => 'Город',
            'en' => 'City'
        ],
        'filter_distance' => [
            'ru' => 'Расстояние',
            'en' => 'Distance'
        ],
        'filter_type_allocation' => [
            'ru' => 'Тип размещения',
            'en' => 'Type of allocation'
        ],
        'filter_whom' => [
            'ru' => 'С кем',
            'en' => 'Whom'
        ],
        'filter_time_range' => [
            'ru' => 'Сроки',
            'en' => 'Timing'
        ],
        'filter_transport' => [
            'ru' => 'Транспорт',
            'en' => 'Transport'
        ],
        'routes_all' => [
            'ru' => 'Все маршруты',
            'en' => 'All routes'
        ],
        'routes_no' => [
            'ru' => 'Нет маршрутов',
            'en' => 'No routes'
        ],
        'events_all' => [
            'ru' => 'Все события',
            'en' => 'All events'
        ],
        'events_no' => [
            'ru' => 'Нет событий',
            'en' => 'No events'
        ],
        'places_no' => [
            'ru' => 'Нет достопримечательностей',
            'en' => 'No places'
        ],
        'hotels_no' => [
            'ru' => 'Нет мест',
            'en' => 'No hotels'
        ],
        'meals_no' => [
            'ru' => 'Нет заведений',
            'en' => 'No meals'
        ],
        'favourites_no' => [
            'ru' => 'Нет избранных',
            'en' => 'No favourites'
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
        'home_title' => [
            'ru' => 'Постройте маршрут и отправляйтесь в путешествие!',
            'en' => 'Build a route and go on a journey!'
        ],
        'home_plan_easy_title' => [
            'ru' => 'Планируйте с <br> лёгкостью',
            'en' => 'Plan with <br> ease'
        ],
        'home_plan_easy_desc' => [
            'ru' => 'Благодаря своему географическому положению регион может похвастаться разнообразием природных зон: от дикой и непроходимой тайги до больших степей и тундры.',
            'en' => 'Due to its geographical position, the region boasts a variety of natural areas: from wild and impassable taiga to large steppes and tundra.'
        ],
        'home_plan_easy_desc_first' => [
            'ru' => 'Множество готовых <br> маршрутов',
            'en' => 'Many ready-made  <br> routes'
        ],
        'home_plan_easy_desc_second' => [
            'ru' => 'Конструктор <br> маршрутов',
            'en' => 'Route <br> constructor'
        ],
        'home_plan_easy_desc_third' => [
            'ru' => 'Добавляйте объекты и <br> редактируйте',
            'en' => 'Add objects and <br> edit'
        ],
        'home_ready_routes_title' => [
            'ru' => 'Готовые маршруты по <br> Красноярскому краю',
            'en' => 'Ready routes in the <br> Krasnoyarsk Territory'
        ],
        'home_near_events' => [
            'ru' => 'Ближайшие события <br> края',
            'en' => 'Upcoming events of <br> the region'
        ],
        'meals_title' => [
            'ru' => 'Еда',
            'en' => 'Food'
        ],
        'routes_title' => [
            'ru' => 'Маршруты',
            'en' => 'Routes'
        ],
        'events_title' => [
            'ru' => 'События',
            'en' => 'Events'
        ],
        'hotels_title' => [
            'ru' => 'Проживание',
            'en' => 'Hotels'
        ],
        'favourites_title' => [
            'ru' => 'Избранное',
            'en' => 'Favourites'
        ],
        'favourites_places' => [
            'ru' => 'Достопримечательности',
            'en' => 'Places'
        ],
        'favourites_events' => [
            'ru' => 'События',
            'en' => 'Events'
        ],
        'favourites_hotels' => [
            'ru' => 'Проживание',
            'en' => 'Hotels'
        ],
        'favourites_meals' => [
            'ru' => 'Еда',
            'en' => 'Meals'
        ],
        'favourites_all' => [
            'ru' => 'Все',
            'en' => 'All'
        ],
        'choose_constructor_title' => [
            'ru' => 'Констркутор маршрутов',
            'en' => 'Route constructor'
        ],
        'choose_constructor_desc' => [
            'ru' => 'Выберите нужные параметры, а мы построим для вас наилучший маршрут',
            'en' => 'Choose the options you need, and we will build the best route for you'
        ],
        'choose_make_route_title' => [
            'ru' => 'Хочу составить маршрут самостоятельно',
            'en' => 'I want to plan a route myself'
        ],
        'choose_make_route_desc' => [
            'ru' => 'Выбирайте объекты, которые хотите посетить, выставляйте порядок и в путь!',
            'en' => 'Choose the objects you want to visit, put things in order and go!'
        ],
        'constructor_routes_set_name' => [
            'ru' => 'Назовите ваш маршрут',
            'en' => 'Name your route'
        ],
        'constructor_routes_no_data' => [
            'ru' => 'Нет данних',
            'en' => 'No data'
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
