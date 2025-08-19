<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

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
        $param = [
            'name' => '仮データ太郎',
            'email' => 'TemporaryEmail@example.com',
            'password' => 'temporary'
        ];
        DB::table('users')->insert($param);
    }
}
