<?php

namespace App\Helpers;

class LanguageHtmlHelper
{

    /**
     * @var string
     */
    private string $path = 'data';

    /**
     * @param array $data
     * @return string
     */
    public static function renderTranslates(array $data)
    {
        return (new static())->renderListFields($data);
    }

    /**
     * @param array $data
     * @param string $outOut
     * @return string
     */
    private function renderListFields(array $data, string &$outOut = '')
    {
        $outOut .= "<ul style='list-style-type: none'>";

        foreach ($data as $key => $val) {
            if (is_array($val)) {
                $this->updatePath($key);
                $outOut .= "<li'><div class='col-6'><b>{$key}</b></div></li>";
                $this->renderListFields($val, $outOut);
                $this->resetPath();

            } else {
                $outOut .= "<li>" . self::renderFormGroup($key, $val) . "</li>";
            }
        }
        $outOut .= "</ul>";

        return $outOut;
    }

    /**
     * @param $key
     * @param $val
     * @return string
     */
    private function renderFormGroup($key, $val) : string
    {
        $path = $this->path;

        $html  = "<div class='col-6'>";
        $html .= "<div class='form-group m-b-min'>";
        $html .= "<div class='row'>";
        $html .= "<label class='col-md-6' for='title'>$key: </label>";
        $html .= "<input class='col-md-6' class='form-control' type='text' name='{$path}[$key]' id='val' value='$val'/>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    /**
     * @param string $key
     */
    private function updatePath(string $key) : void
    {
        $this->path .= "[$key]";
    }

    private function resetPath() : void
    {
        $this->path = "data";
    }

}
