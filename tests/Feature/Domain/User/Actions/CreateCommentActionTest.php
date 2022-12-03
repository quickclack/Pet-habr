<?php

namespace Tests\Feature\Domain\User\Actions;

use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Actions\Contracts\CreateCommentContract;
use Domain\User\DTO\NewCommentDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateCommentActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_comment_created(): void
    {
        $article = ArticleFactory::new()
            ->createOne();

        $user = UserFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        $actions = app(CreateCommentContract::class);

        $actions(NewCommentDto::make(fake()->text(40), $article->getKey(), $user->getKey()));

        $this->assertDatabaseHas('comments', [
            'article_id' => $article->getKey(),
            'user_id' => $user->getKey()
        ]);
    }
}
