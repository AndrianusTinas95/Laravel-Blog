<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 2)->create()->each(function ($role) {
            $role->users()->saveMany(factory(User::class, 1)->make());
        });
    }
}
