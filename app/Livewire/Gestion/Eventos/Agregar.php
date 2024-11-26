<?php
namespace App\Http\Livewire;
namespace App\Livewire\Gestion\Eventos;

use App\Models\Evento;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Agregar extends Component{
    /**
     * Display a listing of the resource.
     */
    
    public function render(){
        return view('livewire.gestion.eventos.agregar');
    }

    /**
     * Show the form for creating a new resource.
    */
    public $title; // Declare properties
    public $start;
    public $end;

    public function addEvent()    {
        // Valida el ingreso de los datos
        $this->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        // Guarda el evento en la base de datos
        Evento::create([
            'title' => $this->title,
            'start' => $this->start,
            'end' => $this->end,
        ]);
        // Muestra un evento en el frontend
        $this->dispatch('eventAdded');
    } 
    
    // Elimina un evento
    public function deleteEvent($id)    {
        $event = Evento::findOrFail($id);
        $event->delete();

        $this->dispatch('eventDeleted'); // Notifica frontend
    }
   
}