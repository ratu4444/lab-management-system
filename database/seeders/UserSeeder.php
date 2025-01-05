<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $super_admin_data = [
            'name'      => 'Super Admin',
            'email'     => 'superadmin@hirl.com',
            'password'  => bcrypt(12345678),
            'type'      => User::TYPE_SUPERADMIN,
        ];

        User::create($super_admin_data);
    }
}
