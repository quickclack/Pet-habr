<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WithSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 40; $i++) {

            $data[] = [
                'article_id' => rand(1, 40),
                'tag_id' => rand(1, 10),
            ];
        }

        foreach ($data as $item) {
            DB::table('article_tag')->insert($item);
        }
    }
}
