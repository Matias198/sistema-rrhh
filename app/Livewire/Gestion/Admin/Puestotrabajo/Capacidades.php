<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\CapacidadesTrabajo;
use App\Models\TipoCapacidad;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Capacidades extends Component
{
    public $tipos_capacidades;
    public $tipo_seleccionado;
    public $tipo;
    public $capacidades;
    public $capacidad_seleccionada;
    public $nombre_capacidad;
    public $descripcion_capacidad;
    public $vista_nombre;
    public $vista_descripcion;
    public $editando = false;

    protected $listeners = [
        'recargar-capacidades' => '$refresh'
    ];

    protected function rules()
    {
        if (!$this->editando) {
            return [
                'nombre_capacidad' => [
                    'required',
                    'max:50',
                    'uppercase',
                    'regex:/^[A-Za-z\s]+$/',
                    Rule::unique('capacidades_trabajos', 'nombre'),
                ],
                'descripcion_capacidad' => 'required|max:255',
            ];
        } else {
            return [
                'nombre_capacidad' => [
                    'required',
                    'max:50',
                    'uppercase',
                    Rule::unique('capacidades_trabajos', 'nombre')->ignore(
                        $this->capacidad_seleccionada,
                        'id'
                    ),
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'descripcion_capacidad' => 'required|max:255',
            ];
        }
    }

    protected $messages = [
        'nombre_capacidad.required' => 'El campo del nombre es obligatorio.',
        'nombre_capacidad.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'nombre_capacidad.unique' => 'El nombre de la capacidad ya existe.',
    ];

    public function getCapacidades()
    {
        return $this->capacidades = CapacidadesTrabajo::all()->sortBy('nombre');
    }

    public function editar()
    {
        $this->editando = true;
        $capacidad = CapacidadesTrabajo::find($this->capacidad_seleccionada);
        $this->nombre_capacidad = strtoupper($capacidad->nombre);
        $this->descripcion_capacidad = $capacidad->descripcion;
        $this->tipo_seleccionado = $capacidad->id_tipo_capacidad;
        $this->dispatch('editar-capacidad', [$this->tipo_seleccionado]);
        $this->validate();
    }

    public function clear()
    {
        $this->editando = false;
        $this->nombre_capacidad = '';
        $this->descripcion_capacidad = '';
        $this->capacidad_seleccionada = null;
        $this->tipo_seleccionado = null;
        $this->vista_nombre = '';
        $this->vista_descripcion = '';
        $this->tipo = '';
        $this->resetErrorBag();
        $this->dispatch('limpiar-formulario-capacidad', [$this->nombre_capacidad, $this->descripcion_capacidad, $this->capacidad_seleccionada, $this->tipo_seleccionado]);
    }

    public function updated($propertyName)
    {
        if ($propertyName != 'capacidad_seleccionada') {
            $this->validateOnly($propertyName);
        } else {
            if ($this->capacidad_seleccionada == null) {
                $this->vista_nombre = '';
                $this->vista_descripcion = '';
                $this->tipo = '';
            } else {
                $capacidad = CapacidadesTrabajo::find($this->capacidad_seleccionada);
                $this->vista_nombre = strtoupper($capacidad->nombre);
                $this->vista_descripcion = $capacidad->descripcion;
                $this->tipo = $capacidad->tipoCapacidad->nombre;
            }
        }
    }

    public function eliminar()
    {
        if ($this->editando) {
            DB::beginTransaction();
            try {
                $capacidad = CapacidadesTrabajo::find($this->capacidad_seleccionada);
                $capacidad->delete();
                $this->dispatch('success_capacidad', 'Capacidad eliminada correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error_capacidad', 'No se pudo eliminar la capacidad, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        }else {
            $this->dispatch('error_capacidad', 'No se puede eliminar una capacidad que no existe');
        }
    }

    public function guardar()
    {
        $this->validate();
        DB::beginTransaction();
        if ($this->editando) {
            try {
                $capacidad = CapacidadesTrabajo::find($this->capacidad_seleccionada);
                $capacidad->nombre = $this->nombre_capacidad;
                $capacidad->descripcion = $this->descripcion_capacidad;
                $capacidad->tipoCapacidad()->dissociate();
                $capacidad->id_tipo_capacidad = $this->tipo_seleccionado;
                $capacidad->tipoCapacidad()->associate($this->tipo_seleccionado);
                $capacidad->save();
                DB::commit();
                $this->dispatch('success_capacidad', 'Capacidad editada correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error_capacidad', 'No se pudo editar la capacidad, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        } else {
            try {
                $capacidad = new CapacidadesTrabajo();
                $capacidad->nombre = $this->nombre_capacidad;
                $capacidad->descripcion = $this->descripcion_capacidad;
                $capacidad->id_tipo_capacidad = $this->tipo_seleccionado;
                $capacidad->tipoCapacidad()->associate($this->tipo_seleccionado);
                $capacidad->save();
                $this->dispatch('success_capacidad', 'Capacidad creada correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error_capacidad', 'No se pudo crear la capacidad, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        }
    }
    public function render()
    {
        $this->tipos_capacidades = TipoCapacidad::all()->sortBy('name');
        $this->capacidades = CapacidadesTrabajo::all()->sortBy('nombre');
        return view('livewire.gestion.admin.puestotrabajo.capacidades');
    }
}
