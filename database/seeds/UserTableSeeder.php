<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => 'xTech',
            "email" => 'xtech@xtech.com.br',
            "password" => bcrypt("xtech")
        ]);

        User::create([
            "name" => 'Lucas Moraes',
            "email" => 'lucas.panik@gmail.com',
            "password" => bcrypt("123456")
        ]);
    }
}
