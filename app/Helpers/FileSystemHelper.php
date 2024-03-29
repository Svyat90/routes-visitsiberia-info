<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\Log;

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

    /**
     * @param string $path
     */
    public static function checkExistsFolder(string $path) : void
    {
        try {
            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

}
