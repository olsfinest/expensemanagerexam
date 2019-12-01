<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\UserRole;
use App\ExpenseCat;

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
            'name' => 'admin',
            'email' => 'user1@email.com',
            'is_admin' => 1,
            'role_name' => 'Admin',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'admin1',
            'email' => 'user2@email.com',
            'is_admin' => 1,
            'role_name' => 'Admin',
            'password' => bcrypt('123456')
        ]);

        UserRole::create([
            'user_role' => 'Admin',
            'description' => 'Admin Description',
        ]);

        ExpenseCat::create([
            'display_name' => 'Accomodation',
            'description' => 'Accomodation Description',
        ]);

        ExpenseCat::create([
            'display_name' => 'Meals',
            'description' => 'Food Description',
        ]);

        ExpenseCat::create([
            'display_name' => 'City Services',
            'description' => 'Food Description',
        ]);

    }
}
