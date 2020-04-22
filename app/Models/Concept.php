<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Concept extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'concepts';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
     protected $hidden = ['concept_id'];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getExerciseSlugs(){
        if($this->exercises->isNotEmpty()) {
            $slugs = array();
            foreach ($this->exercises as $exercise) {
                array_push($slugs, '<a href="' . $exercise->slug("show") . '">' . $exercise->name . '</a>');
            }
            return implode(', ', $slugs);
        }
        else{
            return '-';
        }
    }

    public function slug($action){
        try {
            $reflection = new ReflectionClass($this);
            $reflection = strtolower($reflection->getShortName());
            return url(config('backpack.base.route_prefix') . '/' . $reflection . '/' . $this->id . '/' . $action);

        } catch (\ReflectionException $e) {
            return url('/');
        }
    }

    public function getConceptSlug(){
        if($this->concept){
            return '<a href="' . $this->concept->slug("show").'">'.$this->concept->name.'</a>';
        }
        else {
            return '-';
        }
    }

    public function getRequirementsSlug(){
        if($this->requirements->isNotEmpty()) {
            $slugs = array();
            foreach ($this->requirements as $requirement) {
                array_push($slugs, '<a href="' . $requirement->slug("show") . '">' . $requirement->name . '</a>');
            }
            return implode(', ', $slugs);
        }
        else{
            return '-';
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function exercises(){
        return $this->belongsToMany(Exercise::class);
    }

    public function concept(){
        return $this->belongsTo(Concept::class);
    }

    public function requirements(){
        return $this->belongsToMany(Requirement::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
