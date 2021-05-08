<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLoggedTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql  = file_get_contents(database_path('/seeders/sql/loggedtime_users.sql'));
        DB::statement($sql);
    }
}
