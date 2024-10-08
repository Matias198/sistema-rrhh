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
    public function render_gestion_empleados_listar()
    {
        return view('renders.gestion.empleados.listar');
    }

    public function render_gestion_empleados_agregar(){
        return view('renders.gestion.empleados.agregar');
    }

    /**
     * Renderiza la vista de Gestion de Paises.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_ubicaciones_paises()
    {
        return view('renders.gestion.ubicaciones.paises');
    }

    /**
     * Renderiza la vista de Gestion de Provincias.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_ubicaciones_provincias()
    {
        return view('renders.gestion.ubicaciones.provincias');
    }

    /**
     * Renderiza la vista de Gestion de Ciudades.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_ubicaciones_municipios()
    {
        return view('renders.gestion.ubicaciones.municipios');
    }

    /**
     * Renderiza la vista de Gestion de Roles.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_roles()
    {
        return view('renders.gestion.admin.roles');
    }

    /**
     * Renderiza la vista de Gestion de Permisos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_permisos()
    {
        return view('renders.gestion.admin.permisos');
    }

}
