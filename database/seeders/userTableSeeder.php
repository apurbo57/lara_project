<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $this->defaultUser();

        foreach ( range(1,10) as $index) {
            User::create([
                'name'      => $faker->name,
                'email'     => $faker->unique()->email,
                'password'  => bcrypt($faker->password),
            ]);
        }

    }

    public function defaultUser(){
        User::create([
            'name'      => 'admin',
            'email'     => 'datingbaby03@gmail.com',
            'password'  => bcrypt(123456),
        ]);
    }
}
