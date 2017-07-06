<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'          => 'Users',
                'description'   => 'Пользователи',

            ],
            [
                'name'          => 'Managers',
                'description'   => 'Менеджеры',

            ],
            [
                'name'          => 'Administrators',
                'description'   => 'Администраторы',
            ]
        ];

        foreach ($roles as $role) {
            $newRole = Role::where('name', '=', $role['name'])->first();
            if ($newRole === null) {
                $newRole = Role::create(array(
                    'name'          => $role['name'],
                    'description'	=> $role['description'],
                ));
            }
        }
    }
}
