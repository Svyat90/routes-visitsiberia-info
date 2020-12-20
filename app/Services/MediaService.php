<?php

namespace App\Services;

use App\Http\Requests\Admin\Media\MediaUploadRequest;
use App\Helpers\FileSystemHelper;

class MediaService
{
    /**
     * @param MediaUploadRequest $request
     *
     * @return array
     */
    public function createFile(MediaUploadRequest $request) : array
    {
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $tempPath = storage_path('tmp/uploads');
        FileSystemHelper::checkExistsFolder($tempPath);
        $file->move($tempPath, $name);

        return [$name, $file->getClientOriginalName()];
    }

}
