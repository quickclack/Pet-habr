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
            'description' => $this->faker->text(2000),
            'views' => $this->faker->numberBetween(0 ,100),
            'user_id' => User::query()
                ->inRandomOrder()
                ->value('id'),
            'category_id' => Category::query()
                ->inRandomOrder()
                ->value('id'),
            'status' => 5,
            'created_at' => $this->faker->unique()
                ->dateTimeBetween('-2 days', '+1 days')
                ->format('Y-m-d h:m:s'),
        ];
    }
}
