<?php

namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class DatatablesHelper
{

    /**
     * @param Model $row
     * @param string $entityName
     * @return Application|Factory|View
     */
    public static function renderActionsRow(Model $row, string $entityName)
    {
        return view('admin.partials.datatablesActions', compact(
            'entityName',
            'row'
        ));
    }

}
