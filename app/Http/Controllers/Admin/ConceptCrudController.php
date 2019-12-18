<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ConceptRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ConceptCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ConceptCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Concept');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/concept');
        $this->crud->setEntityNameStrings('concept', 'concepts');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'description', 'type' => 'text', 'label' => 'Description']);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ConceptRequest::class);
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField(['name' => 'description', 'type' => 'textarea', 'label' => 'Description']);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Exercises",
            'type' => 'select2_multiple',
            'name' => 'exercises', // the method that defines the relationship in your Model
            'entity' => 'exercise', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Exercise", // foreign key model
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
                'label' => "Exercise",
                'name' => 'exercises', // the method that defines the relationship in your Model
                'type' => 'select_multiple',
                'entity' => 'exercises', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\Models\Exercise", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ]);
    }
}
