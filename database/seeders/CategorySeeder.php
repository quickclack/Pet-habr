<?php

namespace Database\Seeders;

use Domain\Information\Models\Category;
use Domain\Information\Models\Article;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(5)
            ->has(Article::factory(rand(5,15)))
            ->create();
    }
}
