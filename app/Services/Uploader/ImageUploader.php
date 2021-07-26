<?php

namespace App\Services\Uploader;

use Str;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    /**
     * @param UploadedFile $file
     * @param string $destinationFolder
     * @param string|null $oldFileName
     * @return string|null
     */
    public function uploadImage(UploadedFile $file, string $destinationFolder, ?string $oldFileName = null): ?string
    {
        $disk = Storage::disk('public');

        //Generate file name
        $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension() ? : 'png';

        //Check if folder exist
        if(!$disk->exists($destinationFolder)) {
            $disk->makeDirectory($destinationFolder);
        }

        //Save file in storage
        $saveResult = $disk->put($destinationFolder. DIRECTORY_SEPARATOR . $fileName, fopen($file, 'r+'), 'public');

        if(!$saveResult) {
            return null;
        }

        //Delete old file if needed
        if ($oldFileName != null && $disk->exists($destinationFolder . DIRECTORY_SEPARATOR . $oldFileName)) {
            $disk->delete($destinationFolder . DIRECTORY_SEPARATOR . $oldFileName);
        }

        return $fileName;
    }
}