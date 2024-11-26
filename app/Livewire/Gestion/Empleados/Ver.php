<?php

namespace App\Livewire\Gestion\Empleados;

use App\Models\Persona;
use Livewire\Component;

class Ver extends Component
{
    public $id_persona;
    public $persona;
    public function mount($id_persona)
    {
        $this->id_persona = $id_persona;
    }

    public function render()
    {
        $this->persona = Persona::find($this->id_persona);
        return view('livewire.gestion.empleados.ver');
    }
}
