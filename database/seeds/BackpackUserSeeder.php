<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class BackpackUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        if (Schema::hasTable('users') == false) {
            $this->command->warn("Seeding Users failed; table 'users' doesn't exist in database...");
            return;
        }

        $faker = Faker::create('nl_NL');

        DB::table('users')->insert([
            'name' => 'Stefano',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
        ]);
        $this->command->info("Seeded user Stefano (admin@mail.com) with password 'admin'");
    }
}
