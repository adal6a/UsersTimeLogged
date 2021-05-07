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
        \App\Models\User::factory()->create([
            'name' => 'adal',
            'email' => 'adalgarcia17@gmail.com',
            'password' => bcrypt('adal')
        ]);
    }
}