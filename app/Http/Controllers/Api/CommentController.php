<?php

namespace App\Http\Controllers\Api;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Article\ArticleCollection;
use App\Http\Resources\Api\Article\ArticleRelationResource;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB; //TODO:убрать

class CommentController extends Controller
{
    private function getChildComments(int $articleId, $parentCommentId, $maxDepth)
    {
        $data =
            DB::table('comments')
                ->where('article_id', $articleId)
                ->where('parent_comment_id', $parentCommentId)
                ->get()
                ->map(function ($item) use ($articleId, $maxDepth) {
                    $resutItem =
                        [
                            "id" => $item->id,
                            "comment" => $item->comment,
                            "created_at" => $item->created_at,
                            "updated_at" => $item->updated_at,
                            "user" => DB::table('users')->where('id', $item->user_id)->pluck('nickName')->first()
                        ];
                    if ($maxDepth > 0) {
                        $subComments = $this->getChildComments($articleId, $item->id, $maxDepth - 1);
                    } else {
                        $subComments = [];
                    }
                    if (count(($subComments)) > 0) {
                        $resutItem["sub_comments"] = $subComments;
                    }

                    return $resutItem;
                })
                ->toArray();
        return $data;
    }

    public function getComments(int $articleId)
    {
        $response = $this->getChildComments($articleId, null, 100);
        return response()->json($response, 200);
    }
}
