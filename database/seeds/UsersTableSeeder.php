<?php

use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: benjaminfajic
 * Date: 19/11/2018
 * Time: 19:09
 */

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'secret'
        ]);

        $admin->save();

        //factory(App\User::class, 10)->create();
    }
}