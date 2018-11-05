<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
             factory(App\User::class)->create([
                    "name" => env('ADMIN_USER', "Admin"),
                    "email" => env('ADMIN_EMAIL', "admin@example.com"),
                    "password" => bcrypt(env('ADMIN_PWD', '123456'))]);
    }
       
}
