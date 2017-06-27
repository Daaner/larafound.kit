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
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'role_id' => 5,
            ],
            [
                'name' => 'user',
                'email' => 'user@admin.com',
                'password' => 'user',
                'role_id' => 0,
            ]
        ];

        foreach ($users as $user) {
            $newUser = User::where('username', '=', $user['username'])->first();
            if ($newUser === null) {
                $newUser = User::create(array(
                    'name'			=> $user['name'],
                    'email'			=> $user['email'],
                    'password'		=> Hash::make ($user['password']),
                ));
            }
        }

        //если нужно народу добавить

        // $faker = Faker::create();
        // foreach (range(1,1000) as $index) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => bcrypt('secret'),
        //     ]);
        // }

    }
}
