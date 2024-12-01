<?php

namespace App\Livewire\Gestion\Empleados;

use App\Mail\ContratoEmpleado;
use App\Models\CapacidadesTrabajo;
use App\Models\ContactoEmergencia;
use App\Models\Contrato;
use App\Models\DocumentoCertificado;
use App\Models\Empleado;
use App\Models\EstadoCivil;
use App\Models\Familiar;
use App\Models\Municipio;
use App\Models\Empresa;
use App\Models\Evento;
use App\Models\ObraSocial;
use App\Models\Provincia;
use App\Models\Sexo;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\PuestoTrabajo;
use App\Models\RelacionFamilia;
use App\Models\TipoContrato;
use App\Models\TipoDocumento;
use App\Models\TipoJornada;
use App\Models\TipoRelacion;
use App\Models\User;
use App\Rules\Validator\CuilValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Throwable;

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
    public $departamento;
    public $estado_civil;
    public $estados_civiles;
    public $tiene_familiares = false;
    public $familiares_cargo = [];
    public $nombre_familiar;
    public $apellido_familiar;
    public $sexo_selected_familiar;
    public $dni_familiar;
    public $fecha_nacimiento_familiar;
    public $tipo_relacion_familiar_selected;
    public $relaciones_familiares_dos;
    public $tipo_relacion_familiar_selected_dos;
    public $relaciones_familiares;
    public $certificado_familiar;
    public $obras_sociales;
    public $tiene_obra_social = false;
    public $obra_social_selected;
    public $numero_afiliado;
    public $autorizacion_padres;
    public $copia_dni;
    public $certificado_domicilio;
    public $email;
    public $nombre_emergencia;
    public $apellido_emergencia;
    public $telefono_emergencia;
    public $email_emergencia;
    public $contactos_emergencia = [];
    public $tipo_jornadas;
    public $tipo_jornadas_selected;
    public $tipo_contratos;
    public $tipo_contratos_selected;
    public $fecha_ingreso;
    public $fecha_vencimiento;
    public $contrato_trabajo;
    public $puestos_de_trabajo;
    public $puesto_de_trabajo_selected;
    public $competencias;
    public $competencias_selected = [];
    public $currirulum_vitae;
    public $tipos_documentos;
    public $hora_entrada;
    public $hora_salida;
    public $hora_inicio_receso;
    public $hora_fin_receso;
    public $sueldo;
    public $roles;
    public $rol_seleccionado;
    public $not_contrato_indeterminado = true;

    protected function rules()
    {
        return [
            // Datos generales
            'nombre' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido' => 'required|regex:/^[A-Za-z\s]+$/',
            's_nombre' => 'regex:/^[A-Za-z\s]+$/',
            'sexo_selected' => 'required',
            'dni' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/|unique:personas,dni',
            'fecha_nacimiento' => 'required|date|date_format:d-m-Y|before_or_equal:' . Carbon::now()->subYears(16)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d'),
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
            'altura' => 'numeric|nullable|min:0',
            'departamento' => 'nullable|regex:/^[A-Za-z0-9\s]+$/',
            'estado_civil' => 'required',

            // Obra social
            'numero_afiliado' => 'required_if:tiene_obra_social,true|numeric',
            'obra_social_selected' => 'required_if:tiene_obra_social,true',

            // Contacto Emergencia
            'nombre_emergencia' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido_emergencia' => 'required|regex:/^[A-Za-z\s]+$/',
            'telefono_emergencia' => 'required|regex:/^[\d]{4}-[\d]{6}$/',
            'email_emergencia' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|unique:contacto_emergencia,email',

            // Contrato
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            'contactos_emergencia' => 'required',
            'tipo_jornadas_selected' => 'required',
            'tipo_contratos_selected' => 'required',
            'fecha_ingreso' => 'required|date|date_format:d-m-Y',
            'fecha_vencimiento' => 'required_if:not_contrato_indeterminado,true|date|date_format:d-m-Y|after:fecha_ingreso',
            'contrato_trabajo' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'puesto_de_trabajo_selected' => 'required',
            'competencias_selected' => 'required',
            'currirulum_vitae' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',

            // Autorización de padres
            'autorizacion_padres' => 'required_if:fecha_nacimiento,' . Carbon::now()->subYears(16)->format('d-m-Y') . '|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',

            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'hora_inicio_receso' => 'after:hora_entrada|before:hora_salida',
            'hora_fin_receso' => 'after:hora_inicio_receso|before:hora_salida',
            'sueldo' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',

            // Roles
            'rol_seleccionado' => 'required',
        ];
    }

    // Arreglo de mensajes para los rules
    protected $messages = [

        // Datos generales

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
        'altura.numeric' => 'La altura debe ser un número.',
        'altura.min' => 'La altura debe ser mayor a 0.',
        'departamento.regex' => 'El departamento solo puede contener letras, números y espacios.',
        'estado_civil.required' => 'El campo del estado civil es obligatorio.',

        // Obra social
        'numero_afiliado.required_if' => 'El número de afiliado es obligatorio si tiene obra social.',
        'numero_afiliado.numeric' => 'El número de afiliado debe ser un número.',
        'obra_social_selected.required_if' => 'La obra social es obligatoria si tiene obra social.',

        // Contacto Emergencia
        'nombre_emergencia.required' => 'El campo del nombre es obligatorio.',
        'nombre_emergencia.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'apellido_emergencia.required' => 'El campo del apellido es obligatorio.',
        'apellido_emergencia.regex' => 'El campo del apellido solo puede contener letras y espacios.',
        'telefono_emergencia.required' => 'El campo del teléfono es obligatorio.',
        'telefono_emergencia.regex' => 'El teléfono debe ser en formato XXXX-XXXXXX donde las X son digitos. Debe especificar los guiones en las unidades de mil y millón.',
        'email_emergencia.required' => 'El campo del email es obligatorio.',
        'email_emergencia.email' => 'El email debe ser un email válido.',
        'email_emergencia.unique' => 'El email ya se encuentra registrado en la base de datos.',

        'email.required' => 'El campo del email es obligatorio.',
        'email.email' => 'El email debe ser un email válido.',

        'contactos_emergencia.required' => 'Debe agregar al menos un contacto de emergencia.',
        'tipo_jornadas_selected.required' => 'El campo de la jornada es obligatorio.',
        'tipo_contratos_selected.required' => 'El campo del contrato es obligatorio.',
        'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',

        'hora_entrada.required' => 'El campo de la hora de entrada es obligatorio.',
        'hora_salida.required' => 'El campo de la hora de salida es obligatorio.',
        'hora_inicio_receso.after' => 'El campo de la hora de inicio de receso debe ser posterior a la hora de entrada.',
        'hora_inicio_receso.before' => 'El campo de la hora de inicio de receso debe ser anterior a la hora de fin de receso.',
        'hora_fin_receso.after' => 'El campo de la hora de fin del receso debe ser posterior a la hora de inicio del receso.',
        'hora_fin_receso.before' => 'El campo de la hora de fin de receso debe ser anterior a la hora de salida.',


        'sueldo.required' => 'El campo del sueldo es obligatorio.',
        'sueldo.numeric' => 'El sueldo debe ser un número.',
        'sueldo.min' => 'El sueldo debe ser mayor a 0.',
        'sueldo.regex' => 'El sueldo debe ser un número con dos decimales.',

        // Roles
        'rol_seleccionado.required' => 'El campo del rol es obligatorio.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        if ($propertyName == 'puesto_de_trabajo_selected') {
            $this->competencias = PuestoTrabajo::find($this->puesto_de_trabajo_selected)->capacidadesTrabajos()->get();
        }

        if ($propertyName == 'tiene_familiares' || $propertyName == 'tiene_obra_social') {
            $this->dispatch('actualizar');
        }

        if ($propertyName == 'tipo_contratos_selected') {
            $tipoContrato = TipoContrato::find($this->tipo_contratos_selected);
            if ($tipoContrato->nombre == 'Contrato a tiempo indeterminado') {
                $this->not_contrato_indeterminado = false;
                $this->fecha_vencimiento = '';
                $this->dispatch('control_fecha', true);
            } else {
                $this->dispatch('control_fecha', false);
            }
        }

        if ($this->hora_inicio_receso){
            $this->validate([
                'hora_inicio_receso' => 'after:hora_entrada|before:hora_salida',
            ],[
                'hora_inicio_receso.after' => 'El campo de la hora de inicio de receso debe ser posterior a la hora de entrada.',
                'hora_inicio_receso.before' => 'El campo de la hora de inicio de receso debe ser anterior a la hora de fin de receso.',
            ]);
        }

        if ($this->hora_fin_receso){
            $this->validate([
                'hora_fin_receso' => 'after:hora_inicio_receso|before:hora_salida',
            ],[
                'hora_fin_receso.after' => 'El campo de la hora de fin del receso debe ser posterior a la hora de inicio del receso.',
                'hora_fin_receso.before' => 'El campo de la hora de fin de receso debe ser anterior a la hora de salida.',
            ]);
        }
    }
    public function mount()
    {
        $this->paises = Pais::all()->sortBy('nombre');
        $this->provincias = collect();
        $this->municipios = collect();
        $this->sexos = Sexo::all()->sortBy('nombre');
        $this->relaciones_familiares = TipoRelacion::all()->sortBy('nombre');
        $this->relaciones_familiares_dos = RelacionFamilia::all()->sortBy('nombre');
        $this->obras_sociales = ObraSocial::all()->sortBy('nombre');
        $this->estados_civiles = EstadoCivil::all()->sortBy('nombre');
        $this->tipo_jornadas = TipoJornada::all()->sortBy('nombre');
        $this->tipo_contratos = TipoContrato::all()->sortBy('nombre');
        $this->puestos_de_trabajo = PuestoTrabajo::all()->sortBy('nombre');
        $this->tipos_documentos = TipoDocumento::all()->sortBy('nombre');
        if (User::find(Auth::user()->id)->hasRole('SYSADMIN')) {
            $this->roles = Role::whereNot('name', 'SYSADMIN')->get()->sortBy('name');
        }else{
            $this->roles = Role::whereNot('name', 'SYSADMIN')->whereNot('name', 'DIRECTOR GENERAL')->get()->sortBy('name');
        }        
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
        $this->dispatch('stepperNext');
    }

    public function previousStep()
    {
        $this->dispatch('stepperPrevious');
    }

    private function validarObraSocial()
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                $errors = $validator->messages()->messages();
                foreach ($errors as $i => $value) {
                    $this->dispatch('error_critico', $value[0]);
                    return;
                }
            });
        })->validate(['numero_afiliado' => 'required', 'obra_social_selected' => 'required'], ['numero_afiliado.required' => 'El número de afiliado es obligatorio.', 'obra_social_selected.required' => 'La obra social es obligatoria.']);
    }

    private function validarFamiliaresCargo()
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                $errors = $validator->messages()->messages();
                foreach ($errors as $i => $value) {
                    $this->dispatch('error_critico', $value[0]);
                    return;
                }
            });
        })->validate([
            'familiares_cargo' => 'required',
            'familiares_cargo.*.nombre' => 'required|regex:/^[A-Za-z\s]+$/',
            'familiares_cargo.*.apellido' => 'required|regex:/^[A-Za-z\s]+$/',
            'familiares_cargo.*.sexo' => 'required',
            'familiares_cargo.*.dni' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/',
            'familiares_cargo.*.fecha_nacimiento' => 'required|date|date_format:d-m-Y',
            'familiares_cargo.*.tipo_relacion' => 'required',
            'familiares_cargo.*.certificado' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ], [
            'familiares_cargo.required' => 'Debe agregar al menos un familiar a cargo.',
            'familiares_cargo.*.nombre.required' => 'El campo del nombre es obligatorio.',
            'familiares_cargo.*.nombre.regex' => 'El campo del nombre solo puede contener letras y espacios.',
            'familiares_cargo.*.apellido.required' => 'El campo del apellido es obligatorio.',
            'familiares_cargo.*.apellido.regex' => 'El campo del apellido solo puede contener letras y espacios.',
            'familiares_cargo.*.sexo.required' => 'El campo del sexo es obigatorio',
            'familiares_cargo.*.dni.required' => 'El campo del DNI es obligatorio.',
            'familiares_cargo.*.dni.regex' => 'El DNI debe ser en formato XXX.XXX.XXX donde las X son digitos. Debe especificar los puntos en las unidades de mil y millón.',
            'familiares_cargo.*.fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'familiares_cargo.*.fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'familiares_cargo.*.fecha_nacimiento.date_format',
            'familiares_cargo.*.tipo_relacion.required' => 'El campo de la relación es obligatorio.',
            'familiares_cargo.*.certificado.required' => 'El certificado es obligatorio.',
        ]);
    }

    private function validarTodo()
    {
        $reglas = [
            // Datos generales
            'nombre' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido' => 'required|regex:/^[A-Za-z\s]+$/',
            's_nombre' => 'regex:/^[A-Za-z\s]+$/',
            'sexo_selected' => 'required',
            'dni' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/|unique:personas,dni',
            'fecha_nacimiento' => 'required|date|date_format:d-m-Y|before_or_equal:' . Carbon::now()->subYears(16)->format('Y-m-d') . '|after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d'),
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
            'altura' => 'numeric|nullable|min:0',
            'departamento' => 'nullable|regex:/^[A-Za-z0-9\s]+$/',
            'estado_civil' => 'required',

            // Obra social
            // 'numero_afiliado' => 'required_if:tiene_obra_social,true|numeric',
            // 'obra_social_selected' => 'required_if:tiene_obra_social,true',

            // Contrato
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            'contactos_emergencia' => 'required',
            'tipo_jornadas_selected' => 'required',
            'tipo_contratos_selected' => 'required',
            'fecha_ingreso' => 'required|date|date_format:d-m-Y',
            'fecha_vencimiento' => 'required_if:not_contrato_indeterminado,true|date|date_format:d-m-Y|after:fecha_ingreso',
            'contrato_trabajo' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'puesto_de_trabajo_selected' => 'required',
            'competencias_selected' => 'required',
            'currirulum_vitae' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',

            // Autorización de padres
            // 'autorizacion_padres' => 'required_if:fecha_nacimiento,' . Carbon::now()->subYears(16)->format('d-m-Y') . '|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',

            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'hora_inicio_receso' => 'after:hora_entrada|before:hora_salida',
            'hora_fin_receso' => 'after:hora_inicio_receso|before:hora_salida',
            'sueldo' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',

        ];

        $mensajes = [

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
            'altura.numeric' => 'La altura debe ser un número.',
            'altura.min' => 'La altura debe ser mayor a 0.',
            'departamento.regex' => 'El departamento solo puede contener letras, números y espacios.',
            'estado_civil.required' => 'El campo del estado civil es obligatorio.',

            // Obra social
            'numero_afiliado.required_if' => 'El número de afiliado es obligatorio si tiene obra social.',
            'numero_afiliado.numeric' => 'El número de afiliado debe ser un número.',
            'obra_social_selected.required_if' => 'La obra social es obligatoria si tiene obra social.',

            'email.required' => 'El campo del email es obligatorio.',
            'email.email' => 'El email debe ser un email válido.',

            'contactos_emergencia.required' => 'Debe agregar al menos un contacto de emergencia.',
            'tipo_jornadas_selected.required' => 'El campo de la jornada es obligatorio.',
            'tipo_contratos_selected.required' => 'El campo del contrato es obligatorio.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',

            'hora_entrada.required' => 'El campo de la hora de entrada es obligatorio.',
            'hora_salida.required' => 'El campo de la hora de salida es obligatorio.',
            'sueldo.required' => 'El campo del sueldo es obligatorio.',
            'sueldo.numeric' => 'El sueldo debe ser un número.',
            'sueldo.min' => 'El sueldo debe ser mayor a 0.',
            'sueldo.regex' => 'El sueldo debe ser un número con dos decimales.',

        ];

        //$this->validate($reglas, $mensajes);

        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                $errors = $validator->messages()->messages();
                foreach ($errors as $i => $value) {
                    $this->dispatch('error_critico', $value[0]);
                    return;
                }
            });
        })->validate($reglas, $mensajes);
    }

    public function contratarEmpleado()
    {
        $this->validarTodo();

        if ($this->sueldo < PuestoTrabajo::find($this->puesto_de_trabajo_selected)->sueldo_base) {
            $this->dispatch('error_critico', 'El sueldo no puede ser menor al sueldo base mínimo del puesto de trabajo.');
            return;
        }

        $hora_entrada = Carbon::createFromFormat('H:i', $this->hora_entrada);
        $hora_salida = Carbon::createFromFormat('H:i', $this->hora_salida);
        $hora_inicio_receso = null;
        $hora_fin_receso = null;
        if ($this->hora_inicio_receso && $this->hora_fin_receso) {
            $hora_inicio_receso = Carbon::createFromFormat('H:i', $this->hora_inicio_receso);
            $hora_fin_receso = Carbon::createFromFormat('H:i', $this->hora_fin_receso);
            $diferencia = $hora_entrada->diffInHours($hora_salida) - $hora_inicio_receso->diffInHours($hora_fin_receso);
        }else{
            $diferencia = $hora_entrada->diffInHours($hora_salida);
        }

        if ($diferencia > 8) {
            $this->dispatch('error_critico', 'La jornada laboral no puede superar las 8 horas.');
            return;
        }

        // 8hs diarias en jornada completa
        $jornada = TipoJornada::find($this->tipo_jornadas_selected);
        if ($jornada->nombre == 'Jornada completa') {
            if ($diferencia < 8) {
                $this->dispatch('error_critico', 'La jornada laboral completa debe ser de 8 horas.');
                return;
            }
        }

        // Jornada reducida inferior a 8hs
        if ($jornada->nombre == 'Jornada reducida') {
            if ($diferencia >= 8) {
                $this->dispatch('error_critico', 'La jornada laboral reducida no puede superar o igualar las 8 horas.');
                return;
            }
        }

        // Jornada nocturna entre 21hs y 6hs con maximo de 7hs
        if ($jornada->nombre == 'Jornada nocturna') {
            if ($hora_entrada->isBefore(Carbon::createFromFormat('H:i', '21:00')) || $hora_salida->isAfter(Carbon::createFromFormat('H:i', '06:00'))) {
                $this->dispatch('error_critico', 'La jornada laboral nocturna debe ser entre las 21hs y las 6hs.');
                return;
            }
            if ($diferencia > 7) {
                $this->dispatch('error_critico', 'La jornada laboral nocturna no puede superar las 7 horas.');
                return;
            }
        }

        // Insalubre no puede superar las 6hs
        if ($jornada->nombre == 'Jornada insalubre') {
            if ($diferencia > 6) {
                $this->dispatch('error_critico', 'La jornada laboral insalubre no puede superar las 6 horas.');
                return;
            }
        }

        if ($jornada->nombre == 'Jornada por turnos rotativos' || $jornada->nombre == 'Jornada discontinua' ||  $jornada->nombre == 'Jornada flexible' || $jornada->nombre == 'Jornada partida') {
            if ($diferencia > 8) {
                $this->dispatch('error_critico', 'La ' . $jornada->nombre . ' no puede superar las 8 horas.');
                return;
            }
        }

        if ($this->tiene_obra_social) {
            $this->validarObraSocial();
        }

        if ($this->tiene_familiares) {
            $this->validarFamiliaresCargo();
        }

        // Comprobar todos los archivos subidos

        if ($this->fecha_nacimiento) {
            $esMenorDeEdad = Carbon::createFromFormat('d-m-Y', $this->fecha_nacimiento)->diffInYears(Carbon::now()) < 18;

            if ($esMenorDeEdad) {
                if ($this->estado_civil) {
                    $estadoCivil = EstadoCivil::find($this->estado_civil);
                    if ($estadoCivil && $estadoCivil->nombre == 'Soltero/a') {
                        if (!$this->autorizacion_padres || $this->autorizacion_padres == '') {
                            $this->dispatch('error_critico', 'Debe cargar una autorización de padres en el apartado "Datos Personales".');
                            return;
                        }
                    }
                } else {
                    if (!$this->autorizacion_padres || $this->autorizacion_padres == '') {
                        $this->dispatch('error_critico', 'Debe cargar una autorización de padres en el apartado "Datos Personales".');
                        return;
                    }
                }
            }
        }


        if (!$this->copia_dni || $this->copia_dni == '') {
            $this->dispatch('error_critico', 'Debe cargar una copia de DNI en el apartado "Datos Personales".');
            return;
        }

        if (!$this->certificado_domicilio || $this->certificado_domicilio == '') {
            $this->dispatch('error_critico', 'Debe cargar un certificado de domicilio en el apartado "Domicilio".');
            return;
        }

        if (!$this->contrato_trabajo || $this->contrato_trabajo == '') {
            $this->dispatch('error_critico', 'Debe cargar un contrato de trabajo en el apartado "Datos del Puesto de Trabajo".');
            return;
        }

        if (!$this->currirulum_vitae || $this->currirulum_vitae == '') {
            $this->dispatch('error_critico', 'Debe cargar un curriculum vitae en el apartado "Competencias Satisfactorias del Empleado".');
            return;
        }

        if (User::find(Auth::user()->id)->hasRole('SYSADMIN|DIRECTOR GENERAL')) {
            $this->withValidator(function (Validator $validator) {
                $validator->after(function ($validator) {
                    $errors = $validator->messages()->messages();
                    foreach ($errors as $i => $value) {
                        $this->dispatch('error_critico', $value[0]);
                        return;
                    }
                });
            })->validate([
                'rol_seleccionado' => 'required',
            ], [
                'rol_seleccionado.required' => 'El campo del rol es obligatorio.',
            ]);
        }
        $documentos_totales = [];
        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $this->email,
                'password' => Hash::make($this->dni),
            ]);

            if (User::find(Auth::user()->id)->hasRole('SYSADMIN|DIRECTOR GENERAL')) {
                // Asignar Rol: Seleccionado
                $user->assignRole(Role::find($this->rol_seleccionado)->name);
            } else {
                // Asignar Rol: EMPLEADO
                $user->assignRole('EMPLEADO');
            }

            $persona = new Persona();
            $persona->nombre = $this->nombre;
            $persona->apellido = $this->apellido;
            $persona->segundo_nombre = $this->s_nombre;
            $persona->fecha_nacimiento = Carbon::parse($this->fecha_nacimiento)->format('d-m-Y');
            $persona->dni = $this->dni;
            $persona->cuil = $this->cuil;
            $persona->calle = $this->calle;
            $persona->altura = $this->altura;
            $persona->departamento = $this->departamento;
            $persona->id_sexo = $this->sexo_selected;
            $persona->id_municipio = $this->municipio_selected;
            $persona->id_estado_civil = $this->estado_civil;
            $persona->id_usuario = $user->id;
            $persona->save();
            $persona->sexo()->associate($this->sexo_selected);
            $persona->municipio()->associate($this->municipio_selected);
            $persona->estadoCivil()->associate($this->estado_civil);
            $persona->usuario()->associate($user->id);

            // Si es menor de edad cargar autorización de padres
            $esMenorDeEdad = Carbon::createFromFormat('d-m-Y', $this->fecha_nacimiento)->diffInYears(Carbon::now()) < 18;

            if ($esMenorDeEdad) {
                $estadoCivil = EstadoCivil::find($this->estado_civil);
                if ($estadoCivil && $estadoCivil->nombre == 'Soltero/a') {
                    $archivo = $this->autorizacion_padres;
                    $nombre = uniqid() . '.' . $archivo->guessExtension();
                    $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/autorizacion', $nombre);
                    $documento_autorizacion = DocumentoCertificado::create([
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'detalle' => $ruta,
                        'id_persona' => $persona->id,
                        'id_tipo_documento' => TipoDocumento::where('nombre', 'Certificado de emancipacion o permiso del tutor')->first()->id,
                    ]);
                    $documentos_totales[] = $documento_autorizacion;
                }
            }


            // Cargar copia de DNI
            $archivo = $this->copia_dni;
            $nombre = uniqid() . '.' . $archivo->guessExtension();
            $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/dni', $nombre);
            $documento_dni = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'id_persona' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Copia de DNI')->first()->id,
            ]);

            $documentos_totales[] = $documento_dni;

            // Cargar certificado de residencia
            $archivo = $this->certificado_domicilio;
            $nombre = uniqid() . '.' . $archivo->guessExtension();
            $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/residencia', $nombre);
            $documento_domicilio = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'id_persona' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Certificado de residencia')->first()->id,
            ]);

            $documentos_totales[] = $documento_domicilio;

            // Agregar obra social
            if ($this->tiene_obra_social) {
                $persona->obrasSociales()->attach(
                    $this->obra_social_selected,
                    ['numero_afiliado' => $this->numero_afiliado]
                );
            }

            //dd($persona->obrasSociales());

            // Agregar familiares
            if ($this->tiene_familiares) {
                foreach ($this->familiares_cargo as $familiar_data) {
                    $familiar = new Familiar();
                    $familiar->nombre = $familiar_data['nombre'];
                    $familiar->apellido = $familiar_data['apellido'];
                    $familiar->dni = $familiar_data['dni'];
                    $familiar->fecha_nacimiento = Carbon::parse($familiar_data['fecha_nacimiento'])->format('d-m-Y');
                    $familiar->id_sexo = Sexo::where('nombre', $familiar_data['sexo'])->first()->id;
                    $familiar->sexo()->associate(Sexo::where('nombre', $familiar_data['sexo'])->first()->id);
                    $familiar->save();

                    $persona->familiares()->attach($familiar->id, ['id_tipo_relacion' => TipoRelacion::where('nombre', $familiar_data['tipo_relacion'])->first()->id, 'detalle' => $familiar_data['tipo_relacion'], 'estado' => true]);
                    // Cargar certificado

                    $archivo = $familiar_data['certificado'];
                    $nombre = uniqid() . '.' . $archivo->guessExtension();
                    $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/familiares/' . $familiar_data['dni'], $nombre);
                    $documento_familiar = DocumentoCertificado::create([
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'detalle' => $ruta,
                        'id_persona' => $persona->id,
                        'id_tipo_documento' => TipoDocumento::where('nombre', 'Certificado de familiar a cargo')->first()->id,
                    ]);

                    $documentos_totales[] = $documento_familiar;
                }
            }

            // Agregar contactos de emergencia VERIFICAR
            foreach ($this->contactos_emergencia as $contacto_data) {
                $contacto = new ContactoEmergencia();
                $contacto->nombre = $contacto_data['nombre'];
                $contacto->apellido = $contacto_data['apellido'];
                $contacto->telefono = $contacto_data['telefono'];
                $contacto->email = $contacto_data['email'];
                $contacto->tipoRelacion()->associate(RelacionFamilia::where('nombre', $contacto_data['tipo_relacion'])->first()->id);
                $contacto->id_persona = $persona->id;
                $persona->contactosEmergencia()->save($contacto);
            }

            // Crear empleado
            $legajo = sprintf(
                "%s-%s-%04d",
                strtoupper(substr($persona->apellido, 0, 3)), // Primeras 3 letras del apellido
                substr($persona->dni, -4),                  // Últimos 4 dígitos del DNI
                rand(1000, 9999)                            // Número aleatorio para mayor unicidad
            );

            $empleado = new Empleado();
            $empleado->legajo = $legajo;
            $empleado->estado_laboral = 'Activo';
            $empleado->persona()->associate($persona->id);
            $empleado->puesto()->associate($this->puesto_de_trabajo_selected);
            $empleado->save();

            // Agregar contrato de trabajo
            $archivo = $this->contrato_trabajo;
            $nombre = uniqid() . '.' . $archivo->guessExtension();
            $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/contrato', $nombre);
            $contrato_trabajo = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'id_persona' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Contrato de trabajo')->first()->id,
            ]);

            $documentos_totales[] = $contrato_trabajo;

            // Crear contrato
            $contrato = new Contrato();
            $contrato->nombre_archivo = $archivo->getClientOriginalName();
            $contrato->fecha_ingreso = Carbon::createFromFormat('d-m-Y', $this->fecha_ingreso);
            $contrato->hora_inicio_receso = $hora_inicio_receso;
            $contrato->hora_fin_receso = $hora_fin_receso;
            $contrato->hora_entrada = $this->hora_entrada;
            $contrato->hora_salida = $this->hora_salida;
            $contrato->sueldo = $this->sueldo;
            $contrato->estado = true;
            if ($this->not_contrato_indeterminado) {
                $contrato->fecha_vencimiento = Carbon::parse($this->fecha_vencimiento)->format('d-m-Y');
            }
            $contrato->fecha_vencimiento = null;
            $contrato->tipoJornada()->associate($this->tipo_jornadas_selected);
            $contrato->tipoContrato()->associate($this->tipo_contratos_selected);
            $contrato->empleado()->associate($empleado->id);
            $contrato->save();

            // Asociar contrato a empleado
            $empleado->contrato()->save($contrato);

            // Agregar competencias
            $empleado->competencias()->attach($this->competencias_selected);

            // Cargar curriculum vitae
            $archivo = $this->currirulum_vitae;
            $nombre = uniqid() . '.' . $archivo->guessExtension();
            $ruta = $archivo->storeAs('archivos/' . $persona->dni . '/cv', $nombre);
            $contrato_cv = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'id_persona' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Curriculum vitae')->first()->id,
            ]);

            $documentos_totales[] = $contrato_cv;

            foreach ($documentos_totales as $documento) {
                $persona->documentosCertificados()->save($documento);
            }

            // Enviar mail con la contraseña
            $empresa = Empresa::where('nombre', 'Morfeo S.A.')->first();
            Mail::to($this->email)->send(new ContratoEmpleado($persona, $empleado, $user, $empresa));


            // Crear evento publico de cumpleaños
            $evento = new Evento();
            $evento->titulo = 'Feliz Cumpleaños ' . $persona->nombre . ' ' . $persona->apellido .'!';
            $evento->fecha_inicio = Carbon::parse($persona->fecha_nacimiento)->format('d-m-Y');
            $evento->fecha_fin = Carbon::parse($persona->fecha_nacimiento)->format('d-m-Y');
            $evento->color = '#8a0683';
            $evento->url = null;
            $evento->grupo = 999;
            $evento->save();
            $evento->usuarios()->attach($user->id);
            
            // Guardar cambios
            DB::commit();

            $this->dispatch('success-contrato', 'Empleado contratado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Eliminar todos los archivos subidos
            if (!empty($documentos_totales)) {
                Storage::deleteDirectory('archivos/' . $persona->dni);
                // limpiar livewire-temp
                // Storage::deleteDirectory('livewire-tmp');
            }

            $this->dispatch('error-contrato', 'Error al contratar al empleado. Mensaje: ' . $e->getMessage());
        }
    }

    // public function eliminarArchivo($originalName)
    // {
    //     $this->archivos = array_filter($this->archivos, function ($archivo) use ($originalName) {
    //         return $archivo->getClientOriginalName() != $originalName;
    //     });
    //     $this->validateOnly('archivos.*');
    // }

    private function validarFamiliar()
    {
        $this->validate([
            'sexo_selected_familiar' => 'required',
            'tipo_relacion_familiar_selected' => 'required',
            'dni_familiar' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/',
            'nombre_familiar' => 'required|regex:/^[A-Za-z\s]+$/',
            'apellido_familiar' => 'required|regex:/^[A-Za-z\s]+$/',
            'fecha_nacimiento_familiar' => 'required|date|date_format:d-m-Y||after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d'),
        ], [
            'sexo_selected_familiar.required' => 'El campo del sexo es obigatorio',
            'tipo_relacion_familiar_selected.required' => 'El campo de la relación es obigatorio',
            'dni_familiar.required' => 'El campo del DNI es obligatorio.',
            'dni_familiar.regex' => 'El DNI debe ser en formato XXX.XXX.XXX donde las X son digitos. Debe especificar los puntos en las unidades de mil y millón.',
            'nombre_familiar.required' => 'El campo del nombre es obligatorio.',
            'nombre_familiar.regex' => 'El campo del nombre solo puede contener letras y espacios.',
            'apellido_familiar.required' => 'El campo del apellido es obligatorio.',
            'apellido_familiar.regex' => 'El campo del apellido solo puede contener letras y espacios.',
            'fecha_nacimiento_familiar.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento_familiar.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento_familiar.after_or_equal' => 'El valor maximo para este campo es 120 años',
            'fecha_nacimiento_familiar.date_format' => 'La fecha debe ser en formato día-mes-año (dd-mm-YYYY)',
        ]);
    }

    public function agregarFamiliar()
    {
        $this->validarFamiliar();

        // validar que exista un certificado
        if ($this->certificado_familiar == '') {
            $this->dispatch('error_critico', 'Debe cargar un certificado.');
            return;
        }

        $this->familiares_cargo[] = [
            'nombre' => $this->nombre_familiar,
            'apellido' => $this->apellido_familiar,
            'sexo' => Sexo::find($this->sexo_selected_familiar)->nombre,
            'dni' => $this->dni_familiar,
            'fecha_nacimiento' => $this->fecha_nacimiento_familiar,
            'tipo_relacion' => TipoRelacion::find($this->tipo_relacion_familiar_selected)->nombre,
            'certificado' => $this->certificado_familiar,
        ];

        $this->nombre_familiar = '';
        $this->apellido_familiar = '';
        $this->sexo_selected_familiar = '';
        $this->dni_familiar = '';
        $this->fecha_nacimiento_familiar = '';
        $this->tipo_relacion_familiar_selected = '';
        $this->certificado_familiar = '';

        $this->dispatch('limpiar_familiar');
    }

    public function eliminarFamiliar($dni)
    {
        $this->familiares_cargo = array_filter($this->familiares_cargo, function ($familiar) use ($dni) {
            return $familiar['dni'] != $dni;
        });
    }

    public function editarFamiliar($dni)
    {
        $familiar = array_filter($this->familiares_cargo, function ($familiar) use ($dni) {
            return $familiar['dni'] == $dni;
        });

        $this->nombre_familiar = $familiar[0]['nombre'];
        $this->apellido_familiar = $familiar[0]['apellido'];
        $this->sexo_selected_familiar = Sexo::where('nombre', $familiar[0]['sexo'])->first()->id;
        $this->dni_familiar = $familiar[0]['dni'];
        $this->fecha_nacimiento_familiar = $familiar[0]['fecha_nacimiento'];
        $this->tipo_relacion_familiar_selected = TipoRelacion::where('nombre', $familiar[0]['tipo_relacion'])->first()->id;
        $this->certificado_familiar = $familiar[0]['certificado'];

        $this->validateOnly('sexo_selected_familiar');
        $this->validateOnly('tipo_relacion_familiar_selected');
        $this->validateOnly('dni_familiar');
        $this->validateOnly('nombre_familiar');
        $this->validateOnly('apellido_familiar');
        $this->validateOnly('fecha_nacimiento_familiar');

        $this->eliminarFamiliar($dni);
        $this->dispatch('editar_familiar', $this->sexo_selected_familiar, $this->fecha_nacimiento_familiar, $this->tipo_relacion_familiar_selected);
    }

    private function validarContactosEmergencia()
    {
        $this->validate([
            'nombre_emergencia' => 'required|regex:/^[A-Za-z\s]+$/',
            'telefono_emergencia' => 'required|regex:/^[\d]{4}-[\d]{6}$/',
            'email_emergencia' => 'required|email'
        ], [
            'nombre_emergencia.required' => 'El campo del nombre es obligatorio.',
            'nombre_emergencia.regex' => 'El campo del nombre solo puede contener letras y espacios.',
            'telefono_emergencia.required' => 'El campo del teléfono es obligatorio.',
            'telefono_emergencia.regex' => 'El teléfono debe ser en formato XXXX-XXXXXX donde las X son digitos. Debe especificar los guiones en las unidades de mil y millón.',
            'email_emergencia.required' => 'El campo del email es obligatorio.',
            'email_emergencia.email' => 'El email debe ser un email válido.'
        ]);
    }

    public function agregarContactoEmergencia()
    {;

        $this->validarContactosEmergencia();

        $this->contactos_emergencia[] = [
            'nombre' => $this->nombre_emergencia,
            'apellido' => $this->apellido_emergencia,
            'telefono' => $this->telefono_emergencia,
            'email' => $this->email_emergencia,
            'tipo_relacion' => RelacionFamilia::find($this->tipo_relacion_familiar_selected_dos)->nombre,
        ];

        $this->nombre_emergencia = '';
        $this->apellido_emergencia = '';
        $this->telefono_emergencia = '';
        $this->email_emergencia = '';
        $this->tipo_relacion_familiar_selected_dos = '';
    }

    public function eliminarContactoEmergencia($telefono)
    {
        $this->contactos_emergencia = array_filter($this->contactos_emergencia, function ($contacto) use ($telefono) {
            return $contacto['telefono'] != $telefono;
        });
    }

    public function editarContactoEmergencia($telefono)
    {
        $contacto = array_filter($this->contactos_emergencia, function ($contacto) use ($telefono) {
            return $contacto['telefono'] == $telefono;
        });

        $this->nombre_emergencia = $contacto[0]['nombre'];
        $this->apellido_emergencia = $contacto[0]['apellido'];
        $this->telefono_emergencia = $contacto[0]['telefono'];
        $this->email_emergencia = $contacto[0]['email'];
        $this->tipo_relacion_familiar_selected_dos = RelacionFamilia::where('nombre', $contacto[0]['tipo_relacion'])->first()->id;

        $this->eliminarContactoEmergencia($telefono);

        $this->validarContactosEmergencia();
    }

    public function eliminarCertificadoFamiliar()
    {
        $this->certificado_familiar = '';
    }

    public function eliminarCertificadoDomicilio()
    {
        $this->certificado_domicilio = '';
    }

    public function eliminarCopiaDni()
    {
        $this->copia_dni = '';
    }

    public function eliminarAutorizacionPadres()
    {
        $this->autorizacion_padres = '';
    }

    public function eliminarContratoTrabajo()
    {
        $this->contrato_trabajo = '';
    }

    public function eliminarCurriculumVitae()
    {
        $this->currirulum_vitae = '';
    }

    public function agregarCompetencia($id, $estado)
    {
        // Si estado es verdadero agregar competencia a la lista de competencias seleccionadas
        if ($estado) {
            array_push($this->competencias_selected, $id);
        } else {
            // Si estado es falso eliminar competencia de la lista de competencias seleccionadas
            array_splice($this->competencias_selected, array_search($id, $this->competencias_selected), 1);
        }
    }

    public function getCompetencias()
    {
        dd($this->competencias_selected);
    }
}
