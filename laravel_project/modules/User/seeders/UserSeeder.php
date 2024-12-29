<?php

namespace Modules\User\seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i = 0;$i < 30;$i++) {
            $user = new User();
            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->password = Hash::make('123456');
            $user->group_id = 1;
            $user->save();
        }
        
    }
}
