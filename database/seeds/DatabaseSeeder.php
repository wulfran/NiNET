<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'email' => 'super@user.pl',
            'password' => bcrypt('tester'),
            'first_name' => 'super',
            'last_name' => 'user',
            'account_type' => 'superuser',
        ];
        \App\User::create($data);

        // $this->call(UsersTableSeeder::class);
    }
}
