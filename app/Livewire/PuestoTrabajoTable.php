<?php

namespace App\Livewire;

use App\Models\PuestoTrabajo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class PuestoTrabajoTable extends PowerGridComponent
{
    public string $tableName = 'puesto-trabajo-table-9cnyb2-table';

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
        return PuestoTrabajo::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('titulo_puesto')
            ->add('sueldo_base')
            ->add('id_departamento_trabajo', fn(PuestoTrabajo $model) => $model->departamentoTrabajo()->first()->nombre)
            ->add('created_at_formatted', fn(PuestoTrabajo $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Titulo trabajo', 'titulo_puesto')
                ->sortable()
                ->searchable(),


            Column::make('Sueldo base', 'sueldo_base')
                ->sortable()
                ->searchable(),

            Column::make('Departamento', 'id_departamento_trabajo')
                ->sortable()
                ->searchable(),

            Column::make('Fecha de creacion', 'created_at_formatted')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('id_departamento_trabajo')
                ->dataSource(\App\Models\DepartamentoTrabajo::all())
                ->optionLabel('nombre')
                ->optionValue('id'),

            Filter::inputText('titulo_puesto')->operators(),

            Filter::inputText('sueldo_base')->operators(),

            Filter::datepicker('created_at_formatted'),
        ];
    }

    #[\Livewire\Attributes\On('ver')]
    public function ver($rowId): void
    {

        $this->dispatch('verPuestoTrabajo', $rowId);
    }

    public function actions(PuestoTrabajo $row): array
    {
        return [
            Button::add('edit')
                ->class('w-full btn btn-primary btn-sm inline-flex items-center align-middle font-medium mr-1')
                ->slot('<a type="button" x-on:click="$wire.edit(' . $row->id . ');" class="text-white">
                    <i class="w-4 h-4 mr-2 fa fa-pen"></i>Editar</a>')
                ->id('edit' . $row->id),
            Button::add('destroy')
                ->class('w-full btn btn-secondary btn-sm inline-flex items-center align-middle font-medium ml-1')
                ->slot('<a type="button" x-on:click="$wire.ver(' . $row->id . ');"  class="text-white" data-toggle="modal"
                    data-target="#modal-vista-trabajo">
                    <i class="w-4 h-4 mr-2 fa fa-eye"></i>Ver</a>')
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
