<?php

namespace Database\Factories\Domain\User\Models;

use Domain\Information\Models\Article;
use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'comment' => $this->faker->text(100),
            'article_id' => Article::query()
                ->inRandomOrder()
                ->value('id'),
            'user_id' => User::query()
                ->inRandomOrder()
                ->value('id'),
        ];
    }
}
