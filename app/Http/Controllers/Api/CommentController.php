<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Api\Comment\CommentCollection;
use Domain\User\Actions\Contracts\CreateCommentContract;
use Domain\User\DTO\NewCommentDto;
use Domain\User\Queries\CommentBuilder;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function __construct(
        protected CommentBuilder $builder
    ){
    }

    public function getCommentsOnArticle(int $id): CommentCollection
    {
        return new CommentCollection($this->builder->getCommentsOnArticle($id));
    }

    public function store(CommentRequest $request, CreateCommentContract $contract): JsonResponse
    {
        $contract(NewCommentDto::formRequest($request));

        return response()->json(['message' => 'Комментарий успешно добавлен']);
    }

    public function update(CommentRequest $request, int $id): JsonResponse
    {
        $comment = $this->builder->getCommentById($id);

        $this->authorize('update-comment', $comment);

        $comment->update($request->validated());

        return response()->json(['message' => 'Комментарий успешно обновлен']);
    }

    public function destroy(int $id): JsonResponse
    {
        $comment = $this->builder->getCommentById($id);

        $this->authorize('delete-comment', $comment);

        $comment->delete();

        return response()->json(['message' => 'Комментарий успешно удален']);
    }
}
