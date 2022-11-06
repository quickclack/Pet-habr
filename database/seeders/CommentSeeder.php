<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Faker\Generator;

class CommentSeeder extends Seeder
{
    protected $faker;
    public function __construct()
    {
        $this->faker = Container::getInstance()->make(Generator::class);
    }
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {

            $data[] = [
                'article_id' => rand(1, 5),
                'comment' => $this->faker->sentence(10)
            ];
        }

        foreach ($data as $item) {
            DB::table('comments')->insert($item);
        }
    }
}
