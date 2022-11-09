<?php

namespace Database\Factories\Domain\Information\Models;

use Domain\Information\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(4, true)),
        ];
    }
}
