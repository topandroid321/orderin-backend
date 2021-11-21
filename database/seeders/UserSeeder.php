<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
            'name' => 'Topan Nurpana',
            'email' => 'topan@gmail.com',
            'username' => 'topandroid',
            'phone' => '098778882273',
            'role_id' => '1',
            'password' => '$2y$10$YvUJGWOdbPX4idxUa8d4s.jV0l/2HAv7CWy4yhKRmzW61di8LdolG',
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
