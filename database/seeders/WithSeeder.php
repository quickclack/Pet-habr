<?php

namespace Database\Seeders;

use Domain\Information\Models\Article;
use Domain\Information\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 40; $i++) {

            $data[] = [
                'article_id' => Article::query()
                    ->inRandomOrder()
                    ->value('id'),
                'tag_id' => Tag::query()
                    ->inRandomOrder()
                    ->value('id'),
            ];
        }

        foreach ($data as $item) {
            DB::table('article_tag')->insert($item);
        }
    }
}
