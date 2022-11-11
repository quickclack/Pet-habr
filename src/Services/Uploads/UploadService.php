<?php

namespace Services\Uploads;

use Illuminate\Http\UploadedFile;
use Services\Uploads\Contract\Upload;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

final class UploadService implements Upload
{
    public function uploadImage(UploadedFile $file): string
    {
        $path = $file->storeAs('articles', $file->hashName(), 'upload');

        if (!$path) {
            throw new UploadException("File wasn't upload");
        }

        return $path;
    }
}
