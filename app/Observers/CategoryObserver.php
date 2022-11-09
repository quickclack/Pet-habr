<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    public function created(): void
    {
        Cache::forget('categories');
        Cache::forget('category');
    }
}
