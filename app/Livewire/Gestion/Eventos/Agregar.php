<?php

namespace App\Livewire\Gestion\Eventos;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Evento;

class Agregar extends Component
{
    /**
     * Display a listing of the resource.
     */
    public $events;

    public function updateEvents()
    {
        $this->events = Evento::all();
    }

    public function render()
    {
        return view('livewire.gestion.eventos.agregar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function agregarEvento()
    {
        $evento = new Evento();
        $evento->event_name = $this->event_name;
        $evento->start_date = $this->start_date;
        $evento->end_date = $this->end_date;
        $evento->save();
        $this->events = Evento::all();
    }
   
    public function eliminarEvento($id)
    {
        // Agregar lógica para eliminar evento
    }

    public function actualizarEvento($id)
    {
        // Agregar lógica para actualizar evento
    }
}