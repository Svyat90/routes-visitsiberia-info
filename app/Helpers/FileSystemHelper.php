<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;

class FileSystemHelper
{

    /**
     * @param string $folder
     * @return SplFileInfo[]
     */
    public static function getFolderFiles(string $folder)
    {
        return File::files($folder);
    }

    /**
     * @return array
     */
    public static function getLangDirectories() : array
    {
        return File::directories(base_path('resources/lang'));
    }

}
