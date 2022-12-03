<?php

namespace Tests\Feature\Domain\User\DTO;

use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\DTO\NewCommentDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class NewCommentDtoTest extends TestCase
{
    use RefreshDatabase;

    public function test_instance_created_from_form_request(): void
    {
        $article = ArticleFactory::new()
            ->createOne();

        $user = UserFactory::new()
            ->createOne();

        $dto = NewCommentDto::formRequest(new Request([
            'comment' => fake()->text(40),
            'article_id' => $article->getKey(),
            'user_id' => $user->getKey(),
        ]));

        $this->assertInstanceOf(NewCommentDto::class, $dto);
    }
}
