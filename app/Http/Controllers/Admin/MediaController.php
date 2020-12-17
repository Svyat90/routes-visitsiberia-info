<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Admin\Media\MediaUploadRequest;
use App\Services\MediaService;

class MediaController extends Controller
{

    /**
     * @param MediaUploadRequest $request
     * @param MediaService       $service
     *
     * @return JsonResponse
     */
    public function upload(MediaUploadRequest $request, MediaService $service) : JsonResponse
    {
        [$name, $originName] = $service->createFile($request);

        return response()->json([
            'name' => $name,
            'original_name' => $originName,
        ]);
    }

}
