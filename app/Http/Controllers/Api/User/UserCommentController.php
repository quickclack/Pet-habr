<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Profile\Comment\CommentProfileCollection;
use Domain\User\Queries\CommentBuilder;

class UserCommentController extends Controller
{
    public function getAll(CommentBuilder $builder): CommentProfileCollection
    {
        return new CommentProfileCollection($builder->getCommentByCurrentUser());
    }
}
