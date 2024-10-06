<?php

namespace Database\Seeders;

use App\Models\EstadoCivil;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pais;
use App\Models\Sexo;
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
            'name' => 'Matias',
            'password' => Hash::make('12345678'),
            'email' => 'matias@mail.com',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }

    function crearRolesPermisos()
    {
        $user = User::find(1);
        $role1 = Role::create(['name' => 'director']); // administrador
        $role2 = Role::create(['name' => 'supervisor']); // rrhh (realiza contrataciones)
        $role3 = Role::create(['name' => 'operario']); // empleado
        $permission1 = Permission::create(['name' => 'gestionar_empleados']);
        $permission2 = Permission::create(['name' => 'gestionar_nominas']);
        $permission3 = Permission::create(['name' => 'gestionar_asistencias']);
        $permission4 = Permission::create(['name' => 'gestionar_licencias']);

        $role1->givePermissionTo([$permission1, $permission2, $permission3, $permission4]);

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
        // Crear pais Argentina

        $pais = Pais::create([
            'codigo' => 'AR',
            'nombre' => 'Argentina',
        ]);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false,),));
        $respuesta = $guzzleClient->request('GET', 'https://apis.datos.gob.ar/georef/api/provincias');
        $provincias = json_decode($respuesta->getBody()->getContents(), true);
        foreach ($provincias['provincias'] as $provincia) {
            $pais->provincias()->create([
                'codigo' => $provincia['id'],
                'nombre' => $provincia['nombre'],
            ]);
        }

        foreach ($pais->provincias as $provincia) {
            $respuesta = $guzzleClient->request('GET', 'https://apis.datos.gob.ar/georef/api/municipios?provincia=' . $provincia->codigo . "&max=5000");
            $municipios = json_decode($respuesta->getBody()->getContents(), true);
            foreach ($municipios['municipios'] as $municipio) {
                $provincia->municipios()->create([
                    'codigo' => $municipio['id'],
                    'nombre' => $municipio['nombre'],
                ]);
            }
        }
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // llamar a las funciones
        $this->crearUsuarios();
        $this->crearRolesPermisos();
        $this->crearSexos();
        $this->crearEstadosCiviles();
        $this->crearUbicaciones();
    }
}
