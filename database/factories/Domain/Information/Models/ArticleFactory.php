<?php

namespace Database\Factories\Domain\Information\Models;

use Domain\Information\Models\Category;
use Domain\Information\Models\Article;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'description' => $this->faker->text,
            'views' => 0,
            'user_id' => User::query()
                ->inRandomOrder()
                ->value('id'),
            'category_id' => Category::query()
                ->inRandomOrder()
                ->value('id'),
            'status' => 5
        ];
    }
}
