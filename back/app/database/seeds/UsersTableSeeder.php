<?php
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create(['email' => 'ash@netshell.me', 'password' => 'pass', 'name' => 'Ash']);
    }

}