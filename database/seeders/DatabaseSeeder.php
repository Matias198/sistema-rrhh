<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Matias',
            'password' => Hash::make('12345678'),
            'email' => 'matias@mail.com',
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        $role1 = Role::create(['name' => 'director']);
        $role2 = Role::create(['name' => 'supervisor']);
        $role3 = Role::create(['name' => 'operario']);
        $permission1 = Permission::create(['name' => 'gestionar_empleados']);
        $permission2 = Permission::create(['name' => 'gestionar_nominas']);
        $permission3 = Permission::create(['name' => 'gestionar_asistencias']);
        // $permission4 = Permission::create(['name' => 'gestionar_historial']);
        // $permission5 = Permission::create(['name' => 'gestionar_reportes']);
        // $permission6 = Permission::create(['name' => 'gestionar_parametros']);
        // $permission7 = Permission::create(['name' => 'gestionar_datos_personales']);
        // $permission8 = Permission::create(['name' => 'gestionar_logistica_ventas']);
        // $permission7 = Permission::create(['name' => 'generar_reportes']);

        $role1->givePermissionTo([$permission1, $permission2, $permission3]);
        // $role2->givePermissionTo([$permission1, $permission2, $permission3, $permission4, $permission5, $permission6]);
        // $role3->givePermissionTo([$permission7]);
    }
}
