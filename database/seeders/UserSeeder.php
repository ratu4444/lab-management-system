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
        User::create([
            'name'      => 'Super Admin',
            'email'     => 'superadmin@djl.com',
            'password'  => bcrypt(12345678),
            'is_client' => false,
        ]);
    }
}
