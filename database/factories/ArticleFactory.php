<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
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
