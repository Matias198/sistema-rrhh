<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RenderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/gestion/empleados/listar', [RenderController::class, 'render_gestion_empleados_listar'])->name('gestion-empleados-listar');
Route::get('/gestion/empleados/nuevo', [RenderController::class, 'render_gestion_empleados_agregar'])->name('gestion-empleados-agregar');
Route::get('/gestion/empleados/success', [RenderController::class, 'render_gestion_empleados_success'])->name('gestion-empleados-success');
Route::get('/gestion/empleados/ver/{id_persona}', [RenderController::class, 'render_gestion_empleados_ver'])->name('gestion-empleados-ver');

Route::get('/gestion/admin/roles', [RenderController::class, 'render_gestion_admin_roles'])->name('gestion-admin-roles'); 

Route::get('/gestion/admin/puesto', [RenderController::class, 'render_gestion_admin_puesto_trabajos'])->name('gestion-admin-puesto-trabajos');
Route::get('gestion/admin/puesto/agregar', [RenderController::class, 'render_gestion_admin_puesto_trabajos_agregar'])->name('gestion-admin-puesto-trabajos-agregar');

// departamento
Route::get('/gestion/admin/departamentos', [RenderController::class, 'render_gestion_admin_departamentos'])->name('gestion-admin-departamentos');

Route::get('/archivos/{dni}/{tipo_documento}/{filename}/{user_id}', [FilesController::class, 'obtenerArchivo'])->name('private.access'); 

// auditoria gestion/admin/auditoria
Route::get('/gestion/admin/auditoria', [RenderController::class, 'render_gestion_admin_auditoria'])->name('gestion-admin-auditoria');

// usuarios del sistema
Route::get('/gestion/admin/usuarios', [RenderController::class, 'render_gestion_admin_usuarios'])->name('gestion-admin-usuarios');

// perfil de usuario
Route::get('/perfil/usuario', [RenderController::class, 'render_gestion_admin_usuarios_perfil'])->name('gestion-admin-usuarios-perfil');

// gestion/admin/gerentes
Route::get('/gestion/admin/gerentes', [RenderController::class, 'render_gestion_admin_gerentes'])->name('gestion-admin-gerentes');