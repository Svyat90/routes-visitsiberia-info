<?php

namespace App\Services;

use App\Helpers\CookieHelper;
use App\Http\Requests\Front\Pages\IndexFavouritesRequest;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Repositories\EventRepository;
use App\Repositories\HotelRepository;
use App\Repositories\MealRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Support\Collection;
use App\Models\Place;
use Illuminate\Support\Str;

class FavouriteService
{
    /**
     * @var MealRepository
     */
    private MealRepository $mealRepository;

    /**
     * @var HotelRepository
     */
    private HotelRepository $hotelRepository;

    /**
     * @var PlaceRepository
     */
    private PlaceRepository $placeRepository;

    /**
     * @var EventRepository
     */
    private EventRepository $eventRepository;

    /**
     * DictionaryService constructor.
     *
     * @param HotelRepository $hotelRepository
     * @param MealRepository $mealRepository
     * @param PlaceRepository $placeRepository
     * @param EventRepository $eventRepository
     */
    public function __construct(
        HotelRepository $hotelRepository,
        MealRepository $mealRepository,
        PlaceRepository $placeRepository,
        EventRepository $eventRepository
    ) {
        $this->mealRepository = $mealRepository;
        $this->hotelRepository = $hotelRepository;
        $this->placeRepository = $placeRepository;
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param IndexFavouritesRequest $request
     * @return Collection
     */
    public function getFavouritesData(IndexFavouritesRequest $request) : Collection
    {
        if ($request->has('type')) {
            $favouriteTypeData = CookieHelper::getFavourites($request->type);
            $nameRepository = Str::singular($request->type) . 'Repository';

            return $this->$nameRepository->getListByIds($favouriteTypeData);

        } else {
            $favouriteData = CookieHelper::getFavourites();

            $places = $this->placeRepository->getListByIds($favouriteData['places']);
            $hotels = $this->hotelRepository->getListByIds($favouriteData['hotels']);
            $meals = $this->mealRepository->getListByIds($favouriteData['meals']);
            $events = $this->eventRepository->getListByIds($favouriteData['events']);

            return $this->mergeAll($places, $hotels, $meals, $events);
        }
    }

    /**
     * @param Collection $places
     * @param Collection $hotels
     * @param Collection $meals
     * @param Collection $events
     * @return Collection
     */
    private function mergeAll(Collection $places, Collection $hotels, Collection $meals, Collection $events) : Collection
    {
        $collectAll = new Collection();

        $places->each(function (Place $place) use (&$collectAll) {
            $collectAll->push($place);
        });

        $hotels->each(function (Hotel $hotel) use (&$collectAll) {
            $collectAll->push($hotel);
        });

        $meals->each(function (Meal $meal) use (&$collectAll) {
            $collectAll->push($meal);
        });

        $events->each(function (Event $event) use (&$collectAll) {
            $collectAll->push($event);
        });

        return $collectAll;
    }

}
