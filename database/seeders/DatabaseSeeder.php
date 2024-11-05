<?php

namespace Database\Seeders;

use App\Models\DepartamentoTrabajo;
use App\Models\EstadoCivil;
use App\Models\TipoCapacidad;
use App\Models\User;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\Sexo;
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
            'email' => 'matias@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        // Juan Carlos
        User::create([
            'email' => 'juan@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }

    function crearRolesPermisos()
    {
        $user = User::find(1);
        $role1 = Role::create(['name' => 'DIRECTOR']); // administrador
        $role2 = Role::create(['name' => 'JEFE']); // rrhh (realiza contrataciones)
        $role3 = Role::create(['name' => 'EMPLEADO']); // empleado
        $permission1 = Permission::create(['name' => 'gestionar_empleados']);
        $permission2 = Permission::create(['name' => 'gestionar_parametros']);
        $permission3 = Permission::create(['name' => 'gestionar_roles_permisos']);
        $permission4 = Permission::create(['name' => 'gestionar_puesto_trabajos']);
        $permission5 = Permission::create(['name' => 'gestionar_departamentos']);

        $role1->givePermissionTo([
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $permission5,
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

        // Cargar desde csv desde storage private las provincias
        // "id","codigo","nombre","id_pais","created_at","updated_at"
        $csv = file_get_contents(storage_path('./app/private/provincias.csv'));
        $csv = explode("\n", $csv);

        foreach ($csv as $provincia) {
            $provincia = explode(',', $provincia);
            //dd($provincia);
            $pais->provincias()->create([
                'codigo' => $provincia[1],
                'nombre' => $provincia[2],
                'id_pais' => intval($provincia[3]),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }

        // Cargar desde csv desde storage private los municipios 
        // "id","codigo","nombre","id_provincia","created_at","updated_at"
        $csv = file_get_contents(storage_path('./app/private/municipios.csv'));
        $csv = explode("\n", $csv);

        foreach ($csv as $municipio) {
            $municipio = explode(',', $municipio);
            $provincias = Pais::find(1)->provincias()->get();
            foreach ($provincias as $provincia) {
                $municipio[3] = str_replace('"', '', $municipio[3]);
                if ($provincia->id == intval($municipio[3])) {
                    $provincia->municipios()->create([
                        //"id","codigo","nombre","id_provincia","created_at","updated_at" 
                        'codigo' => $municipio[1],
                        'nombre' => $municipio[2],
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
            'nombre' => 'Matías',
            'segundo_nombre' => 'Daniel',
            'apellido' => 'Fernández',
            'dni' => '41419890',
            'cuil' => '20414198903',
            'fecha_nacimiento' => '12/06/1999',
            'calle' => 'Martín Fierro',
            'altura' => '0000',
            'id_sexo' => 1,
            'id_estado_civil' => 1,
            'id_municipio' => 1365,
            'id_usuario' => 1,
        ]);
        $persona->usuario()->associate(User::find(1));

        $persona = Persona::create([
            'nombre' => 'Juan',
            'segundo_nombre' => 'Carlos',
            'apellido' => 'Pérez',
            'dni' => '12345678',
            'cuil' => '99123456789',
            'fecha_nacimiento' => '01/01/1999',
            'calle' => 'Martín Fierro',
            'altura' => '0000',
            'id_sexo' => 1,
            'id_estado_civil' => 1,
            'id_municipio' => 1365,
            'id_usuario' => 2,
        ]);
        $persona->usuario()->associate(User::find(2));
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

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->crearUsuarios();
        $this->crearRolesPermisos();
        $this->crearSexos();
        $this->crearEstadosCiviles();
        $this->crearUbicaciones();
        $this->crearPersonas();
        $this->crearTiposCapacidades();
        $this->crearDepartamentos();
    }
}
