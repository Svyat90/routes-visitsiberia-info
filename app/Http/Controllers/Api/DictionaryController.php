<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictionaryResource;
use App\Services\DictionaryService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DictionaryController extends Controller
{

    /**
     * @param DictionaryService $service
     * @return AnonymousResourceCollection
     */
    public function index(DictionaryService $service)
    {
        $collection = $service->getBaseDictionaries();

        return DictionaryResource::collection($collection);
    }

}
