<?php

namespace App\Livewire;

use App\Models\Municipio;
use App\Models\Persona;
use App\Models\PuestoTrabajo;
use App\Models\Sexo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Components\SetUp\Exportable;

final class PersonasSystemTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'personas-system-table-goqdsg-table';

    public function setUp(): array
    {
        return [
            PowerGrid::exportable(fileName: 'nomina_jefes_area')
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV)
                ->striped('A6ACCD') 
                ->csvSeparator(separator: ',')
                ->csvDelimiter(delimiter: "'"),

            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $query = Persona::query()
            ->select('personas.*')
            ->join('empleados', 'empleados.id_persona', '=', 'personas.id')
            ->join('puesto_trabajos', 'puesto_trabajos.id', '=', 'empleados.id_puesto_trabajo')
            ->join('sexos', 'sexos.id', '=', 'personas.id_sexo')
            ->join('municipios', 'municipios.id', '=', 'personas.id_municipio')
            ->whereHas('usuario.roles', function ($query) {
                $query->where('name', 'JEFE DE AREA');
            })
            ->with('empleado', 'sexo');

        // Verifica si hay un filtro de fecha aplicado
        if (!empty($this->filters['fecha_ingreso'])) {
            $query->whereHas('empleado', function ($q) {
                $q->whereDate('fecha_ingreso', '=', $this->filters['fecha_ingreso']);
            });
        }


        return $query;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('legajo', fn(Persona $model) => $model->empleado->legajo)
            ->add('nombre', fn(Persona $model) => $model->nombre . ' ' . $model->segundo_nombre . ' ' . $model->apellido)
            ->add('sexo', fn(Persona $model) => $model->sexo->nombre)
            ->add('cuil')
            ->add('titulo_puesto', fn(Persona $model) => $model->empleado->puesto->titulo_puesto)
            ->add('municipio', fn(Persona $model) => $model->municipio->nombre)
            ->add('fecha_ingreso_formatted', fn(Persona $model) => Carbon::parse($model->empleado->fecha_ingreso)->format('d/m/Y'));
    }


    public function columns(): array
    {
        return [
            Column::make('Legajo', 'legajo')
                ->sortable()
                ->searchable(),

            Column::make('Nombre completo', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('CUIL', 'cuil')
                ->sortable()
                ->searchable(),

            Column::make('Sexo', 'sexo')
                ->sortable()
                ->searchable(),

            Column::make('Municipio', 'municipio')
                ->sortable(),

            Column::make('Fecha de ingreso', 'fecha_ingreso_formatted')
                ->sortable(),

            Column::make('Puesto', 'titulo_puesto')
                ->sortable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('legajo')->operators(),
            Filter::inputText('cuil')->operators(),

            Filter::datepicker('fecha_ingreso_formatted', 'empleados.fecha_ingreso'),

            Filter::select('sexo', 'personas.id_sexo')
                ->dataSource(Sexo::all())
                ->optionLabel('nombre')
                ->optionValue('id'),

            Filter::select('titulo_puesto', 'empleados.id_puesto_trabajo')
                ->dataSource(PuestoTrabajo::all())
                ->optionLabel('titulo_puesto')
                ->optionValue('id'),

            Filter::multiSelect('municipio', 'personas.id_municipio')
                ->dataSource(Municipio::all()->sortBy('nombre'))
                ->optionLabel('nombre')
                ->optionValue('id'),
        ];
    }



    #[\Livewire\Attributes\On('ver')]
    public function ver($rowId) 
    {
        // Navegar a la vista de ver empleado
        return redirect()->route('gestion-empleados-ver', $rowId);
    }

    public function actions(Persona $row): array
    {

        return [
            Button::add('ver')
                ->class('w-full btn btn-primary btn-sm inline-flex items-center align-middle font-medium mr-1')
                ->slot('<a href="#" wire:click.prevent="ver(' . $row->id . ')" class="text-white">
                    <i class="w-4 h-4 mr-2 fa fa-eye"></i>Ver</a>')
                ->id('ver' . $row->id),

            // Button::add('destroy')
            //     ->class('w-full btn btn-danger btn-sm inline-flex items-center align-middle font-medium ml-1')
            //     ->slot('<a href="#" onclick="destroyDialog(' . $row->id . ', \'' . $row->nombre . '\')" class="text-white">
            //         <i class="w-4 h-4 mr-2 fa fa-trash-alt"></i>Eliminar</a>')
            //     ->id('destroy' . $row->id),

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
