<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{

    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'name' => "Admin",
            'email' => 'admin@todolist.com',
            'password' => Hash::make('password'),
        ]);

        $admin = User::find($userId);

        if ($admin) {
            $admin->assignRole('admin');
        }

    }
}
