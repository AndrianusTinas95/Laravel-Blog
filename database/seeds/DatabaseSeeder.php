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
        $this->call(UserRoleSeeder::class);
        // $this->call(TagSeeder::class);
        // $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
    }
}
