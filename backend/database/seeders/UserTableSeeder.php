<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'name' => 'adal',
                'email' => 'adalgarcia17@gmail.com',
                'password' => bcrypt('adal')
            ],
            [
                'name' => 'julio',
                'email' => 'juliosolai@gmail.com',
                'password' => bcrypt('julio')
            ]
        ];

        foreach ($users as $user)
            \App\Models\User::factory()->create($user);
    }
}
