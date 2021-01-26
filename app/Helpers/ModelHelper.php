<?php

namespace App\Helpers;

use App\Models\Meal;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\Place;
use App\Models\Route;
use Illuminate\Support\Str;

class ModelHelper
{

    /**
     * @param string $table
     * @param int $id
     * @return string|null
     */
    public static function findModel(string $table, int $id)
    {
        $nameModel = ucfirst(Str::singular($table));
        $class = 'App\\Models\\' . $nameModel;

        return $class::find($id);
    }

}
