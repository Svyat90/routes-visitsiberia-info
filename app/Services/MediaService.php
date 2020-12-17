<?php

namespace App\Services;

use App\Http\Requests\Admin\Media\MediaUploadRequest;
use Illuminate\Support\Facades\Log;

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
        $this->checkExistsFolder($tempPath);
        $file->move($tempPath, $name);

        return [$name, $file->getClientOriginalName()];
    }

    /**
     * @param string $path
     */
    private function checkExistsFolder(string $path) : void
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
