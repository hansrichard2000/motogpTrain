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
        $user = new User();
        $user->name = 'Hans';
        $user->email = 'hans@root.com';
        $user->password = Hash::make('12345678');
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'Hilure';
        $user->email = 'hilure@creator.com';
        $user->password = Hash::make('12345678');
        $user->role_id = 2;
        $user->save();
    }
}
