<?php

namespace Database\Seeders;

use App\Models\Article;
use Domain\Category\Models\Category;
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
