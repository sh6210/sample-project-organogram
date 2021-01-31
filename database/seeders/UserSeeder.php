<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 89; $i++) {
            $custom[] = [
                "name" => "user$i",
                "email" => "email$i@test.com",
                "password" => bcrypt("123456"),
                "created_at" => now(),
            ];
        }

        DB::table('users')->insert($custom);
    }
}
