<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\CapacidadesTrabajo;
use App\Models\DepartamentoTrabajo;
use App\Models\PuestoTrabajo;
use App\Models\TareaTrabajo;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Agregar extends Component
{
    public $tareas;
    public $tareas_seleccionadas;
    public $capacidades;
    public $capacidades_seleccionadas;
    public $capacidades_excluyentes;
    public $sueldo_base;
    public $departamentos;
    public $departamento_seleccionado;
    public $titulo_puesto;
    public $descripcion_puesto;
    public $editando = false;

    protected function rules()
    {
        if (!$this->editando) {
            return [
                'titulo_puesto' => [
                    'required',
                    'max:50',
                    'uppercase',
                    'regex:/^[A-Za-z\s]+$/',
                    Rule::unique('puesto_trabajos', 'titulo_puesto'),
                ],
                'departamento_seleccionado' => 'required',
                'descripcion_puesto' => 'required|max:255',
                'sueldo_base' => 'required|numeric|min:0',
                'tareas_seleccionadas' => 'required',
                'capacidades_seleccionadas' => 'required',
            ];
        } else {
            return [
                'titulo_puesto' => [
                    'required',
                    'max:50',
                    'uppercase',
                    Rule::unique('puesto_trabajos', 'titulo_puesto')->ignore(
                        $this->capacidad_seleccionada,
                        'id'
                    ),
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'departamento_seleccionado' => 'required',
                'descripcion_puesto' => 'required|max:255',
                'sueldo_base' => 'required|numeric|min:0',
                'tareas_seleccionadas' => 'required',
                'capacidades_seleccionadas' => 'required',
            ];
        }
    }

    protected $messages = [
        'titulo_puesto.required' => 'El campo del nombre es obligatorio.',
        'titulo_puesto.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'titulo_puesto.unique' => 'El nombre del puesto ya existe.',
        'departamento_seleccionado.required' => 'El campo del departamento es obligatorio.',
        'descripcion_puesto.required' => 'El campo de la descripción es obligatorio.',
        'descripcion_puesto.max' => 'El campo de la descripción no puede tener más de 255 caracteres.',
        'sueldo_base.required' => 'El campo del sueldo base es obligatorio.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        $this->departamentos = DepartamentoTrabajo::all()->sortBy('nombre');
        $this->tareas = TareaTrabajo::all()->sortBy('nombre');
        $this->capacidades = CapacidadesTrabajo::all()->sortBy('nombre');
        return view('livewire.gestion.admin.puestotrabajo.agregar');
    }

    public function getTareas()
    {
        // a cada tarea que tenga el id de la tarea seleccionada agregar un campo "selected" con valor true
        $this->tareas = TareaTrabajo::all()->sortBy('nombre');

        if ($this->tareas_seleccionadas != null) {
            foreach ($this->tareas as $tarea) {
                $tarea->selected = false;
                foreach ($this->tareas_seleccionadas as $tarea_seleccionada) {
                    if ($tarea->id == $tarea_seleccionada) {
                        $tarea->selected = true;
                    }
                }
            }
        }

        return $this->tareas;
    }

    public function getCapacidades()
    {
        $this->capacidades = CapacidadesTrabajo::all()->sortBy('nombre');

        if ($this->capacidades_seleccionadas != null) {
            foreach ($this->capacidades as $capacidad) {
                $capacidad->selected = false;
                foreach ($this->capacidades_seleccionadas as $capacidad_seleccionada) {
                    if ($capacidad->id == $capacidad_seleccionada) {
                        $capacidad->selected = true;
                    }
                }
            }
        }

        return $this->capacidades;
    }

    public function clear()
    {
        $this->editando = false;
        $this->titulo_puesto = '';
        $this->descripcion_puesto = '';
        $this->sueldo_base = '';
        $this->departamento_seleccionado = null;
        $this->tareas_seleccionadas = null;
        $this->capacidades_seleccionadas = null;
        $this->capacidades_excluyentes = null;
        $this->resetErrorBag();
        $this->dispatch('limpiar-formulario-puesto-trabajo', [
            $this->titulo_puesto,
            $this->descripcion_puesto,
            $this->sueldo_base,
            $this->departamento_seleccionado,
            $this->tareas_seleccionadas,
            $this->capacidades_seleccionadas,
        ]);
    }

    public function agregarExcluyente($id_capacidad)
    {
        if ($this->capacidades_excluyentes == null) {
            $this->capacidades_excluyentes = [];
        }
        if (in_array($id_capacidad, $this->capacidades_excluyentes)) {
            $this->capacidades_excluyentes = array_diff($this->capacidades_excluyentes, [$id_capacidad]);
        } else {
            array_push($this->capacidades_excluyentes, $id_capacidad);
        }
    }

    public function guardar()
    {
        $this->validate();
        DB::beginTransaction();
        if ($this->editando) {
            try {
                $puesto = PuestoTrabajo::find($this->capacidad_seleccionada);
                $puesto->titulo_puesto = $this->titulo_puesto;
                $puesto->descripcion_generica = $this->descripcion_puesto;
                $puesto->sueldo_base = $this->sueldo_base;
                $puesto->id_departamento_trabajo = $this->departamento_seleccionado;
                $puesto->departamentoTrabajo()->dissociate();
                $puesto->departamentoTrabajo()->associate($this->departamento_seleccionado);
                $puesto->capacidadesTrabajos()->detach();
                $puesto->tareasTrabajos()->detach();
                $puesto->save(); 
                $aux_capacidades = []; 
                foreach ($this->capacidades_seleccionadas as $id_capacidad) {
                    $aux_capacidades[] = [
                        'id_capacidades_trabajo' => $id_capacidad,
                        'excluyente' => in_array($id_capacidad, $this->capacidades_excluyentes),
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }
                $aux_puestos = [];
                foreach ($this->tareas_seleccionadas as $id_tarea) {
                    $aux_puestos[] = [
                        'id_tarea_trabajo' => $id_tarea,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }
                $puesto->capacidadesTrabajos()->sync($aux_capacidades);
                $puesto->tareasTrabajos()->sync($aux_puestos);
                DB::commit();
                $this->dispatch('success-trabajo', 'Puesto de trabajo editado correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error-trabajo', 'No se pudo editar el puesto de trabajo, verifique los datos e intenete nuevamente');
            }
        } else {
            try {
                $puesto = new PuestoTrabajo();
                $puesto->titulo_puesto = $this->titulo_puesto;
                $puesto->descripcion_generica = $this->descripcion_puesto;
                $puesto->sueldo_base = $this->sueldo_base;
                $puesto->id_departamento_trabajo = $this->departamento_seleccionado;
                $puesto->departamentoTrabajo()->associate($this->departamento_seleccionado);
                $puesto->save(); 
                $aux_capacidades = []; 
                foreach ($this->capacidades_seleccionadas as $id_capacidad) {
                    $aux_capacidades[] = [
                        'id_capacidades_trabajo' => $id_capacidad,
                        'excluyente' => in_array($id_capacidad, $this->capacidades_excluyentes),
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }
                $aux_puestos = [];
                foreach ($this->tareas_seleccionadas as $id_tarea) {
                    $aux_puestos[] = [
                        'id_tarea_trabajo' => $id_tarea,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }
                $puesto->capacidadesTrabajos()->sync($aux_capacidades);
                $puesto->tareasTrabajos()->sync($aux_puestos);
                DB::commit();
                $this->dispatch('success-trabajo', 'Puesto de trabajo creado correctamente');
            } catch (\Exception $e) {
                DB::rollBack(); 
                $this->dispatch('error-trabajo', 'No se pudo crear el puesto de trabajo, verifique los datos e intenete nuevamente');
            }
        }
    }
}
