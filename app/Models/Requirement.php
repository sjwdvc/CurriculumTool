<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Requirement extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'requirements';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getConceptSlugs(){
        if($this->concepts->isNotEmpty()){
            $slugs = array();
            foreach($this->concepts as $concept){
                array_push($slugs, '<a href="' . $concept->slug("show").'">'.$concept->name.'</a>');
            }
            return implode(', ', $slugs);
        }
        {
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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function concepts(){
        return $this->belongsToMany(Concept::class);
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
