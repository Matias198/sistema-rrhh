<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RenderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/gestion/empleados/listar', [RenderController::class, 'render_gestion_empleados_listar'])->name('gestion-empleados-listar');
Route::get('/gestion/empleados/nuevo', [RenderController::class, 'render_gestion_empleados_agregar'])->name('gestion-empleados-agregar');

Route::get('/gestion/admin/roles', [RenderController::class, 'render_gestion_admin_roles'])->name('gestion-admin-roles'); 

Route::get('/gestion/admin/puesto', [RenderController::class, 'render_gestion_admin_puesto_trabajos'])->name('gestion-admin-puesto-trabajos');
Route::get('gestion/admin/puesto/agregar', [RenderController::class, 'render_gestion_admin_puesto_trabajos_agregar'])->name('gestion-admin-puesto-trabajos-agregar');

// departamento
Route::get('/gestion/admin/departamentos', [RenderController::class, 'render_gestion_admin_departamentos'])->name('gestion-admin-departamentos');