<?php

namespace App\Helpers;

class HtmlHelper
{

    /**
     * @param string $data
     * @return string|null
     */
    public static function clearHtml(string $data) : ? string
    {
        return preg_replace('/class=".*?"/', '', $data);
    }

}
