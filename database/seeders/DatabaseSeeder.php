<?php

namespace Database\Seeders;

use App\Models\DepartamentoTrabajo;
use App\Models\Empresa;
use App\Models\EstadoCivil;
use App\Models\ObraSocial;
use App\Models\TipoCapacidad;
use App\Models\User;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\Sexo;
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
    function crearUsuarios()
    {
        User::create([
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }

    function crearRolesPermisos()
    {
        $user = User::find(1);
        $role1 = Role::create(['name' => 'SYSADMIN']); // system administrator
        $role2 = Role::create(['name' => 'DIRECTOR']); // administrador
        $role3 = Role::create(['name' => 'JEFE']); // rrhh (realiza contrataciones)
        $role4 = Role::create(['name' => 'EMPLEADO']); // empleado
        $permission1 = Permission::create(['name' => 'gestionar_empleados']);
        $permission2 = Permission::create(['name' => 'gestionar_parametros']);
        $permission3 = Permission::create(['name' => 'gestionar_roles_permisos']);
        $permission4 = Permission::create(['name' => 'gestionar_puesto_trabajos']);
        $permission5 = Permission::create(['name' => 'gestionar_departamentos']);
        $permission6 = Permission::create(['name' => 'gestionar_auditorias']);

        $role1->givePermissionTo([
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $permission5,
            $permission6,
        ]);

        $user->assignRole($role1);
        $user->save();
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
        $persona = Persona::create([
            'nombre' => 'Juan',
            'segundo_nombre' => 'Carlos',
            'apellido' => 'Pérez',
            'dni' => '12345678',
            'cuil' => '20123456789',
            'fecha_nacimiento' => '01/01/1999',
            'calle' => 'Calle Falsa',
            'altura' => '123',
            'id_sexo' => 1,
            'id_estado_civil' => 1,
            'id_municipio' => 1365,
            'id_usuario' => 1,
        ]);
        $persona->usuario()->associate(User::find(1));
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
            ['nombre' => 'Administración y Finanzas', 'descripcion' => 'Departamento de administración y finanzas'],
            ['nombre' => 'Ventas', 'descripcion' => 'Departamento de ventas'],
            ['nombre' => 'Logística', 'descripcion' => 'Departamento de logística'],
            ['nombre' => 'Gerencia General', 'descripcion' => 'Departamento de gerencia general'],
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

    public function crearTiposDocumentos(){
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
    }
}
