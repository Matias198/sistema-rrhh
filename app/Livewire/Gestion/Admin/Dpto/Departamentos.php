<?php

namespace App\Livewire\Gestion\Admin\Dpto;

use App\Models\DepartamentoTrabajo;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Departamentos extends Component
{
    public $departamentos;
    public $departamento_seleccionado;
    public $nombre;
    public $descripcion;
    public $vista_nombre;
    public $vista_descripcion;
    public $editando = false;

    protected function rules()
    {
        if (!$this->editando) {
            return [
                'nombre' => [
                    'required',
                    'max:50',
                    'uppercase',
                    'regex:/^[A-Za-z\s]+$/',
                    Rule::unique('departamento_trabajos', 'nombre'),
                ],
                'descripcion' => 'required|max:255',
            ];
        } else {
            return [
                'nombre' => [
                    'required',
                    'max:50',
                    'uppercase',
                    Rule::unique('departamento_trabajos', 'nombre')->ignore(
                        $this->departamento_seleccionado,
                        'id'
                    ),
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'descripcion' => 'required|max:255',
            ];
        }
    }

    protected $messages = [
        'nombre.required' => 'El campo del nombre es obligatorio.',
        'nombre.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'nombre.unique' => 'El nombre del departamento ya existe.',
        'nombre.max' => 'El nombre del departamento no puede tener más de 50 caracteres.',
        'descripcion.required' => 'El campo de la descripción es obligatorio.',
        'descripcion.max' => 'La descripción del departamento no puede tener más de 255 caracteres.',
    ]; 

    public function editar()
    {
        $this->editando = true;
        $departamento = DepartamentoTrabajo::find($this->departamento_seleccionado);
        $this->nombre = strtoupper($departamento->nombre);
        $this->descripcion = $departamento->descripcion;
        $this->validate();
    }

    public function clear()
    {
        $this->editando = false;
        $this->nombre = '';
        $this->descripcion = '';
        $this->departamento_seleccionado = null;
        $this->vista_nombre = '';
        $this->vista_descripcion = '';
        $this->resetErrorBag();
        $this->dispatch('limpiar-formulario', [$this->nombre, $this->descripcion, $this->departamento_seleccionado]);
    }
 

    public function updated($propertyName)
    {
        if ($propertyName != 'departamento_seleccionado') {
            $this->validateOnly($propertyName);
        }else{
            if ($this->departamento_seleccionado == null) {
                $this->vista_nombre = '';
                $this->vista_descripcion = '';
                return;
            }else{
                $departamento = DepartamentoTrabajo::find($this->departamento_seleccionado);   
                $this->vista_nombre = strtoupper($departamento->nombre);
                $this->vista_descripcion = $departamento->descripcion;
            }
        }
    }

    public function getDepartamentos()
    {
        $this->departamentos = DepartamentoTrabajo::all()->sortBy('nombre');
        return $this->departamentos;
    }
 
    public function guardar()
    {
        $this->validate();        
        DB::beginTransaction();
        if ($this->editando) {
            try {
                $departamento = DepartamentoTrabajo::find($this->departamento_seleccionado);
                $departamento->nombre = $this->nombre;
                $departamento->descripcion = $this->descripcion;
                $departamento->save();
                DB::commit();
                $this->dispatch('success', 'Departamento editado correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo editar el departamento, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        } else {
            try {
                $departamento = new DepartamentoTrabajo();
                $departamento->nombre = $this->nombre;
                $departamento->descripcion = $this->descripcion;
                $departamento->save();
                $this->dispatch('success', 'Departamento creado correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo crear el departamento, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        }
    }
    public function render()
    {
        $this->departamentos = DepartamentoTrabajo::all()->sortBy('nombre');
        return view('livewire.gestion.admin.dpto.departamentos');
    }
}
