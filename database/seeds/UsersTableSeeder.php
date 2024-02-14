<?php

use App\Models\Users\User;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(){

        for ($i = 1; $i < 11; $i++){
            User::create([
                'username' => 'テストユーザー' . $i,
                'email' => 'test' .$i. '@gmail.com',
                'password' => bcrypt($i),
            ]);
        }

        User::create([
            'username' => 'adminテストユーザー' . 11,
            'email' => 'admin_test11' . '@gmail.com',
            'password' => bcrypt(11),
            'admin_role' => 1,
        ]);
    }
}
