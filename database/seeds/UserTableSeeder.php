<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = new App\User;
        $u->name = "Admin Aplikasi";
        $u->email = "admin@mail.com";
        $u->password = bcrypt('secret');
        $u->save();
    }
}
