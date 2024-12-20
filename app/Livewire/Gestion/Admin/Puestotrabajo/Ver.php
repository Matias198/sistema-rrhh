<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\Empresa;
use App\Models\PuestoTrabajo;
use App\Models\TipoCapacidad;
use Carbon\Carbon;
use Livewire\Component;

class Ver extends Component
{
    public $puestoTrabajo;
    public $capacidades;
    public $tareas;
    public $tipos_capacidades;
    public $tipos_capacidades_puesto;
    public $empresa;
    public $anio_inicio;
    // listeners
    protected $listeners = [
        'verPuestoTrabajo' => 'verPuestoTrabajo',
    ];

    public function verPuestoTrabajo($id)
    {
        $this->puestoTrabajo = PuestoTrabajo::find($id);
        $this->capacidades = $this->puestoTrabajo->capacidadesTrabajos()->get();
        $this->tareas = $this->puestoTrabajo->tareasTrabajos()->get();
        $this->tipos_capacidades = TipoCapacidad::all()->sortBy('nombre');
        foreach ($this->capacidades as $capacidad) {
            $this->tipos_capacidades_puesto[] = $capacidad->tipoCapacidad()->first()->id;
        }
        //dd($this->puestoTrabajo, $this->capacidades, $this->tareas);
    }

    public function clear()
    {
        $this->puestoTrabajo = null;
        $this->capacidades = null;
        $this->tareas = null;
        $this->tipos_capacidades = null;
        $this->tipos_capacidades_puesto = null;
    }

    public function render()
    {
        $this->empresa = Empresa::where('nombre', 'Morfeo S.A.')->first();
        $this->anio_inicio = Carbon::parse($this->empresa->inicio_actividades)->format('Y');
        return view('livewire.gestion.admin.puestotrabajo.ver');
    }
}
