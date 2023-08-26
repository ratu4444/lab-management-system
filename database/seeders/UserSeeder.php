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
            'email'     => 'superadmin@djl.com',
            'password'  => bcrypt(12345678),
            'is_client' => false,
        ];

        $developer_data = [
            'name'      => 'DJL Developer',
            'email'     => 'developer@djl.com',
            'password'  => bcrypt(12345678),
            'is_client' => false,
        ];

        $users_data = [
            $super_admin_data,
            $developer_data
        ];

        User::Insert($users_data);
    }
}
