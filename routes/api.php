<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\Evento;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/eventos', [HomeController::class, 'getEventos']);
Route::post('/eventos', [HomeController::class, 'crearEvento']);
Route::put('/eventos/{id}', [HomeController::class, 'updatedEvent']);

// Delete an event
Route::delete('/eventos/{id}', function ($id) {
    $event = Evento::findOrFail($id);
    $event->delete();

    return response()->json(['message' => 'Evento eliminado satisfactoriamente'], 200);
});