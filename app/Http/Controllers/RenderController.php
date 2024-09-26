<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RenderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Renderiza la vista de Gestion de Empleados.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_empleados()
    {
        return view('renders.gestion.empleados');
    }

    /**
     * Renderiza la vista de Gestion de Nominas.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_nominas()
    {
        return view('renders.gestion.nominas');
    }

    /**
     * Renderiza la vista de Gestion de Asistencias.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_asistencias()
    {
        return view('renders.gestion.asistencias');
    }

    /**
     * Renderiza la vista de Gestion de Licencias.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_licencias()
    {
        return view('renders.gestion.licencias');
    }
}
