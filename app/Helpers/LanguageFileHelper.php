<?php

namespace App\Helpers;

class LanguageFileHelper
{
    /**
     * @var string
     */
    private string $content = '';

    /**
     * @var int
     */
    private int $countTabs = 0;

    /**
     * @param array $data
     * @param string $path
     */
    public static function updateLanguageFile(array $data, string $path) : void
    {
        (new static())->generateFileDataAndSave($data, $path);
    }

    /**
     * @param array $data
     * @param string $path
     */
    private function generateFileDataAndSave(array $data, string $path) : void
    {
        $this->content = "<?php\n\n";
        $this->content .= "return [\n";

        $this->fillData($data);

        $this->content .= "];\n";

        file_put_contents($path, $this->content);
    }

    /**
     * @param array $data
     */
    private function fillData(array $data) : void
    {
        foreach ($data as $key => $val) {
            $this->printTabs();

            if (is_array($val)) {
                $this->countTabs++;
                $this->content .= "\"{$key}\" => [\n";
                $this->fillData($val);
                $this->printTabs();
                $this->content .= "],\n";
                $this->resetTabs();

            } else {
                $val = str_replace('"', "'", $val);
                $this->content .= sprintf("\"%s\" => \"%s\",\n", $key, $val);
            }
        }
    }

    private function printTabs() : void
    {
        for ($i = 0; $i <= $this->countTabs; $i++) {
            $this->content .= "\t";
        }
    }

    private function resetTabs() : void
    {
        $this->countTabs = 0;
    }

}
