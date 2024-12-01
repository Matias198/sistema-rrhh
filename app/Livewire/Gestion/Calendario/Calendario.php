<?php

namespace App\Livewire\Gestion\Calendario;

use App\Models\Evento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Calendario extends Component
{
    public $id_evento;
    public $urlEnabled = false;
    public $editando = false;
    public $grupo;
    public $grupos_acceso = [];
    public $fecha_inicio;
    public $fecha_fin;
    public $titulo;
    public $color;
    public $eventos;

    public function rules()
    {
        return [
            'grupo' => 'required|integer',
            'fecha_inicio' => 'required|date|after_or_equal:' . Carbon::now()->format('d-m-Y'),
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'titulo' => 'required|string', 
            'color' => 'required',
        ];
    }

    protected $messages = [
        'grupo.required' => 'El campo grupo es requerido',
        'grupo.integer' => 'El campo grupo debe ser un número entero',
        'fecha_inicio.required' => 'El campo fecha de inicio es requerido',
        'fecha_inicio.date' => 'El campo fecha de inicio debe ser una fecha',
        'fecha_inicio.after' => 'El campo fecha de inicio debe ser una fecha posterior a la fecha actual',
        'fecha_fin.required' => 'El campo fecha de fin es requerido',
        'fecha_fin.date' => 'El campo fecha de fin debe ser una fecha',
        'fecha_fin.after' => 'El campo fecha de fin debe ser una fecha posterior a la fecha de inicio',
        'titulo.required' => 'El campo título es requerido',
        'titulo.string' => 'El campo título debe ser una cadena de texto', 
        'color.required' => 'El campo color es requerido',
    ];

    public function mount()
    {
        $this->grupos_acceso = [
            [
                'id' => 999,
                'nombre' => 'PUBLICO',
            ],
            [
                'id' => Auth::user()->id,
                'nombre' => 'PERSONAL',
            ]
        ];
       $this->getEventos(); 
    }
    public function getEventos(){
        $this->eventos = [];
        if (User::find(Auth::user()->id)->hasRole('SYSADMIN')) {
            $this->eventos = Evento::all()->toArray();
        } else {
            $this->eventos = Evento::where('grupo', 999)->orWhere('grupo', Auth::user()->id)->get()->toArray();
        }// Convertir titulo a title, fecha_inicio a start, fecha_fin a end, grupo a groupId
        if ($this->eventos){
            $this->eventos = array_map(function ($evento) {
                $persona = Evento::find($evento['id'])->usuarios->first()->persona;
                $aux = [];
                $aux['id'] = $evento['id'];
                $aux['title'] = $evento['titulo'];
                $aux['start'] = $evento['fecha_inicio'];
                $aux['end'] = $evento['fecha_fin'];
                $aux['groupId'] = $evento['grupo']; 
                $aux['color'] = $evento['color'];
                if ($persona){
                    $aux['owner'] = $persona->nombre . ' ' . $persona->apellido;
                }else{
                    $aux['owner'] = 'PUBLICO';
                }
                return $aux;
            }, $this->eventos);
        }
        return $this->eventos;
    }
    public function render()
    {
        return view('livewire.gestion.calendario.calendario');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function limpiar()
    {
        $this->reset(['grupo', 'fecha_inicio', 'fecha_fin', 'titulo', 'color']);
        $this->resetErrorBag();
    }

    public function deleteEvent()
    {
        try {
            DB::beginTransaction();
            $evento = Evento::find($this->id_evento);
            $evento->usuarios()->detach(Auth::user()->id);
            $evento->delete();
            $this->getEventos();
            $this->dispatch('success_refresh_table', 'Evento eliminado correctamente');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Ocurrió un error al eliminar el evento: ' . $e->getMessage());
        }
    }

    public function noEditar()
    {
        $this->editando = false;
        $this->limpiar();
    }

    public function saveEvent()
    {
        if (User::find(Auth::user()->id)->hasRole('EMPLEADO')) {
            $this->grupo = Auth::user()->id;
        }
        $this->validate();
        if ($this->editando){
            $evento = Evento::find($this->id_evento);
        }else{
            $evento = new Evento();
        }
        try {
            DB::beginTransaction();
            $evento->grupo = $this->grupo;
            $evento->fecha_inicio = $this->fecha_inicio;
            $evento->fecha_fin = $this->fecha_fin;
            $evento->titulo = $this->titulo;
            $evento->color = $this->color;
            $evento->save();
            if (!$this->editando){
                $evento->usuarios()->attach(Auth::user()->id);
            }            
            $this->getEventos();
            $this->dispatch('success_refresh_table', 'Evento guardado correctamente');
            DB::commit();
            $this->limpiar();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Ocurrió un error al guardar el evento: ' . $e->getMessage());
        }
    }
    public function editEvent($id)
    {
        $evento = Evento::find($id);
        if ($evento->grupo != 999 && $evento->grupo != Auth::user()->id){
            $this->dispatch('error', 'No puedes editar un evento que no te pertenece');
            $this->limpiar();
            return;
        }

        if ($evento->grupo == 999 && User::find(Auth::user()->id)->hasRole('EMPLEADO|JEFE DE AREA')){
            $this->dispatch('error', 'No puedes editar un evento publico');
            $this->limpiar();
            return;
        }

        $this->id_evento = $evento->id;
        $this->editando = true;
        $this->grupo = $evento->grupo;
        $this->fecha_inicio = Carbon::parse($evento->fecha_inicio)->format('d-m-Y');
        $this->fecha_fin = Carbon::parse($evento->fecha_fin)->format('d-m-Y');
        $this->titulo = $evento->titulo; 
        $this->color = $evento->color;
        $this->dispatch('edit_event', [$id, $this->titulo, $this->fecha_inicio, $this->fecha_fin, $this->color, $this->grupo]);
    }
}
