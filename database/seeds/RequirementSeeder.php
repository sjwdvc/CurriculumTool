<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $amount = 20;

        if (Schema::hasTable('requirements') == false) {
            $this->command->warn("Seeding requirements failed; table 'requirements' doesn't exist in database...");
            return;
        }

        factory(App\Models\Requirement::class, $amount)->create();
        $this->command->info('Seeded ' . $amount . ' requirements');
    }
}
