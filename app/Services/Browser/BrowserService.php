<?php

namespace App\Services\Browser;

use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Repositories\EventRepository;
use App\Repositories\HotelRepository;
use App\Repositories\MealRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Support\Collection;

abstract class BrowserService
{
    /**
     * @var MealRepository
     */
    protected MealRepository $mealRepository;

    /**
     * @var HotelRepository
     */
    protected HotelRepository $hotelRepository;

    /**
     * @var PlaceRepository
     */
    protected PlaceRepository $placeRepository;

    /**
     * @var EventRepository
     */
    protected EventRepository $eventRepository;

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
     * @param array $data
     * @return Collection
     */
    protected function generateData(array $data) : Collection
    {
        $places = $this->placeRepository->getListByIds($data['places']);
        $hotels = $this->hotelRepository->getListByIds($data['hotels']);
        $meals = $this->mealRepository->getListByIds($data['meals']);
        $events = $this->eventRepository->getListByIds($data['events']);

        return $this->mergeAll($places, $hotels, $meals, $events);
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
