<?php

use App\Models\Concept;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 20;

        if (Schema::hasTable('concepts') == false) {
            $this->command->warn("Seeding concepts failed; table 'concepts' doesn't exist in database...");
            return;
        }

        factory(App\Models\Concept::class, $amount)->create();
        $this->command->info('Seeded ' . $amount . ' concepts');
        $concepts = Concept::all();
        foreach($concepts as $concept){
            $conceptToLink = $concepts->random();
            if($conceptToLink->id != $concept->id){
                $concept->concept_id = $conceptToLink->id;
                $concept->save();
            }
        }
    }
}
