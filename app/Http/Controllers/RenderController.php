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

    /**
     * Renderiza la vista de Gestion de Empleados.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_empleados_success(){
        return view('alta.empleado.success');
    }

    /**
     * Renderiza la vista de Gestion de Empleados.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_empleados_ver($id_persona){
        // EN la ruta se recibe el id de la persona
        return view('renders.gestion.empleados.ver', compact('id_persona'));
    }

    /**
     * Renderiza la vista de Gestion de Auditoria.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_auditoria(){
        $auditorias = \OwenIt\Auditing\Models\Audit::all();
        return view('renders.gestion.admin.auditoria', compact('auditorias'));
    }

    /**
     * Renderiza la vista de Gestion de Usuarios.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_usuarios(){
        return view('renders.gestion.admin.usuarios.listar');
    }

    /**
     * Renderiza la vista de Perfil de Usuario.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_usuarios_perfil(){
        return view('renders.gestion.usuarios.perfil');
    }

    /**
     * Renderiza la vista de Gestion de Gerentes.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function render_gestion_admin_gerentes(){
        return view('renders.gestion.admin.gerentes.listar');
    }
}
