<?php

namespace App\Helpers;

class HtmlHelper
{

    /**
     * @param string|null $data
     * @return string|null
     */
    public static function clearHtml(? string $data) : ? string
    {
        if (! $data) {
            return "";
        }

        return preg_replace('/class=".*?"/', '', $data);
    }

}
