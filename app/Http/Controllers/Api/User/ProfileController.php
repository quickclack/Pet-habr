<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ProfileRequest;
use Domain\Information\Models\Article;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['updateUserProfile', 'createArticle']]);
    }*/

    public function updateProfile(ProfileRequest $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $user->updateOrFail($request->validation());

        return response()->json(['message' => 'Данные успешно обновлены']);
    }

    public function createArticle(ArticleRequest $request): JsonResponse
    {
        $article = Article::create($request->validated());

        $article->user_id = auth()->id() ?? null;

        $article->tags()->sync($request->tags);

        return response()->json(['message' => 'Статья отправлена на модерацию']);
    }
}
