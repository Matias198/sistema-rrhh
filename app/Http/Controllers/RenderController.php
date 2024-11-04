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
     * Renderiza la vista de Gestion de Roles.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_roles()
    {
        return view('renders.gestion.admin.privilegios.rolespermisos');
    }
 
    /**
     * Renderiza la vista de Gestion de Puestos de Trabajos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_puesto_trabajos()
    {
        return view('renders.gestion.admin.puestotrabajo.listar');
    }

    /**
     * Renderiza la vista de Agregar Puesto de Trabajo.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_puesto_trabajos_agregar(){
        return view('renders.gestion.admin.puestotrabajo.agregar');
    }

    /**
     * Renderiza la vista de Gestion de Departamentos.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_departamentos()
    {
        return view('renders.gestion.admin.dpto.departamentos');
    }
}
