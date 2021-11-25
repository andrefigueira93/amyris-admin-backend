<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TopBannerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TopBannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TopBannerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TopBanner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/top-banner');
        CRUD::setEntityNameStrings('top banner', 'top banners');
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
            ->type('relationship');
        CRUD::column('text')
            ->type('text');
        CRUD::column('link')
            ->type('text');
        CRUD::addColumn([
            'name' => 'active',
            'type' => 'check',
        ]);

        CRUD::column('bgcolor')
            ->type('color')
            ->label('Background Color');
        CRUD::column('textcolor')
            ->type('color')
            ->label('Text Color');

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
        CRUD::setValidation(TopBannerRequest::class);

        CRUD::field('project')
        ->type('relationship');
        CRUD::field('text')
            ->type('text');
        CRUD::field('link')
            ->type('text');
        CRUD::addField([
            'name' => 'active',
            'type' => 'radio',
            'label' => 'Status',
            'options' => [
                0 => 'Disabled',
                1 => 'Enabled'
            ],
            'inline' => true
        ]);
        CRUD::field('bgcolor')
            ->type('color')
            ->label('Background Color');
        CRUD::field('textcolor')
            ->type('color')
        ->label('Text Color');

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
