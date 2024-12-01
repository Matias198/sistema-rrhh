<?php

namespace Database\Seeders;

use App\Models\CapacidadesTrabajo;
use App\Models\DepartamentoTrabajo;
use App\Models\Empresa;
use App\Models\EstadoCivil;
use App\Models\ObraSocial;
use App\Models\TipoCapacidad;
use App\Models\User;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\PuestoTrabajo;
use App\Models\RelacionFamilia;
use App\Models\Sexo;
use App\Models\TareaTrabajo;
use App\Models\TipoContrato;
use App\Models\TipoDocumento;
use App\Models\TipoJornada;
use App\Models\TipoRelacion;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public $user_sysadmin;
    public $user_director;
    public $user_jefe;
    function crearUsuarios()
    {
        $this->user_sysadmin = User::create([
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        $this->user_director = User::create([
            'email' => 'director@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        $this->user_jefe = User::create([
            'email' => 'rrhh@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }

    function crearRolesPermisos()
    {
        //$user = User::find(1);

        $role1 = Role::create(['name' => 'SYSADMIN']); // system administrator
        $role2 = Role::create(['name' => 'DIRECTOR GENERAL']); // gerente
        $role3 = Role::create(['name' => 'JEFE DE AREA']); // rrhh (realiza contrataciones)
        $role4 = Role::create(['name' => 'EMPLEADO']); // empleado

        $permission1 = Permission::create(['name' => 'gestionar_empleados']);
        $permission2 = Permission::create(['name' => 'gestionar_eventos']);
        $permission3 = Permission::create(['name' => 'gestionar_roles_permisos']);
        $permission4 = Permission::create(['name' => 'gestionar_puesto_trabajos']);
        $permission5 = Permission::create(['name' => 'gestionar_departamentos']);
        $permission6 = Permission::create(['name' => 'gestionar_auditorias']);
        $permission7 = Permission::create(['name' => 'gestionar_personas']);
        $permission8 = Permission::create(['name' => 'gestionar_gerentes']);
        $permission9 = Permission::create(['name' => 'ver_perfil']);

        // Contratar empleados, listar empleados, gestionar puestos de trabajo, gestionar departamentos
        // gestionar auditorias
        $role1->givePermissionTo([
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $permission5,
            $permission6,
            $permission7,
            $permission8,
        ]);

        // Contratar empleados, listar empleados, gestionar puestos de trabajo, gestionar departamentos
        $role2->givePermissionTo([
            $permission1,
            $permission2,
            $permission4,
            $permission5,
            $permission7,
            $permission8,
        ]);

        // Contratar empleados, listar empleados, gestionar puestos de trabajo
        $role3->givePermissionTo([
            $permission1,
            $permission2,
        ]);

        $role4->givePermissionTo([
            $permission2,
            $permission9,
        ]);

        $this->user_sysadmin->assignRole($role1);
        $this->user_sysadmin->save();

        $this->user_director->assignRole($role2);
        $this->user_director->save();

        $this->user_jefe->assignRole($role3);
        $this->user_jefe->save();
    }

    function crearSexos()
    {
        $sexos = ['Masculino', 'Femenino', 'Otro'];
        foreach ($sexos as $sexo) {
            Sexo::create([
                'nombre' => $sexo,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
    function crearEstadosCiviles()
    {
        $estadosCiviles = ['Soltero/a', 'Casado/a', 'Divorciado/a', 'Viudo/a'];
        foreach ($estadosCiviles as $estadoCivil) {
            EstadoCivil::create([
                'nombre' => $estadoCivil,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    function crearUbicaciones()
    {
        /*   CRACION DE UBICACION   */

        // Crear pais argentina
        $pais = Pais::create([
            'codigo' => 'AR',
            'nombre' => 'Argentina',
        ]);

        // Cargar desde csv desde storage csv las provincias
        // "id","codigo","nombre","id_pais","created_at","updated_at"
        $csv = file_get_contents(storage_path('./csv/provincias.csv'));
        $csv = explode("\n", $csv);

        foreach ($csv as $provincia) {
            $provincia = explode(',', $provincia);
            //dd($provincia);
            $pais->provincias()->create([
                'codigo' => str_replace('"', '', $provincia[1]),
                'nombre' => str_replace('"', '', $provincia[2]),
                'id_pais' => intval($provincia[3]),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        // Cargar desde csv desde storage csv los municipios 
        // "id","codigo","nombre","id_provincia","created_at","updated_at"
        $csv = file_get_contents(storage_path('./csv/municipios.csv'));
        $csv = explode("\n", $csv);

        foreach ($csv as $municipio) {
            $municipio = explode(',', $municipio);
            $provincias = Pais::find(1)->provincias()->get();
            foreach ($provincias as $provincia) {
                $municipio[3] = str_replace('"', '', $municipio[3]);
                if ($provincia->id == intval($municipio[3])) {
                    $provincia->municipios()->create([
                        //"id","codigo","nombre","id_provincia","created_at","updated_at" 
                        // Quitar comillas en codigo y nombre
                        'codigo' => str_replace('"', '', $municipio[1]),
                        'nombre' => str_replace('"', '', $municipio[2]),
                        'id_provincia' => $municipio[3],
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    ]);
                    break;
                }
            }
        }

        // Para hacerlo en formato de consulta
        // $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        // $respuesta = $guzzleClient->request('GET', 'https://apis.datos.gob.ar/georef/api/provincias');
        // $provincias = json_decode($respuesta->getBody()->getContents(), true);
        // foreach ($provincias['provincias'] as $provincia) {
        //     $pais->provincias()->create([
        //         'codigo' => $provincia['id'],
        //         'nombre' => $provincia['nombre'],
        //     ]);
        // }

        // foreach ($pais->provincias as $provincia) {
        //     $respuesta = $guzzleClient->request('GET', 'https://apis.datos.gob.ar/georef/api/municipios?provincia=' . $provincia->codigo . "&max=5000");
        //     $municipios = json_decode($respuesta->getBody()->getContents(), true);
        //     foreach ($municipios['municipios'] as $municipio) {
        //         $provincia->municipios()->create([
        //             'codigo' => $municipio['id'],
        //             'nombre' => $municipio['nombre'],
        //         ]);
        //     }
        // }
    }

    function crearPersonas()
    {
        Persona::create([
            'nombre' => 'Juan',
            'segundo_nombre' => 'Carlos',
            'apellido' => 'Pérez',
            'dni' => '12345678',
            'cuil' => '20123456789',
            'fecha_nacimiento' => '01/01/1999',
            'calle' => 'Calle Falsa',
            'altura' => '123',
            'departamento' => '1A',
            'id_sexo' => 1,
            'id_estado_civil' => 1,
            'id_municipio' => 1365,
            'id_usuario' => 1,
        ])->usuario()->associate($this->user_director)->save();

        Persona::create([
            'nombre' => 'María',
            'segundo_nombre' => 'Elena',
            'apellido' => 'Gómez',
            'dni' => '87654321',
            'cuil' => '27123456789',
            'fecha_nacimiento' => '01/01/1999',
            'calle' => 'Calle Falsa',
            'altura' => '123',
            'departamento' => '1A',
            'id_sexo' => 2,
            'id_estado_civil' => 1,
            'id_municipio' => 1365,
            'id_usuario' => 2,
        ])->usuario()->associate($this->user_jefe)->save();
    }

    // crear tipos de capacidad
    function crearTiposCapacidades()
    {
        $tipos_capacidades = ['Requisitos intelectuales', 'Requisitos físicos', ' Responsabilidades adquiridas', 'Condiciones de trabajo'];
        foreach ($tipos_capacidades as $tipos) {
            TipoCapacidad::create([
                'nombre' => $tipos,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    // Crear departamentos
    function crearDepartamentos()
    {
        $departamentos = [
            ['nombre' => 'ADMINISTRACION Y FINANZAS', 'descripcion' => 'Departamento de administración y finanzas'],
            ['nombre' => 'VENTAS', 'descripcion' => 'Departamento de ventas'],
            ['nombre' => 'LOGISTICA', 'descripcion' => 'Departamento de logística'],
            ['nombre' => 'GERENCIA GENERAL', 'descripcion' => 'Departamento de gerencia general'],
        ];

        foreach ($departamentos as $departamento) {
            DepartamentoTrabajo::create([
                'nombre' => $departamento['nombre'],
                'descripcion' => $departamento['descripcion'],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    // Crear tipo de relacion familiar 
    public function crearTipoRelacionFamiliar()
    {
        // Tipos de relaciones familiares válidos según las normativas legales en Argentina
        $tipos_relaciones = [
            'Cónyuge',
            'Conviviente',
            'Hijo/a biológico/a menor de 18 años',
            'Hijo/a adoptado/a menor de 18 años',
            'Hijo/a mayor de 18 años con discapacidad',
            'Padre/Madre dependiente',
            'Suegro/a dependiente',
            'Hermano/a menor de 18 años',
            'Hermano/a mayor con discapacidad',
            'Nieto/a bajo tutela',
            'Sobrino/a bajo tutela',
            'Otro familiar bajo tutela legal'
        ];

        foreach ($tipos_relaciones as $tipo_relacion) {
            TipoRelacion::create([
                'nombre' => $tipo_relacion,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    public function crearObrasSociales()
    {
        // Obtener archivo Obras Sociales.txt
        $obras_sociales = file_get_contents(storage_path('./csv/Obras Sociales.txt'));
        $obras_sociales = explode("\n", $obras_sociales);

        foreach ($obras_sociales as $obra_social) {
            ObraSocial::create([
                'nombre' => $obra_social,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }


    // crear tipos de contratos
    public function crearTiposContratos()
    {
        $tipos_contratos = [
            'Contrato a plazo fijo', // Contrato con una duración definida.
            'Contrato a tiempo indeterminado', // Contrato sin límite de tiempo (el más común en Argentina).
            'Contrato de aprendizaje', // Contrato para capacitar a jóvenes de entre 16 y 28 años.
            'Contrato a tiempo parcial', // Contrato con una jornada laboral reducida (menos de 48 horas semanales).
            'Contrato eventual', // Contrato para tareas transitorias o extraordinarias.
            'Contrato de temporada', // Contrato para tareas cíclicas o estacionales.
            'Contrato por grupo o equipo', // Contrato celebrado con un grupo de trabajadores.
            'Contrato de trabajo remoto', // Contrato bajo la Ley de Teletrabajo.
        ];

        $descripciones = [
            'Contrato laboral con una duración definida.',
            'Contrato laboral sin límite de tiempo.',
            'Contrato laboral para capacitar a jóvenes.',
            'Contrato laboral con una jornada reducida.',
            'Contrato laboral para tareas transitorias.',
            'Contrato laboral para tareas cíclicas.',
            'Contrato laboral celebrado con un grupo de trabajadores.',
            'Contrato laboral bajo la Ley de Teletrabajo.',
        ];

        foreach ($tipos_contratos as $key => $tipo_contrato) {
            TipoContrato::create([
                'nombre' => $tipo_contrato,
                'descripcion' => $descripciones[$key],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    public function crearTiposJornadasLaborales()
    {
        $tipos_jornadas = [
            'Jornada completa', // Jornada laboral máxima: 8 horas diarias o 48 horas semanales.
            'Jornada reducida', // Jornada inferior a la completa, por acuerdo entre partes o disposiciones legales.
            'Jornada nocturna', // Trabajo entre las 21:00 y las 06:00 horas (máximo de 7 horas).
            'Jornada insalubre', // Jornada reducida por trabajos insalubres (máximo de 6 horas diarias).
            'Jornada por turnos rotativos', // Jornadas alternadas entre distintos horarios.
            'Jornada discontinua', // Jornada con períodos de inactividad dentro de la jornada laboral.
            'Jornada partida', // Jornada dividida por un descanso mayor a dos horas.
            'Jornada flexible', // Jornada con horarios adaptables dentro de límites legales.
        ];

        $descripciones = [
            'Jornada laboral de 8 horas diarias o 48 horas semanales.',
            'Jornada laboral inferior a la completa, por acuerdo entre partes o disposiciones legales.',
            'Jornada laboral entre las 21:00 y las 06:00 horas (máximo de 7 horas).',
            'Jornada laboral reducida por trabajos insalubres (máximo de 6 horas diarias).',
            'Jornadas alternadas entre distintos horarios.',
            'Jornada laboral con períodos de inactividad dentro de la jornada.',
            'Jornada laboral dividida por un descanso mayor a dos horas.',
            'Jornada laboral con horarios adaptables dentro de límites legales.',
        ];

        foreach ($tipos_jornadas as $key => $tipo_jornada) {
            TipoJornada::create([
                'nombre' => $tipo_jornada,
                'descripcion' => $descripciones[$key],
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    public function crearTiposDocumentos()
    {
        // Certificados de estudios, certificado residencia, curriculum vitae, certificado de familiar a cargo, contrato de trabajo, copia de dni
        $tipos_documentos = [
            'Certificado de estudios',
            'Certificado de residencia',
            'Curriculum vitae',
            'Certificado de familiar a cargo',
            'Contrato de trabajo',
            'Certificado de emancipacion o permiso del tutor',
            'Copia de DNI',
        ];

        foreach ($tipos_documentos as $tipo_documento) {
            TipoDocumento::create([
                'nombre' => $tipo_documento,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    // Crear empresa Morfeo S.A.
    public function crearEmpresa()
    {
        // Crear empresa Morfeo S.A.
        Empresa::create([
            'nombre' => 'Morfeo S.A.',
            'razon_social' => 'Sociedad Anónima',
            'cuit' => '30-12345678-9',
            'inicio_actividades' => '01/01/2005',
            'ubicacion' => 'Buenos Aires, Argentina',
            'telefono' => '1234567890',
            'email' => 'morfeosa@mail.com'
        ]);
    }

    public function crearPuestoEmpleadoComercio()
    {
        // Crear tareas del puesto de trabajo
        // ATENCIÓN AL CLIENTE: Brindar información sobre productos y servicios, resolver consultas, gestionar reclamos y garantizar una experiencia satisfactoria.
        // GESTIÓN DE VENTAS: Procesar pagos, realizar facturación, aplicar promociones y registrar transacciones en el sistema.
        // CONTROL DE STOCK: Verificar el inventario, reponer productos, coordinar con proveedores y organizar depósitos.
        // TAREAS ADMINISTRATIVAS: Archivar documentos, realizar reportes de ventas y mantener registros actualizados.
        // MANTENIMIENTO DEL LOCAL: Asegurar la limpieza, el orden y el cumplimiento de normas de seguridad.
        // DISPOSICIÓN PARA TAREAS REQUERIDAS: Realizar cualquier otra actividad que sea asignada por el supervisor.
        $tareas = [
            'ATENCION AL CLIENTE' => 'Brindar información sobre productos y servicios, resolver consultas, gestionar reclamos y garantizar una experiencia satisfactoria.',
            'GESTIÓN DE VENTAS' => 'Procesar pagos, realizar facturación, aplicar promociones y registrar transacciones en el sistema.',
            'CONTROL DE STOCK' => 'Verificar el inventario, reponer productos, coordinar con proveedores y organizar depósitos.',
            'TAREAS ADMINISTRATIVAS' => 'Archivar documentos, realizar reportes de ventas y mantener registros actualizados.',
            'MANTENIMIENTO DEL LOCAL' => 'Asegurar la limpieza, el orden y el cumplimiento de normas de seguridad.',
            'DISPOSICIÓN PARA TAREAS REQUERIDAS' => 'Realizar cualquier otra actividad que sea asignada por el supervisor.',
        ];

        $tareas_totales = [];
        foreach ($tareas as $tarea => $descripcion) {
            $tareas_totales[] = TareaTrabajo::create([
                'nombre' => $tarea,
                'descripcion' => $descripcion,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        // Crear capacidades del puesto de trabajo
        // Responsabilidades adquiridas:
        // RELACIONES: Trato constante con clientes, proveedores y compañeros, manteniendo cordialidad y profesionalismo.
        // Condiciones de trabajo:
        // AMBIENTE: Trabajo en local comercial, con horarios rotativos y picos de actividad.
        // Requisitos intelectuales:    
        // ESCOLARIDAD INDISPENSABLE: Secundaria completa.
        // EXPERIENCIA: 6 meses a 1 año en atención al cliente, manejo de caja o roles similares.
        // APTITUDES ADICIONALES: Excelente comunicación, organización, trabajo en equipo, capacidad de resolución de problemas y atención al detalle.
        $tipos_capacidades = ['Requisitos intelectuales', 'Requisitos físicos', ' Responsabilidades adquiridas', 'Condiciones de trabajo'];
        $capacidades = [
            'RELACIONES EN VENTAS' => [
                'Trato constante con clientes, proveedores y compañeros, manteniendo cordialidad y profesionalismo.',
                $tipos_capacidades[2],
                true
            ],
            'AMBIENTE EN VENTAS' => [
                'Trabajo en local comercial, con horarios rotativos y picos de actividad.',
                $tipos_capacidades[3],
                true
            ],
            'ESCOLARIDAD INDISPENSABLE EN VENTAS' => [
                'Secundaria completa.',
                $tipos_capacidades[0],
                true
            ],
            'EXPERIENCIA EN VENTAS' => [
                '6 meses a 1 año en atención al cliente, manejo de caja o roles similares.',
                $tipos_capacidades[0],
                true
            ],
            'APTITUDES ADICIONALES EN VENTAS' => [
                'Excelente comunicación, organización, trabajo en equipo, capacidad de resolución de problemas y atención al detalle.',
                $tipos_capacidades[0],
                false
            ]
        ];

        $capacidades_totales = [];
        foreach ($capacidades as $capacidad => $descripcion) {
            $capacidades_totales[] = [
                CapacidadesTrabajo::create([
                    'nombre' => $capacidad,
                    'descripcion' => $descripcion[0],
                    'id_tipo_capacidad' => TipoCapacidad::where('nombre', $descripcion[1])->first()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ])->tipoCapacidad()->associate(TipoCapacidad::where('nombre', $descripcion[1])->first()->id),
                $descripcion[2]
            ];
        }


        // Crear puesto de trabajo 
        // Título del puesto: EMPLEADO DE COMERCIO
        // Descripción genérica:
        // Atender clientes, procesar ventas, gestionar stock, realizar tareas administrativas y mantener el orden en el local.
        // Sueldo base: $ 250,000.00 (ARS)

        $puesto_trabajo = [
            'titulo' => 'EMPLEADO DE COMERCIO',
            'descripcion' => 'Atender clientes, procesar ventas, gestionar stock, realizar tareas administrativas y mantener el orden en el local.',
            'sueldo_base' => 250000.00,
        ];

        $puesto = PuestoTrabajo::create([
            'titulo_puesto' => $puesto_trabajo['titulo'],
            'descripcion_generica' => $puesto_trabajo['descripcion'],
            'sueldo_base' => $puesto_trabajo['sueldo_base'],
            'id_departamento_trabajo' => DepartamentoTrabajo::where('nombre', 'VENTAS')->first()->id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ])->departamentoTrabajo()->associate(DepartamentoTrabajo::where('nombre', 'VENTAS')->first()->id);

        // Asignar capacidades al puesto de trabajo
        foreach ($capacidades_totales as $capacidad) {
            $puesto->capacidadesTrabajos()->attach($capacidad[0]->id, ['excluyente' => $capacidad[1]]);
        }

        // Asignar tareas al puesto de trabajo
        foreach ($tareas_totales as $tarea) {
            $puesto->tareasTrabajos()->attach($tarea->id);
        }
    }

    public function crearPuestoReclutadorRRHH()
    {
        // Crear tareas del puesto de trabajo
        $tareas = [
            'RECLUTAMIENTO Y SELECCION' => 'Publicar ofertas laborales, filtrar currículums, realizar entrevistas y coordinar procesos de selección.',
            'GESTIÓN DE PERSONAL' => 'Mantener actualizados los expedientes del personal y coordinar inducciones y capacitaciones.',
            'ADMINISTRACIÓN DE NOMINA' => 'Supervisar el cálculo de salarios, controlar ausencias y gestionar beneficios para los empleados.',
            'EVALUACIONES DE DESEMPEÑO' => 'Diseñar y aplicar métricas para evaluar el desempeño del personal.',
            'REPORTES Y ANALISIS' => 'Preparar informes de gestión, métricas de contratación y sugerencias para optimizar recursos humanos.',
            'OTRAS FUNCIONES ASIGNADAS' => 'Colaborar en proyectos relacionados con el área de administración y finanzas.',
        ];

        $tareas_totales = [];
        foreach ($tareas as $tarea => $descripcion) {
            $tareas_totales[] = TareaTrabajo::create([
                'nombre' => $tarea,
                'descripcion' => $descripcion,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        // Crear capacidades del puesto de trabajo
        $tipos_capacidades = ['Requisitos intelectuales', 'Requisitos físicos', ' Responsabilidades adquiridas', 'Condiciones de trabajo'];
        $capacidades = [
            'RELACIONES INTERPERSONALES EN RRHH' => [
                'Habilidad para interactuar de manera efectiva con candidatos, empleados y directivos.',
                $tipos_capacidades[2],
                true
            ],
            'AMBIENTE DE OFICINA EN RRHH' => [
                'Trabajo en un entorno administrativo con horarios regulares.',
                $tipos_capacidades[3],
                true
            ],
            'ESCOLARIDAD INDISPENSABLE EN RRHH' => [
                'Graduado en Recursos Humanos, Administración o carreras afines.',
                $tipos_capacidades[0],
                true
            ],
            'EXPERIENCIA EN RRHH' => [
                '2 años de experiencia en reclutamiento o gestión de personal.',
                $tipos_capacidades[0],
                true
            ],
            'APTITUDES ADICIONALES EN RRHH' => [
                'Organización, comunicación efectiva, trabajo en equipo y enfoque en resultados.',
                $tipos_capacidades[0],
                false
            ]
        ];

        $capacidades_totales = [];
        foreach ($capacidades as $capacidad => $descripcion) {
            $capacidades_totales[] = [
                CapacidadesTrabajo::create([
                    'nombre' => $capacidad,
                    'descripcion' => $descripcion[0],
                    'id_tipo_capacidad' => TipoCapacidad::where('nombre', $descripcion[1])->first()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ])->tipoCapacidad()->associate(TipoCapacidad::where('nombre', $descripcion[1])->first()->id),
                $descripcion[2]
            ];
        }

        // Crear puesto de trabajo
        $puesto_trabajo = [
            'titulo' => 'RECLUTADOR DE RECURSOS HUMANOS',
            'descripcion' => 'Gestionar el reclutamiento, selección y administración de personal, asegurando el cumplimiento de las políticas del área.',
            'sueldo_base' => 350000.00,
        ];

        $puesto = PuestoTrabajo::create([
            'titulo_puesto' => $puesto_trabajo['titulo'],
            'descripcion_generica' => $puesto_trabajo['descripcion'],
            'sueldo_base' => $puesto_trabajo['sueldo_base'],
            'id_departamento_trabajo' => DepartamentoTrabajo::where('nombre', 'ADMINISTRACION Y FINANZAS')->first()->id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ])->departamentoTrabajo()->associate(DepartamentoTrabajo::where('nombre', 'ADMINISTRACION Y FINANZAS')->first()->id);

        // Asignar capacidades al puesto de trabajo
        foreach ($capacidades_totales as $capacidad) {
            $puesto->capacidadesTrabajos()->attach($capacidad[0]->id, ['excluyente' => $capacidad[1]]);
        }

        // Asignar tareas al puesto de trabajo
        foreach ($tareas_totales as $tarea) {
            $puesto->tareasTrabajos()->attach($tarea->id);
        }
    }

    public function crearPuestoGerenteGeneral()
    {
        // Crear tareas del puesto de trabajo
        $tareas = [
            'PLANIFICACIÓN ESTRATÉGICA GERNECIAL' => 'Diseñar estrategias para el crecimiento y sostenibilidad de la empresa.',
            'SUPERVISIÓN GERENCIAL DE ÁREAS' => 'Coordinar las actividades de los diferentes departamentos, asegurando eficiencia y cumplimiento de metas.',
            'GESTIÓN GERENCIAL Y FINANCIERA' => 'Aprobar presupuestos, evaluar inversiones y monitorear el rendimiento financiero.',
            'RELACIONES GERENCIALES E INSTITUCIONALES' => 'Representar a la empresa ante socios, clientes y organismos externos.',
            'TOMA DE DECISIONES GERENCIALES' => 'Analizar información clave y ejecutar soluciones efectivas.',
            'LIDERAZGO GERENCIAL Y GESTIÓN DE EQUIPOS' => 'Motivar al personal y fomentar un ambiente de trabajo positivo.',
        ];

        $tareas_totales = [];
        foreach ($tareas as $tarea => $descripcion) {
            $tareas_totales[] = TareaTrabajo::create([
                'nombre' => $tarea,
                'descripcion' => $descripcion,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        // Crear capacidades del puesto de trabajo
        $tipos_capacidades = ['Requisitos intelectuales', 'Requisitos físicos', ' Responsabilidades adquiridas', 'Condiciones de trabajo'];
        $capacidades = [
            'RELACIONES INTERPERSONALES GERENCIALES' => [
                'Capacidad para interactuar con socios estratégicos, clientes y líderes internos de forma profesional.',
                $tipos_capacidades[2],
                true
            ],
            'AMBIENTE DE TRABAJO GERENCIAL' => [
                'Trabajo en oficinas corporativas, con horarios flexibles y posibilidad de viajes frecuentes.',
                $tipos_capacidades[3],
                true
            ],
            'ESCOLARIDAD INDISPENSABLE GERENCIAL' => [
                'Título universitario en Administración, Economía, Ingeniería o áreas afines.',
                $tipos_capacidades[0],
                true
            ],
            'EXPERIENCIA GERENCIAL' => [
                'Mínimo 5 años en puestos de alta dirección o gerencia.',
                $tipos_capacidades[0],
                true
            ],
            'APTITUDES ADICIONALES GERENCIALES' => [
                'Liderazgo, visión estratégica, habilidades de negociación y resolución de problemas.',
                $tipos_capacidades[0],
                true
            ]
        ];

        $capacidades_totales = [];
        foreach ($capacidades as $capacidad => $descripcion) {
            $capacidades_totales[] = [
                CapacidadesTrabajo::create([
                    'nombre' => $capacidad,
                    'descripcion' => $descripcion[0],
                    'id_tipo_capacidad' => TipoCapacidad::where('nombre', $descripcion[1])->first()->id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ])->tipoCapacidad()->associate(TipoCapacidad::where('nombre', $descripcion[1])->first()->id),
                $descripcion[2]
            ];
        }

        // Crear puesto de trabajo
        $puesto_trabajo = [
            'titulo' => 'GERENTE GENERAL',
            'descripcion' => 'Dirigir y supervisar las operaciones generales de la empresa, definiendo estrategias y liderando equipos para alcanzar los objetivos organizacionales.',
            'sueldo_base' => 1200000.00,
        ];

        $puesto = PuestoTrabajo::create([
            'titulo_puesto' => $puesto_trabajo['titulo'],
            'descripcion_generica' => $puesto_trabajo['descripcion'],
            'sueldo_base' => $puesto_trabajo['sueldo_base'],
            'id_departamento_trabajo' => DepartamentoTrabajo::where('nombre', 'GERENCIA GENERAL')->first()->id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ])->departamentoTrabajo()->associate(DepartamentoTrabajo::where('nombre', 'GERENCIA GENERAL')->first()->id);

        // Asignar capacidades al puesto de trabajo
        foreach ($capacidades_totales as $capacidad) {
            $puesto->capacidadesTrabajos()->attach($capacidad[0]->id, ['excluyente' => $capacidad[1]]);
        }

        // Asignar tareas al puesto de trabajo
        foreach ($tareas_totales as $tarea) {
            $puesto->tareasTrabajos()->attach($tarea->id);
        }
    }

    public function crearRelacionesFamiliares()
    {
        $relaciones = [
            'Padre',
            'Madre',
            'Hijo/a',
            'Hermano/a',
            'Abuelo/a',
            'Tio/a',
            'Primo/a',
            'Sobrino/a',
            'Cuñado/a',
            'Suegro/a',
            'Yerno',
        ];

        foreach ($relaciones as $relacion) {
            RelacionFamilia::create([
                'nombre' => $relacion,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->crearTipoRelacionFamiliar();
        $this->crearUsuarios();
        $this->crearRolesPermisos();
        $this->crearSexos();
        $this->crearEstadosCiviles();
        $this->crearUbicaciones();
        //$this->crearPersonas();
        $this->crearTiposCapacidades();
        $this->crearDepartamentos();
        $this->crearObrasSociales();
        $this->crearTiposContratos();
        $this->crearTiposJornadasLaborales();
        $this->crearTiposDocumentos();
        $this->crearEmpresa();
        $this->crearPuestoEmpleadoComercio();
        $this->crearRelacionesFamiliares();
        $this->crearPuestoReclutadorRRHH();
        $this->crearPuestoGerenteGeneral();
    }
}
