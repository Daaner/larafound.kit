<?php

use Illuminate\Database\Seeder;

use App\User;
// use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // DB::table('users')->delete();

        $users = [
            [
                'name' => 'Администратор',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin111',
                'active' => true,
                'role_id' => 2,
            ],
            [
                'name' => 'Пользователь',
                'username' => 'user',
                'email' => 'user@user.com',
                'password' => 'user111',
                'active' => true,
                'role_id' => 1,
            ],
            [
                'name' => 'vasya',
                'username' => 'Вася',
                'email' => 'vasiliy@google.com',
                'password' => 'user111',
                'active' => 0,
                'role_id' => 1,
            ]
        ];

        foreach ($users as $user) {
            $newUser = User::where('username', '=', $user['username'])->first();
            if ($newUser === null) {
                $newUser = User::create(array(
                    'name'          => $user['name'],
                    'username'		=> $user['username'],
                    'email'			=> $user['email'],
                    'role_id'		=> $user['role_id'],
                    'active'		=> $user['active'],
                    'password'		=> Hash::make ($user['password']),
                ));
            }
        }

        //если нужно народу добавить

        // $faker = Faker::create();
        // foreach (range(1,1000) as $index) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'username' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => bcrypt('secret'),
        //     ]);
        // }

    }
}
