<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
        $users = [
            [
                'name' => 'Robby',
                'email' => 'robby@gmail.com',
                'idrole' => 1,
                'password' => Hash::make('admin123')
            ], [
                'name' => 'Alex',
                'email' => 'alex@gmail.com',
                'idrole' => 3,
                'password' => Hash::make('admin123')
            ], [
                'name' => 'Ratna',
                'email' => 'ratna@gmail.com',
                'idrole' => 2,
                'password' => Hash::make('admin123')
            ],
        ];

        DB::table('users')->insert($users);
    }
}
