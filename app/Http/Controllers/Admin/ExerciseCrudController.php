<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExerciseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExerciseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ExerciseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Exercise');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/exercise');
        $this->crud->setEntityNameStrings('exercise', 'exercises');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'description', 'type' => 'text', 'label' => 'Description']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ExerciseRequest::class);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField(['name' => 'description', 'type' => 'textarea', 'label' => 'Description']);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Concepts",
            'type' => 'select2_multiple',
            'name' => 'concepts', // the method that defines the relationship in your Model
            'entity' => 'concepts', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Concept", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'description', 'type' => 'textarea', 'label' => 'Description']);
        $this->crud->addColumn(
            [
                'label' => "Concepts",
                'name' => 'concepts', // the method that defines the relationship in your Model
                'type' => 'model_function',
                'function_name' => 'getConceptSlugs',
//                'entity' => 'concepts', // the method that defines the relationship in your Model
//                'attribute' => 'name', // foreign key attribute that is shown to user
//                'model' => "App\Models\Concept", // foreign key model
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ]);
    }

}
