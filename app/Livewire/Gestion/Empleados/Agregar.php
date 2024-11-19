<?php

namespace App\Livewire\Gestion\Empleados;

use App\Models\EstadoCivil;
use App\Models\Provincia;
use App\Models\Sexo;
use App\Models\Pais;
use App\Models\Persona;
use App\Rules\Validator\CuilValidator;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Agregar extends Component
{
    use WithFileUploads;
    public $nombre;
    public $apellido;
    public $s_nombre;
    public $sexos;
    public $sexo_selected;
    public $fecha_nacimiento;
    public $cuil;
    public $dni;
    public $paises;
    public $provincias;
    public $municipios;
    public $pais_selected;
    public $provincia_selected;
    public $municipio_selected;
    public $calle;
    public $altura;
    public $estado_civil;
    public $estados_civiles;
    public $archivos = [];
    public $aux_archivos = [];

    protected function rules()
    {
        return [
            // primer caracter en mayuscula, solo letras y espacios
            'nombre' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido' => 'required|regex:/^[A-Za-z\s]+$/',
            's_nombre' => 'regex:/^[A-Za-z\s]+$/',
            'sexo_selected' => 'required',
            'dni' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/|unique:personas,dni',
            'fecha_nacimiento' => 'required|date|date_format:m-d-Y|before_or_equal:' . Carbon::now()->subYears(16)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d'),
            'cuil' => [
                'required',
                'regex:/^[\d]{2,2}-[\d]{8,8}-[\d]{1,2}$/',
                'unique:personas,cuil',
                new CuilValidator($this->dni),
            ],
            'pais_selected' => 'required',
            'provincia_selected' => 'required',
            'municipio_selected' => 'required',
            'calle' => 'required',
            'altura' => 'required|numeric',
            'estado_civil' => 'required',
            'archivos.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ];
    }

    // Arreglo de mensajes para los rules
    protected $messages = [
        'nombre.required' => 'El campo del nombre es obligatorio.',
        'nombre.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'apellido.required' => 'El campo del apellido es obligatorio.',
        'apellido.regex' => 'El campo del apellido solo puede contener letras y espacios.',
        's_nombre.regex' => 'El campo del segundo nombre solo puede contener letras y espacios.',
        'sexo_selected.required' => 'El campo del sexo es obigatorio',
        'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
        'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
        'fecha_nacimiento.before_or_equal' => 'El valor minimo para este campo es 16 años',
        'fecha_nacimiento.after_or_equal' => 'El valor maximo para este campo es 120 años',
        'fecha_nacimiento.date_format' => 'La fecha debe ser en formato día-mes-año (dd-mm-YYYY)',
        'dni.required' => 'El campo del DNI es obligatorio.',
        'dni.regex' => 'El DNI debe ser en formato XXX.XXX.XXX donde las X son digitos. Debe especificar los puntos en las unidades de mil y millón.',
        'dni.unique' => 'El DNI ya se encuentra registrado en la base de datos.',
        'cuil.required' => 'El campo del CUIL es obligatorio.',
        'cuil.regex' => 'El CUIL debe ser en formato XX-XXXXXXXX-XX donde las X son digitos. Debe especificar el guión en la posición 2 y 11.',
        'cuil.unique' => 'El CUIL ya se encuentra registrado en la base de datos.',
        'cuil.cuil_validator' => 'El CUIL debe contener el número de DNI.',
        'pais_selected.required' => 'El campo del país es obligatorio.',
        'provincia_selected.required' => 'El campo de la provincia es obligatorio.',
        'municipio_selected.required' => 'El campo del municipio es obligatorio.',
        'calle.required' => 'El campo de la calle es obligatorio.',
        'altura.required' => 'El campo de la altura es obligatorio.',
        'altura.numeric' => 'La altura debe ser un número.',
        'estado_civil.required' => 'El campo del estado civil es obligatorio.',
    ];

    public function obtenerTodo()
    {
        dd($this->nombre, $this->apellido, $this->s_nombre, $this->sexo_selected, $this->fecha_nacimiento, $this->cuil, $this->dni, $this->pais_selected, $this->provincia_selected, $this->municipio_selected);
    }

    public function updating($propertyName)
    {
        if ($propertyName == 'archivos') {
            foreach ($this->archivos as $archivo) {
                $this->aux_archivos[] = $archivo;
            }
        }
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName == 'archivos') {
            $elementos = $this->archivos;
            $this->archivos = [];
            foreach ($this->aux_archivos as $archivo) {
                $this->archivos[] = $archivo;
            }
            $this->aux_archivos = []; 
            foreach ($elementos as $elemento) {
                // valida si el elemento es pdf, doc, docx, jpg, jpeg, png
                if ($elemento->guessExtension() == 'pdf' || $elemento->guessExtension() == 'doc' || $elemento->guessExtension() == 'docx' || $elemento->guessExtension() == 'jpg' || $elemento->guessExtension() == 'jpeg' || $elemento->guessExtension() == 'png') {
                    //dd($elemento->getClientOriginalName());
                    $encontrado = false;
                    for ($i = 0; $i < count($this->archivos); $i++) {
                        if ($elemento->getClientOriginalName() == $this->archivos[$i]->getClientOriginalName()) {
                            $this->dispatch('errorArchivo', 'El archivo '. $elemento->getClientOriginalName() .' ya se encuentra en la lista.');
                            $encontrado = true;
                        }
                    }
                    if (!$encontrado) {
                        $this->archivos[] = $elemento;
                    }
                } else {
                    $this->dispatch('errorArchivo', 'El archivo debe ser un PDF, DOC, DOCX, JPG, JPEG o PNG.');
                }
            }
            // $this->archivos = $this->aux_archivos;
        }
    }

    public function mount()
    {
        $this->paises = Pais::all()->sortBy('nombre');
        $this->provincias = collect();
        $this->municipios = collect();
        $this->sexos = Sexo::all()->sortBy('nombre');
        $this->estados_civiles = EstadoCivil::all()->sortBy('nombre');
    }

    public function render()
    {
        return view('livewire.gestion.empleados.agregar');
    }

    public function getPais()
    {
        $this->provincias = Pais::find($this->pais_selected)->provincias->sortBy('nombre');
        return $this->provincias;
    }

    public function getProvincia()
    {
        $this->municipios = Provincia::find($this->provincia_selected)->municipios->sortBy('nombre');
        return $this->municipios;
    }

    public function nextStep()
    {
        $this->validate();
        $this->dispatch('stepperNext');
    }

    public function previousStep()
    {
        $this->validate();
        $this->dispatch('stepperPrevious');
    }

    public function guardarArchivos()
    {
        foreach ($this->archivos as $archivo) {
            $archivo->store(path: 'archivos');
        }
        dd('Archivos guardados');
    }

    public function eliminarArchivo($index)
    {
        unset($this->archivos[$index]);
    }
    public function guardarEmpleado()
    {
        $validatedData = $this->validate();

        //Contact::create($validatedData);
    }
}
