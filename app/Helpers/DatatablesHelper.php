<?php

namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\View\View;

class DatatablesHelper
{

    /**
     * @param Model  $row
     * @param string $entityName
     * @param bool   $withDelete
     * @param bool   $onlyShow
     *
     * @return Application|Factory|View
     */
    public static function renderActionsRow(Model $row, string $entityName, bool $withDelete = true, bool $onlyShow = false)
    {
        if ($onlyShow) {
            $view = 'datatables-actions-show';

        } else {
            $view = $withDelete ? 'datatables-actions-show-read-del' : 'datatables-actions-show-read';
        }

        return view("admin.partials.$view", compact(
            'entityName',
            'row'
        ));
    }

}
