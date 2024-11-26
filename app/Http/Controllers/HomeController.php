<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use Illuminate\Http\Request;

class HomeController extends Controller{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 
    public function index()    {
        return view('home');
    }
    // Obtiene los eventos
    public function getEventos(Request $request)   {
        $query = Evento::query();
        // Filtro por rango de fechas
        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('start', [$request->start, $request->end]);
        }
        return response()->json($query->get());
    }
    // Crea un evento
    public function crearEvento(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        $event = Evento::create($validated);
        return response()->json($event, 201);
    }

    // Actualiza un evento
    public function updatedEvent(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start', // El fin no puede ser antes que el inicio
        ]);
        // Si el final es nulo o igual que el inicio, el final sera igual al inicio.
        if (!$validated['end'] || $validated['start'] === $validated['end']) {
            $validated['end'] = $validated['start'];
        }
        $event = Evento::findOrFail($id);
        $event->update($validated);

        return response()->json($event, 200);
    }

    
}
