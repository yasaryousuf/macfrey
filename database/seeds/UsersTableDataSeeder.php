<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'macfrey',
            'email' => 'kamrulnupt@gmail.com',
            'password' => bcrypt('macfrey321')
        ]);
    }
}
