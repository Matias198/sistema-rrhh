<?php

namespace App\Livewire;

use OwenIt\Auditing\Models\Audit;
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

final class AuditsTable extends PowerGridComponent
{
    use WithExport;
    public string $tableName = 'audits-table-5tjss3-table';
    public $auditoria_selected;
    public function setUp(): array
    {
        return [
            PowerGrid::exportable(fileName: 'reporte_auditorias')
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
        return Audit::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        /*
        "id" => 1
        "user_type" => "App\Models\User"
        "user_id" => 1
        "event" => "created"
        "auditable_type" => "App\Models\TareaTrabajo"
        "auditable_id" => 1
        "old_values" => "[]"
        "new_values" => "{"nombre":"TAREA DE PRUEBA","descripcion":"Descripcion de prueba","id":1}"
        "url" => "http://127.0.0.1:8000/livewire/update"
        "ip_address" => "127.0.0.1"
        "user_agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36"
        "tags" => null
        "deleted_at" => null
        "created_at" => "2024-11-28 04:41:40"
        "updated_at" => "2024-11-28 04:41:40"
         */
        return PowerGrid::fields()
            ->add('event', fn(Audit $model) => $model->event == 'created' ? 'Creado' : ($model->event == 'updated' ? 'Actualizado' : ($model->event == 'deleted' ? 'Eliminado' : 'Desconocido')))
            ->add('auditable_type')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Evento', 'event')
                ->sortable()
                ->searchable(),

            Column::make('Tipo', 'auditable_type')
                ->sortable()
                ->searchable(),

            Column::make('Fecha Creación', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Fecha Actualización', 'updated_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('event')
                ->dataSource([
                    ['id' => 'created', 'event' => 'Creado'],
                    ['id' => 'updated', 'event' => 'Actualizado'],
                    ['id' => 'deleted', 'event' => 'Eliminado'],
                    ['id' => 'restored', 'event' => 'Restaurado'],
                ])
                ->optionLabel('event')
                ->optionValue('id'),

            Filter::inputText('auditable_type')->operators(),

            Filter::datepicker('created_at'),
            Filter::datepicker('updated_at'),
        ];
    }

    #[\Livewire\Attributes\On('ver')]
    public function ver($rowId): void
    {
        $this->auditoria_selected = Audit::find($rowId);
        $this->dispatch('verAuditoria', $this->auditoria_selected);
    }

    public function actions(Audit $row): array
    {
        return [
            Button::add('ver')
                ->class('w-full btn btn-primary btn-sm inline-flex items-center align-middle font-medium mr-1')
                ->slot('<a type="button" x-on:click="$wire.ver(' . $row->id . ');" class="text-white">
                    <i class="w-4 h-4 mr-2 fa fa-eye"></i>Ver</a>')
                ->id('ver' . $row->id)
        ];
    }
}
