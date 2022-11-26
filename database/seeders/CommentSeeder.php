<?php

namespace Database\Seeders;

use Domain\User\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Comment::factory(60)
            ->create();
    }
}
