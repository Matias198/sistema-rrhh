<?php

namespace App\Livewire\Gestion\Admin\Puestotrabajo;

use App\Models\CapacidadesTrabajo;
use App\Models\DepartamentoTrabajo;
use App\Models\TareaTrabajo;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Agregar extends Component
{ 
    public $tareas;
    public $capacidades;
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
        $this->tareas = TareaTrabajo::all()->sortBy('nombre');
        return $this->tareas;
    }

    public function getCapacidades()
    {
        $this->capacidades = CapacidadesTrabajo::all()->sortBy('nombre');
        return $this->capacidades;
    }

}
