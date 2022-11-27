<?php

use Domain\Information\Filters\FilterManager;
use Services\Uploads\Contract\Upload;
use Support\Flash\Flash;

if (!function_exists('filters')) {
    function filters(): array
    {
        return app(FilterManager::class)
            ->getItems();
    }
}

if (!function_exists('flash')) {
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

if (!function_exists('upload')) {
    function upload(): Upload
    {
        return app(Upload::class);
    }
}
