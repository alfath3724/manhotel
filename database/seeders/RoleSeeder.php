<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ['nmrole' => 'Admin'],
            ['nmrole' => 'Staff Kebersihan'],
            ['nmrole' => 'Staff Reservasi']
        ];

        DB::table('roles')->insert($role);
    }
}
