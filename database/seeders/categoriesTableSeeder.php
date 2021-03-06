<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1,10) as $index) {
            $name = $faker->name;
            Category::create([
                'user_id' => rand(1,10),
                'name'    => $name,
                'slug'    => strtolower(str_replace(' ','_',$name)),
                'status'  => 'active'
            ]);
        }
    }
}
