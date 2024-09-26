<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RenderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/gestion/empleados', [RenderController::class, 'render_gestion_empleados'])->name('gestion-empleados');
Route::get('/gestion/nominas', [RenderController::class, 'render_gestion_nominas'])->name('gestion-nominas');
Route::get('/gestion/asistencias', [RenderController::class, 'render_gestion_asistencias'])->name('gestion-asistencias');
Route::get('/gestion/licencias', [RenderController::class, 'render_gestion_licencias'])->name('gestion-licencias');