<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SocialMediaRequest;
use App\Models\Project;
use App\Models\SocialMedia;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SocialMediaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SocialMediaCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SocialMedia::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/social-media');
        CRUD::setEntityNameStrings('social media', 'social media');

        $this->crud->addFilter([
            'name'  => 'project_id',
            'type'  => 'dropdown',
            'label' => 'Project'
        ], Project::all()->pluck('name', 'id')->toArray(), function($value) {
             $this->crud->addClause('where', 'project_id', $value);
        });

        $this->crud->addFilter([
            'name'  => 'name',
            'type'  => 'dropdown',
            'label' => 'Provider'
        ], SocialMedia::all()->pluck('name', 'id')->toArray(), function($value) {
            $this->crud->addClause('where', 'name', $value);
        });

        \Widget::add([
            'type'    => 'div',
            'class'   => 'row',
            'content' => $this->widgets()
        ]);
    }
    public function widgets() {
            $socialMedias = SocialMedia::all();
            $wid = [];
            foreach ($socialMedias->groupBy('name') as $media) {
                $percent = $media->count() / $socialMedias->count() * 100;
                $name = $media[0]->name;
                $wid[] = [
                    'type'          => 'progress_white',
                    'class'         => 'card mb-2 ',
                    'value'         => $name,
                    'description'   => "Projects using the $name network",
                    'progress'      => $percent,
                    'progressClass' => 'progress-bar bg-indigo',
                ];
            }
            return $wid;
    }
    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('project')
            ->type('relationship')
            ->label('Belongs to the project');
        CRUD::column('name')->label('Provider');
        CRUD::column('link')->type('url');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SocialMediaRequest::class);
        CRUD::field('project')
            ->type('relationship')
            ->label('Belongs to the project');
        CRUD::field('name');
        CRUD::field('link');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
