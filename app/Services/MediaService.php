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
        $name = uniqid() . '_' . $this->clearFileName($file);
        $tempPath = storage_path('tmp/uploads');
        FileSystemHelper::checkExistsFolder($tempPath);
        $file->move($tempPath, $name);

        return [$name, $file->getClientOriginalName()];
    }

    /**
     * @param $file
     * @return string
     */
    private function clearFileName($file) : string
    {
        $name = str_replace($file->getClientOriginalExtension(), '', $file->getClientOriginalName());
        $name = preg_replace('/\./', '-', $name);
        $name = rtrim($name, '-');

        return sprintf("%s.%s", $name, $file->getClientOriginalExtension());
    }
}
