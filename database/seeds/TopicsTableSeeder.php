<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $users_id=User::all()->pluck('id')->toArray();

        $categories_id= Category::all()->pluck('id')->toArray();

        $faker= app(Faker\Generator::class);

        $topics = factory(Topic::class)
                    ->times(100)
                    ->make()
                    ->each(function ($topic, $index) use($users_id, $categories_id, $faker) {

                   //从用户id数组中随机取出一个并赋值
                   $topic->user_id=$faker->randomElement($users_id);

                   $topic->category_id=$faker->randomElement($categories_id);
        });

        Topic::insert($topics->toArray());
    }

}

