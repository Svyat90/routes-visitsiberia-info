<?php

namespace App\Helpers;

class LabelHelper
{

    /**
     * @param $val
     * @return string
     */
    public static function boolLabel($val) : string
    {
        $str = $val ? __('global.yes') : __('global.no');

        return '<span class="badge badge-' . ($val ? 'success' : 'danger') . '">' . $str . '</span>';
    }
}
