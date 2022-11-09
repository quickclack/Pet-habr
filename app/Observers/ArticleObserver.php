<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class ArticleObserver
{
    public function created(): void
    {
        Cache::forget('articles');
        Cache::forget('article');
    }
}
