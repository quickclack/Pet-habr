<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Tag\TagCollection;
use Domain\Information\Queries\TagBuilder;

class TagController extends Controller
{
    public function getAllTags(TagBuilder $builder): TagCollection
    {
        return new TagCollection($builder->getAllTags());
    }
}
