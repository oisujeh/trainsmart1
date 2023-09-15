<?php

namespace App\Http\Livewire;

use App\Models\Training;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridColumns,
    Responsive};

final class Trainings extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        /*$this->showCheckBox();*/

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(mode: 'full'),
            Responsive::make(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<Training>
     */

    public function datasource(): Builder
    {
        return Training::query()
            ->join('directorates','trainings.directorate_id','=','directorates.id')
            ->join('training_titles','trainings.training_title_id','=','training_titles.id')
            ->select('trainings.*', 'directorates.name as directorates','training_titles.title AS titles');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('directorates')
            ->addColumn('titles')
            ->addColumn('start_date_formatted', fn (Training $model) => Carbon::parse($model->start_date)->format('d/m/Y'))
            ->addColumn('location')

           /** Example of custom column using a closure **/
            ->addColumn('location_lower', fn (Training $model) => strtolower(e($model->location)))

            ->addColumn('method');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make('Directorates', 'directorates')
                ->sortable()
                ->searchable(),

            Column::make('Training title', 'titles')
                ->sortable()
                ->searchable(),

            Column::make('Start date', 'start_date_formatted', 'start_date')
                ->sortable(),

            Column::make('Office', 'location')
                ->sortable()
                ->searchable(),

            Column::make('Method', 'method')
                ->sortable()
                ->searchable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::datepicker('start_date'),
            Filter::select('location','location')
                ->dataSource(Training::select('location')->distinct()->get())
                ->optionValue('location')
                ->optionLabel('location'),
            Filter::inputText('method')->operators(['contains']),
            Filter::inputText('venue')->operators(['contains']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Training Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('trainings.edit', function(Training $model) {
                    return ['id'=>$model->id];
               }),

           Button::make('destroy', 'Delete')
               ->class('bg-red-700 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('', function(\App\Models\Training $model) {
                    return $model->id;
               })
               ->method('delete')
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Training Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($training) => $training->id === 1)
                ->hide(),
        ];
    }
    */
}
