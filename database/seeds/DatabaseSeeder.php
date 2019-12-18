<?php

use App\Models\Concept;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = ['users', 'concept_exercise', 'exercises', 'concepts'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach($this->toTruncate as $table) {
            if(Schema::hasTable($table) != false){
                DB::table($table)->truncate();
                $this->command->info("Truncated table: " . $table);
            }
            else{
                $this->command->error("Table: " . $table . " not found.");
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

         $this->call(BackpackUserSeeder::class);
         $this->call(ExerciseSeeder::class);
         $this->call(ConceptSeeder::class);

        Model::reguard();
    }
}
