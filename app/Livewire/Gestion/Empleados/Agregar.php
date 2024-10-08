<?php

namespace App\Livewire\Gestion\Empleados;

use Carbon\Carbon;
use Livewire\Component;

class Agregar extends Component
{
    public $personas;
    public $name;
    public $apellido;
    public $s_nombre;
    public $sexo;
    public $fecha_nacimiento;
    protected function rules(){
        return [
            'name' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido' => 'required|regex:/^[A-Za-z\s]+$/',
            's_nombre' => 'regex:/^[A-Za-z\s]+$/',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required|date|date_format:m-d-Y|before_or_equal:' . Carbon::now()->subYears(16)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d')
        ];
    }

    // Arreglo de mensajes para los rules
    protected $messages = [
        'name.required' => 'El campo del nombre es obligatorio.',
        'name.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'apellido.required' => 'El campo del apellido es obligatorio.',
        'apellido.regex' => 'El campo del apellido solo puede contener letras y espacios.',
        's_nombre.regex' => 'El campo del segundo nombre solo puede contener letras y espacios.',
        'sexo.required' => 'El campo del sexo es obigatorio',
        'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'fecha_nacimiento.before_or_equal' => 'El valor minimo para este campo es 16 años',
        'fecha_nacimiento.after_or_equal' => 'El valor maximo para este campo es 120 años',
        'fecha_nacimiento.date_format' => 'La fecha debe ser en formato día-mes-año (dd-mm-YYYY)'
    ];
    
    public function render()
    {
        return view('livewire.gestion.empleados.agregar');
    }

    // Getters Setters Custom
    public function getAttribute($propertyName)
    {
        return $this->$propertyName;
    }

    public function setAttribute($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
        $this->validateOnly($propertyName);
    }

    public function guardarEmpleado()
    {
        $validatedData = $this->validate();

        //Contact::create($validatedData);
    }
}
