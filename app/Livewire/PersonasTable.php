<?php

namespace App\Livewire;

use App\Models\Persona;
use App\Models\Sexo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PersonasTable extends PowerGridComponent
{
    public string $tableName = 'personas-table-duh97v-table';

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Persona::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('nombre', fn(Persona $model) => $model->nombre . ' ' . $model->segundo_nombre . ' ' . $model->apellido)
            ->add('dni')
            ->add('sexo', fn(Persona $model) => $model->sexo()->first()->nombre)
            ->add('cuil', fn(Persona $model) => substr($model->cuil, 0, 2) . '-' . substr($model->cuil, 2, 8) . '-' . substr($model->cuil, 10, 1))
            ->add('calle')
            ->add('altura')
            ->add('fecha_nacimiento_formatted', fn(Persona $model) => Carbon::parse($model->fecha_nacimiento)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre completo', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('DNI', 'dni')
                ->sortable()
                ->searchable(),

            Column::make('CUIL', 'cuil')
                ->sortable()
                ->searchable(),

            Column::make('Sexo', 'sexo')
                ->sortable()
                ->searchable(),

            Column::make('Calle', 'calle')
                ->sortable()
                ->searchable(),

            Column::make('Altura', 'altura')
                ->sortable()
                ->searchable(),

            Column::make('Fecha nacimiento', 'fecha_nacimiento_formatted', 'fecha_nacimiento')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_nacimiento'),

            Filter::select('sexo',)
                ->dataSource(Sexo::all())
                ->optionLabel('nombre')
                ->optionValue('id'),

            Filter::inputText('altura')->operators(),
            Filter::inputText('dni')->operators(),
            Filter::inputText('cuil')->operators(),
            Filter::inputText('calle')->operators(),

        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Persona $row): array
    {

        return [
            Button::add('edit')
                ->class('w-full btn btn-primary btn-sm inline-flex items-center align-middle font-medium mr-1')
                ->slot('<a href="#" wire:click.prevent="edit(' . $row->id . ')" class="text-white">
                    <i class="w-4 h-4 mr-2 fa fa-pen"></i>Editar</a>')
                ->id('edit' . $row->id),
            Button::add('destroy')
                ->class('w-full btn btn-danger btn-sm inline-flex items-center align-middle font-medium ml-1')
                ->slot('<a href="#" onclick="destroyDialog(' . $row->id . ', \'' . $row->nombre . '\')" class="text-white">
                    <i class="w-4 h-4 mr-2 fa fa-trash-alt"></i>Eliminar</a>')
                ->id('destroy' . $row->id),

        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
