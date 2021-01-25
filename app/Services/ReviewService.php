<?php

namespace App\Services;

use App\Http\Requests\Front\Reviews\ReviewStoreRequest;
use App\Models\Event;
use App\Models\Hotel;
use App\Models\Meal;
use App\Models\Place;
use App\Models\Route;

class ReviewService
{

    /**
     * @param ReviewStoreRequest $request
     * @return mixed
     */
    public function detectEntityModel(ReviewStoreRequest $request)
    {
        switch ($request->entity) {
            case 'routes':
                return Route::query()->find($request->entityId);
            case 'places':
                return Place::query()->find($request->entityId);
            case 'events':
                return Event::query()->find($request->entityId);
            case 'hotels':
                return Hotel::query()->find($request->entityId);
            case 'meals':
                return Meal::query()->find($request->entityId);
            default:
                return null;
        }
    }
}
