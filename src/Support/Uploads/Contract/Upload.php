<?php

namespace Support\Uploads\Contract;

use Illuminate\Http\UploadedFile;

interface Upload
{
    public function uploadImage(UploadedFile $file, string $directory): string;
}
