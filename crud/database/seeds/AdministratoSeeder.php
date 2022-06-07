<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'email' => 'admin@cyberolympus.com',
            'account_role' => 'administrator',
            'account_type' => 5,
            'password' => Hash::make('cyberadmin'),
        ]);
    }
}
