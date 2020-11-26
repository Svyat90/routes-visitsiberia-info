<?php

namespace App\Services;

use App\Helpers\FileSystemHelper;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Collection;

class TranslationService
{
    /**
     * @param string $folder
     * @return Collection
     */
    public function getFilesWithContent(string $folder) : Collection
    {
        return collect(FileSystemHelper::getFolderFiles($folder))
            ->map(function (SplFileInfo $file) {
                return (object) [
                    'name' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'content' => include($file->getPathname())
                ];
            });
    }

}
