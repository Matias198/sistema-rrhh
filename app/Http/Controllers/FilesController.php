<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function obtenerArchivo($dni, $tipo_documento, $filename, $user_id)
    {
        //dd($dni, $tipo_documento, $filename, $user);
        // Validar que el enlace firmado sea válido
        if (!request()->hasValidSignature()) {
            abort(403, 'Este enlace ha expirado o no es válido.');
        }
        $ruta = 'app/private/archivos/' . $dni . '/' . $tipo_documento . '/' . $filename;
        $filePath = storage_path($ruta);

        //$filePath = Storage::disk('local')->path($ruta);
        //dd($filePath, $ruta);
        if (!file_exists($filePath)) {
            abort(404, 'El archivo no existe.');
        }

        if ($user_id != \Illuminate\Support\Facades\Auth::user()->id) {
            abort(403, 'No tienes permiso para acceder a este archivo.');
        }
    
        return response()->file($filePath);
    }
}
