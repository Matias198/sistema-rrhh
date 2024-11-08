<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\TareaTrabajo;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Tareas extends Component
{
    public $tareas;
    public $tarea_seleccionada;
    public $nombre_tarea;
    public $descripcion_tarea;
    public $vista_nombre;
    public $vista_descripcion;
    public $editando = false;

    protected $listeners = [
        'recargar-tareas' => '$refresh'
    ];

    protected function rules()
    {
        if (!$this->editando) {
            return [
                'nombre_tarea' => [
                    'required',
                    'max:50',
                    'uppercase',
                    'regex:/^[A-Za-z\s]+$/',
                    Rule::unique('tarea_trabajos', 'nombre'),
                ],
                'descripcion_tarea' => 'required|max:255',
            ];
        } else {
            return [
                'nombre_tarea' => [
                    'required',
                    'max:50',
                    'uppercase',
                    Rule::unique('tarea_trabajos', 'nombre')->ignore(
                        $this->tarea_seleccionada,
                        'id'
                    ),
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'descripcion_tarea' => 'required|max:255',
            ];
        }
    }

    protected $messages = [
        'nombre_tarea.required' => 'El campo del nombre es obligatorio.',
        'nombre_tarea.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'nombre_tarea.unique' => 'El nombre de la tarea ya existe.',
    ];

    public function getTareas()
    {
        return TareaTrabajo::all()->sortBy('nombre');
    }

    public function editar()
    {
        $this->editando = true;
        $tarea = TareaTrabajo::find($this->tarea_seleccionada);
        $this->nombre_tarea = strtoupper($tarea->nombre);
        $this->descripcion_tarea = $tarea->descripcion;
        $this->validate();
    }

    public function clear()
    {
        $this->editando = false;
        $this->nombre_tarea = '';
        $this->descripcion_tarea = '';
        $this->tarea_seleccionada = null;
        $this->vista_nombre = '';
        $this->vista_descripcion = '';
        $this->resetErrorBag();
        $this->dispatch('limpiar_formulario_tarea', [$this->nombre_tarea, $this->descripcion_tarea, $this->tarea_seleccionada]);
    }

    public function updated($propertyName)
    {
        if ($propertyName != 'tarea_seleccionada') {
            $this->validateOnly($propertyName);
        } else {
            if ($this->tarea_seleccionada == null) {
                $this->vista_nombre = '';
                $this->vista_descripcion = '';
            } else {
                $tarea = TareaTrabajo::find($this->tarea_seleccionada);
                $this->vista_nombre = strtoupper($tarea->nombre);
                $this->vista_descripcion = $tarea->descripcion;
            }
        }
    }



    public function guardar()
    {
        $this->validate();
        DB::beginTransaction();
        if ($this->editando) {
            try {
                $tarea = TareaTrabajo::find($this->tarea_seleccionada);
                $tarea->nombre = $this->nombre_tarea;
                $tarea->descripcion = $this->descripcion_tarea;
                $tarea->save();
                DB::commit();
                $this->dispatch('success_tarea', 'Tarea editada correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error_tarea', 'No se pudo editar la tarea, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        } else {
            try {
                $tarea = new TareaTrabajo();
                $tarea->nombre = $this->nombre_tarea;
                $tarea->descripcion = $this->descripcion_tarea;
                $tarea->save();
                $this->dispatch('success_tarea', 'Tarea creada correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error_tarea', 'No se pudo crear la tarea, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        }
    }
    public function render()
    {
        $this->tareas = TareaTrabajo::all()->sortBy('nombre');
        return view('livewire.gestion.admin.puestotrabajo.tareas');
    }
}
