<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 20;

        if (Schema::hasTable('exercises') == false) {
            $this->command->warn("Seeding exercises failed; table 'exercises' doesn't exist in database...");
            return;
        }

        factory(App\Models\Exercise::class, $amount)->create();
        $this->command->info('Seeded ' . $amount . ' exercises');
    }
}
