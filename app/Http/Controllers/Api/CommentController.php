<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Comment\CommentCollection;
use Domain\User\Queries\CommentBuilder;

class CommentController extends Controller
{
    public function getCommentsOnArticle(CommentBuilder $builder, int $id): CommentCollection
    {
        return new CommentCollection($builder->getCommentsOnArticle($id));
    }
}
