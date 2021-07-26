<?php

namespace App\Http\Controllers\Api\Upload;

use App\Http\Controllers\Controller;
use App\Services\Uploader\ImageUploader;
use App\Http\Requests\Api\Upload\UploadImageRequest;
use Illuminate\Http\JsonResponse;

class UploadController extends Controller
{
    /**
     * Upload image file
     *
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function uploadImage(UploadImageRequest $request): JsonResponse
    {
        if (!$request->file('image')) {
            return response()->json([
                'errors' => [
                    'image' => [
                        0 => 'Please send image file'
                    ]
                ]
            ], 422);
        }

        $file = $request->file('image');

        $folder = call_user_func([$request->get('entity'), 'getImageFolder']);

        $imageUploader = new ImageUploader();

        $fileName = $imageUploader->uploadImage($file, $folder);

        if (!$fileName) {
            return response()->json([
                'errors' => [
                    'image' => [
                        0 => 'Image not uploaded'
                    ]
                ]
            ], 422);
        }

        return response()->json(['filename' => $fileName]);
    }
}