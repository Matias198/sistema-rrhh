<?php

namespace App\Livewire\Gestion\Empleados;
 
use App\Models\CapacidadesTrabajo;
use App\Models\Contrato;
use App\Models\DocumentoCertificado;
use App\Models\EstadoCivil;
use App\Models\Familiar;
use App\Models\ObraSocial;
use App\Models\Provincia;
use App\Models\Sexo;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\PuestoTrabajo;
use App\Models\TipoContrato;
use App\Models\TipoDocumento;
use App\Models\TipoJornada;
use App\Models\TipoRelacion;
use App\Models\User;
use App\Rules\Validator\CuilValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public $tiene_familiares = false;
    public $familiares_cargo = [];
    public $nombre_familiar;
    public $apellido_familiar;
    public $sexo_selected_familiar;
    public $dni_familiar;
    public $fecha_nacimiento_familiar;
    public $tipo_relacion_familiar_selected;
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

    protected function rules()
    {
        return [
            // primer caracter en mayuscula, solo letras y espacios
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
            'altura' => 'required|numeric',
            'estado_civil' => 'required',
            // 'archivos.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            // 'sexo_selected_familiar' => 'required',
            // 'tipo_relacion_familiar_selected' => 'required',
            // 'dni_familiar' => 'required|regex:/^[\d]{1,3}\.?[\d]{3,3}\.?[\d]{3,3}$/',
            // 'nombre_familiar' => 'required|regex:/^[A-Za-z\s]+$/',
            // 'apellido_familiar' => 'required|regex:/^[A-Za-z\s]+$/',
            // 'fecha_nacimiento_familiar' => 'required|date|date_format:d-m-Y||after_or_equal:' . Carbon::now()->subYears(120)->format('Y-m-d'),
            'numero_afiliado' => 'required_if:tiene_obra_social,true|numeric',
            'obra_social_selected' => 'required_if:tiene_obra_social,true',
            'familiares_cargo' => 'required_if:tiene_familiares,true',
            'email' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            // 'nombre_emergencia' => 'required|regex:/^[A-Za-z\s]+$/',
            // 'telefono_emergencia' => 'required|regex:/^[\d]{4}-[\d]{6}$/',
            // 'email_emergencia' => 'required|email',
            'contactos_emergencia' => 'required',
            'tipo_jornadas_selected' => 'required',
            'tipo_contratos_selected' => 'required',
            'fecha_ingreso' => 'required|date|date_format:d-m-Y',
            'fecha_vencimiento' => 'required|date|date_format:d-m-Y|after:fecha_ingreso',
            'contrato_trabajo' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'puesto_de_trabajo_selected' => 'required',
            'competencias_selected' => 'required',
            'currirulum_vitae' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            

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
        'archivos.*.required' => 'El archivo es obligatorio.',
        'archivos.*.file' => 'El archivo debe ser un archivo.',
        'archivos.*.mimes' => 'El archivo debe ser un PDF, DOC, DOCX, JPG, JPEG o PNG.',
        'archivos.*.max' => 'El archivo no debe superar los 2MB.',
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
        'numero_afiliado.required_if' => 'El número de afiliado es obligatorio si tiene obra social.',
        'numero_afiliado.numeric' => 'El número de afiliado debe ser un número.',
        'obra_social_selected.required_if' => 'La obra social es obligatoria si tiene obra social.',
        'familiares_cargo.required_if' => 'Debe agregar al menos un familiar.',
        'email.required' => 'El campo del email es obligatorio.',
        'email.email' => 'El email debe ser un email válido.',
        'nombre_emergencia.required' => 'El campo del nombre es obligatorio.',
        'nombre_emergencia.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'telefono_emergencia.required' => 'El campo del teléfono es obligatorio.',
        'telefono_emergencia.regex' => 'El teléfono debe ser en formato XXXX-XXXXXX donde las X son digitos. Debe especificar los guiones en las unidades de mil y millón.',
        'email_emergencia.required' => 'El campo del email es obligatorio.',
        'email_emergencia.email' => 'El email debe ser un email válido.',
        'contactos_emergencia.required' => 'Debe agregar al menos un contacto de emergencia.',
        'tipo_jornadas_selected.required' => 'El campo de la jornada es obligatorio.',
        'tipo_contratos_selected.required' => 'El campo del contrato es obligatorio.',
        'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
    ];

    // public function updating($propertyName)
    // {
    //     if ($propertyName == 'archivos') {
    //         $this->aux_archivos = $this->archivos;
    //     }
    // }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        // if ($propertyName == 'archivos') {
        //     try {
        //         $elementos = $this->archivos;
        //         $this->archivos = $this->aux_archivos;
        //         //$this->aux_archivos = []; 

        //         foreach ($elementos as $elemento) {
        //             // valida si el elemento es pdf, doc, docx, jpg, jpeg, png
        //             if ($elemento->guessExtension() == 'pdf' || $elemento->guessExtension() == 'doc' || $elemento->guessExtension() == 'docx' || $elemento->guessExtension() == 'jpg' || $elemento->guessExtension() == 'jpeg' || $elemento->guessExtension() == 'png') {
        //                 //dd($elemento->getClientOriginalName());
        //                 $encontrado = false;
        //                 for ($i = 0; $i < count($this->archivos); $i++) {
        //                     if ($elemento->getClientOriginalName() == $this->archivos[$i]->getClientOriginalName()) {
        //                         $this->dispatch('errorArchivo', 'El archivo ' . $elemento->getClientOriginalName() . ' ya se encuentra en la lista.');
        //                         $encontrado = true;
        //                     }
        //                 }
        //                 if (!$encontrado) {
        //                     $this->archivos[] = $elemento;
        //                 }
        //             } else {
        //                 $this->dispatch('errorArchivo', 'El archivo debe ser un PDF, DOC, DOCX, JPG, JPEG o PNG.');
        //             }
        //         }
        //         // $this->archivos = $this->aux_archivos;
        //         $this->dispatch('actualizar');
        //     } catch (\Exception $e) {
        //         $this->archivos = [];
        //         $this->dispatch('errorArchivo', 'Error al cargar el archivo.');
        //     }
        // }

        if ($propertyName == 'puesto_de_trabajo_selected') {
            $this->competencias = PuestoTrabajo::find($this->puesto_de_trabajo_selected)->capacidadesTrabajos()->get();
        }

        if ($propertyName == 'tiene_familiares' || $propertyName == 'tiene_obra_social') {
            $this->dispatch('actualizar');
        }
    }
    public function mount()
    {
        $this->paises = Pais::all()->sortBy('nombre');
        $this->provincias = collect();
        $this->municipios = collect();
        $this->sexos = Sexo::all()->sortBy('nombre');
        $this->relaciones_familiares = TipoRelacion::all()->sortBy('nombre');
        $this->obras_sociales = ObraSocial::all()->sortBy('nombre');
        $this->estados_civiles = EstadoCivil::all()->sortBy('nombre');
        $this->tipo_jornadas = TipoJornada::all()->sortBy('nombre');
        $this->tipo_contratos = TipoContrato::all()->sortBy('nombre');
        $this->puestos_de_trabajo = PuestoTrabajo::all()->sortBy('nombre');
        $this->tipos_documentos = TipoDocumento::all()->sortBy('nombre');
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

    public function contratarEmpleado()
    {
        //$this->validate();
        try {
            DB::beginTransaction();
            $user = User::create([
                'email' => $this->email,
                'password' => Hash::make($this->dni),
            ]);
            // Asignar Rol: EMPLEADO
            $user->assignRole('EMPLEADO');
            
            $persona = Persona::create([
                'nombre' => $this->nombre,
                'apellido' => $this->apellido,
                'segundo_nombre' => $this->s_nombre,
                'id_sexo' => $this->sexo_selected,
                'fecha_nacimiento' => Carbon::createFromFormat('d-m-Y', $this->fecha_nacimiento),
                'dni' => $this->dni,
                'cuil' => $this->cuil, 
                'id_municipio' => $this->municipio_selected,
                'calle' => $this->calle,
                'altura' => $this->altura,
                'id_estado_civil' => $this->estado_civil,
                'id_usuario' => $user->id,
            ]);

            dd(vars: $persona);
            // Si es menor de edad cargar autorización de padres
            if (Carbon::createFromFormat('d-m-Y', $this->fecha_nacimiento)->diffInYears(Carbon::now()) < 18) {
                $archivo = $this->autorizacion_padres;
                $uuid = uniqid($archivo->getClientOriginalName());
                $nombre = $persona->dni . '_autorizacion_' . $uuid;
                $ruta = $archivo->storeAs('public/' . $persona->dni . '/autorizacion/' , $nombre);
                $documento = DocumentoCertificado::create([
                    'nombre_archivo' => $archivo->getClientOriginalName(),
                    'detalle' => $ruta,
                    'persona_id' => $persona->id,
                    'id_tipo_documento' => TipoDocumento::where('nombre', 'Autorización de padres')->first()->id,
                ]);
                $persona->documentosCertificados()->attach($documento->id);
            }

            // Cargar copia de DNI
            $archivo = $this->copia_dni;
            $uuid = uniqid($archivo->getClientOriginalName());
            $nombre = $persona->dni . '_copia_dni_' . $uuid;
            $ruta = $archivo->storeAs('public/' . $persona->dni . '/dni/' , $nombre);
            $documento = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'persona_id' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Copia de DNI')->first()->id,
            ]);
            $persona->documentosCertificados()->attach($documento->id);

            // Agregar obra social
            if ($this->tiene_obra_social) {
                $persona->obrasSociales()->attach($this->obra_social_selected, ['numero_afiliado' => $this->numero_afiliado]);
            } 

            // Agregar familiares
            if ($this->tiene_familiares) {
                foreach ($this->familiares_cargo as $familiar) {
                    $familiar = Familiar::create([
                        'nombre' => $familiar['nombre'],
                        'apellido' => $familiar['apellido'],
                        'sexo_id' => $familiar['sexo'],
                        'dni' => $familiar['dni'],
                        'fecha_nacimiento' => Carbon::createFromFormat('d-m-Y', $familiar['fecha_nacimiento']),
                    ]); 
                    $persona->familiares()->attach($familiar->id, ['id_tipo_relacion' => TipoRelacion::where('nombre', $familiar['tipo_relacion'])->first()->id, 'detalle' => $familiar['tipo_relacion'], 'estado' => true]);
                    // Cargar certificado
                    $archivo = $familiar['certificado'];

                    // generar un UUID
                    $uuid = uniqid($archivo->getClientOriginalName());
                    $nombre = $familiar['dni'] . '_certificado_' . $uuid;
                    $ruta = $archivo->storeAs('public/' . $persona->dni . '/familiares/' , $nombre); 
                    $documento = DocumentoCertificado::create([
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'detalle' => $ruta,
                        'persona_id' => $persona->id,
                        'id_tipo_documento' => TipoDocumento::where('nombre', 'Certificado de familiar a cargo')->first()->id,
                    ]);
                    $persona->documentosCertificados()->attach($documento->id);
                }
            }

            // Agregar contactos de emergencia
            foreach ($this->contactos_emergencia as $contacto) {
                $persona->contactosEmergencia()->create([
                    'nombre' => $contacto['nombre'],
                    'telefono' => $contacto['telefono'],
                    'email' => $contacto['email'],
                    'id_persona' => $persona->id,
                ]);
            }

            // Crear empleado
            $legajo = uniqid($persona->dni);
            $persona->empleado()->create([
                'legajo' => $legajo,
                'fecha_ingreso' => Carbon::createFromFormat('d-m-Y', $this->fecha_ingreso),
                'estado_laboral' => 'Activo',
                'id_persona' => $persona->id,
                'id_puesto_trabajo' => $this->puesto_de_trabajo_selected,
            ]);
            
            // Agregar contrato de trabajo
            $archivo = $this->contrato_trabajo;
            $uuid = uniqid($archivo->getClientOriginalName());
            $nombre = $persona->dni . '_contrato_' . $uuid;
            $ruta = $archivo->storeAs('public/'. $persona->dni .'/contrato/' , $nombre);
            $documento = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'persona_id' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Contrato de trabajo')->first()->id,
            ]);
            $persona->documentosCertificados()->attach($documento->id);

            // Crear contrato
            $contrato = Contrato::create([
                'nombre_archivo' => $documento->nombre_archivo,
                'fecha_vencimiento' => Carbon::createFromFormat('d-m-Y', $this->fecha_vencimiento),
                'id_tipo_jornada' => $this->tipo_jornadas_selected,
                'id_tipo_contrato' => $this->tipo_contratos_selected,
                'id_empleado' => $persona->empleado->id,
            ]);

            // Asociar contrato a empleado
            $persona->empleado->contrato()->associate($contrato);

            // Agregar competencias
            foreach ($this->competencias_selected as $competencia) {
                $persona->capacidadesTrabajos()->attach($competencia);
            }

            // Cargar curriculum vitae
            $archivo = $this->currirulum_vitae;
            $uuid = uniqid($archivo->getClientOriginalName());
            $nombre = $persona->dni . '_curriculum_' . $uuid;
            $ruta = $archivo->storeAs('public/' . $persona->dni . '/cv/' , $nombre);
            $documento = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'persona_id' => $persona->id,
                'id_tipo_documento' => TipoDocumento::where('nombre', 'Curriculum vitae')->first()->id,
            ]);
            $persona->documentosCertificados()->attach($documento->id);
            
            dd($persona, $user);

            // Enviar mail con la contraseña

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            $this->dispatch('error', 'Error al contratar al empleado. Mensaje: ' . $e->getMessage());
        }  
    }

    // public function eliminarArchivo($originalName)
    // {
    //     $this->archivos = array_filter($this->archivos, function ($archivo) use ($originalName) {
    //         return $archivo->getClientOriginalName() != $originalName;
    //     });
    //     $this->validateOnly('archivos.*');
    // }

    public function agregarFamiliar()
    {
        $this->validateOnly('sexo_selected_familiar');
        $this->validateOnly('tipo_relacion_familiar_selected');
        $this->validateOnly('dni_familiar');
        $this->validateOnly('nombre_familiar');
        $this->validateOnly('apellido_familiar');
        $this->validateOnly('fecha_nacimiento_familiar');

        // validar que exista un certificado
        if ($this->certificado_familiar == '') {
            $this->dispatch('errorArchivo', 'Debe cargar un certificado.');
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

    public function agregarContactoEmergencia()
    {
        $this->validateOnly('nombre_emergencia');
        $this->validateOnly('telefono_emergencia');
        $this->validateOnly('email_emergencia');

        $this->contactos_emergencia[] = [
            'nombre' => $this->nombre_emergencia,
            'telefono' => $this->telefono_emergencia,
            'email' => $this->email_emergencia,
        ];

        $this->nombre_emergencia = '';
        $this->telefono_emergencia = '';
        $this->email_emergencia = '';
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
        $this->telefono_emergencia = $contacto[0]['telefono'];
        $this->email_emergencia = $contacto[0]['email'];

        $this->validateOnly('nombre_emergencia');
        $this->validateOnly('telefono_emergencia');
        $this->validateOnly('email_emergencia');

        $this->eliminarContactoEmergencia($telefono);
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
