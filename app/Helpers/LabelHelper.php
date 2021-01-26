<?php

namespace App\Helpers;

use App\Models\Dictionary;

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

    /**
     * @param Dictionary $dictionary
     * @return string
     */
    public static function dictionaryLabel(Dictionary $dictionary) : string
    {
        return $dictionary->children->count()
            ? "<a href='" . route("admin.dictionaries.index.child", $dictionary->id) ."'>{$dictionary->name}</a>"
            : $dictionary->name;
    }

}
