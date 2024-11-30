<?php

namespace App\Livewire\Gestion\Empleados;

use App\Models\DocumentoCertificado;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\TipoDocumento;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\URL;

class Ver extends Component
{
    use WithFileUploads;
    public $id_persona;
    public $persona;
    public $capacidades;
    public $documento_file;
    public $empresa;
    public $anio_inicio;

    // Listeners
    protected $listeners = ['actualizar_mail' => 'actualizar_mail'];
    public function mount($id_persona)
    {
        $this->id_persona = $id_persona;
        $this->persona = Persona::find($this->id_persona);
        if ($this->persona == null) {
            return redirect()->route('gestion-empleados-listar');
        }
        $this->empresa = Empresa::first();
        $this->anio_inicio = Carbon::parse($this->empresa->inicio_actividades)->format('Y');
    }

    public function actualizar_mail(){
        $this->persona = Persona::find($this->id_persona);
    }

    public function render()
    {
        $this->capacidades = $this->persona->empleado->puesto->capacidadesTrabajos->pluck('nombre')->toArray();
        return view('livewire.gestion.empleados.ver');
    }


    public function generarEnlaceTemporal($dni, $tipo_documento, $filename)
    {
        // Tiempo en minutos antes de que el enlace expire
        $expiration = now()->addMinutes(5);
        // Obtener nombre de archivo luego del ultimo /
        $nombre = explode('/', $filename);
        $nombre = end($nombre);

        // Generar URL firmada
        return URL::signedRoute('private.access', [
            'dni' => $dni,
            'tipo_documento' => $tipo_documento,
            'filename' => $nombre,
            'user_id' => \Illuminate\Support\Facades\Auth::user()->id,
        ], $expiration);
    }

    public function obtenerArchivo($id_documento, $nombre_archivo){
        $documento = DocumentoCertificado::find($id_documento);
        $tipo_documento = $this->obtenerCarpeta($documento);
        return $this->generarEnlaceTemporal($this->persona->dni, $tipo_documento, $nombre_archivo);
    }

    public function obtenerCarpeta($documento)
    {
        // Nombres de carpetas
        $nombres_carpetas = ['autorizacion', 'contrato', 'cv', 'dni', 'familiares', 'residencia'];

        switch ($documento->tipoDocumento->nombre) {
            case 'Certificado de emancipacion o permiso del tutor':
                $carpeta = $nombres_carpetas[0];
                break;
            case 'Contrato de trabajo':
                $carpeta = $nombres_carpetas[1];
                break;
            case 'Curriculum vitae':
                $carpeta = $nombres_carpetas[2];
                break;
            case 'Copia de DNI':
                $carpeta = $nombres_carpetas[3];
                break;
            case 'Certificado de familiar a cargo':
                $carpeta = $nombres_carpetas[4];
                break;
            case 'Certificado de residencia':
                $carpeta = $nombres_carpetas[5];
                break;
        }
        return $carpeta;
    }
    public function actualizarDocumento($id_documento)
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                $errors = $validator->messages()->messages();
                foreach ($errors as $i => $value) {
                    $this->dispatch('error_critico', $value[0]);
                    return;
                }
            });
        })->validate([
            'documento_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ], [
            'documento_file.required' => 'El documento es requerido',
            'documento_file.file' => 'El documento debe ser un archivo',
            'documento_file.mimes' => 'El documento debe ser un archivo de tipo: pdf, doc, docx, jpg, jpeg, png',
            'documento_file.max' => 'El documento no debe superar los 2MB',
        ]);

        try {
            DB::beginTransaction();
            $documento = DocumentoCertificado::find($id_documento);
            $documento->estado = false;
            $documento->save();

            $carpeta = $this->obtenerCarpeta($documento);

            // Cargar documento
            $archivo = $this->documento_file;
            $nombre = uniqid() . '.' . $archivo->guessExtension();
            $ruta = $archivo->storeAs('archivos/' . $this->persona->dni . '/' . $carpeta, $nombre);
            $documento_nuevo = DocumentoCertificado::create([
                'nombre_archivo' => $archivo->getClientOriginalName(),
                'detalle' => $ruta,
                'id_persona' => $this->persona->id,
                'id_tipo_documento' => $documento->tipoDocumento->id,
            ]);
            $this->persona->documentosCertificados()->save($documento_nuevo);
            $this->documento_file = null;
            $this->persona = Persona::find($this->id_persona);

            DB::commit();
            $this->dispatch('success-documento', 'Documento actualizado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error_critico', 'Error al actualizar el documento');
        }
    }
}
