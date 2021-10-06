<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class postTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,20) as $index) {
            $name = $faker->name;
            Post::create([
                'user_id'       => rand(1,10),
                'category_id'   => rand(1,10),
                'title'         => $name,
                'slug'          => strtolower(str_replace(' ','_',$name)),
                'desc'          => $faker->paragraph,
                'image'         => $faker->imageUrl(),
            ]);
        }
    }
}
