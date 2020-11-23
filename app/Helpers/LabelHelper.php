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
        $strBool = var_export($val, true);

        return '<span class="badge badge-' . ($val ? 'success' : 'danger') . '">' . $strBool . '</span>';
    }

}
