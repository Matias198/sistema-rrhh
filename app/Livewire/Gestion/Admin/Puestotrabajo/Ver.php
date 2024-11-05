<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\PuestoTrabajo;
use App\Models\TipoCapacidad;
use Livewire\Component;

class Ver extends Component
{
    public $puestoTrabajo;
    public $capacidades;
    public $tareas;
    public $tipos_capacidades;
    public $tipos_capacidades_puesto;
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

    public function render()
    {
        return view('livewire.gestion.admin.puestotrabajo.ver');
    }
}
