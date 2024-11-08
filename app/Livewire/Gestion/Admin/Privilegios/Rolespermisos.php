<?php

namespace App\Livewire\Gestion\Admin\Privilegios;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Rolespermisos extends Component
{
    public $roles;
    public $name;
    public $vista_nombre;
    public $vista_descripcion;
    public $permisos;
    public $permisos_seleccionados = [];
    public $rol_seleccionado;
    public $editando = false;

    protected function rules()
    {
        if (!$this->editando) {
            return [
                'name' => [
                    'required',
                    'max:50',
                    'uppercase',
                    'regex:/^[A-Za-z\s]+$/',
                    Rule::unique('roles', 'name'),
                ],
                'permisos_seleccionados' => 'required',
            ];
        } else {
            return [
                'name' => [
                    'required',
                    'max:50',
                    'uppercase',
                    Rule::unique('roles', 'name')->ignore(
                        $this->rol_seleccionado,
                        'id'
                    ),
                    'regex:/^[A-Za-z\s]+$/',
                ],
                'permisos_seleccionados' => 'required',
            ];
        }
    }

    protected $messages = [
        'name.required' => 'El campo del nombre es obligatorio.',
        'name.regex' => 'El campo del nombre solo puede contener letras y espacios.',
        'name.unique' => 'El nombre del rol ya existe.',
        'name.max' => 'El nombre del rol no puede tener más de 50 caracteres.',
        'permisos_seleccionados.required' => 'Debe seleccionar al menos un permiso.',
    ];
 
    public function actualizarDatos(){
        $this->roles = Role::all()->sortBy('name'); 
        // uppercase de roles
        $this->roles = $this->roles->map(function ($rol) {
            $rol->name = strtoupper($rol->name);
            return $rol;
        }); 
    }
    public function render()
    {
        $this->actualizarDatos();
        $this->permisos = Permission::all()->sortBy('name');
        // uppercase de permisos
        $this->permisos = $this->permisos->map(function ($permiso) {
            $permiso->name = strtoupper($permiso->name);
            return $permiso;
        }); 
        return view('livewire.gestion.admin.privilegios.rolespermisos');
    }
    
    public function updated($propertyName)
    {
        if ($propertyName != 'rol_seleccionado') {
            $this->validateOnly($propertyName);
            $this->validate();
        }else{
            if ($this->rol_seleccionado == null) {
                $this->vista_nombre = '';
                $this->vista_descripcion = '';
                return;
            }else{
                $rol = Role::find($this->rol_seleccionado);   
                $this->vista_nombre = strtoupper($rol->name);
                // Buscar los permisos del rol, seleccionar los nombres y concatenarlos en uppercase
                $permisos = $rol->permissions->pluck('name')->toArray();
                $this->vista_descripcion = implode(', ', array_map('strtoupper', $permisos));
            }
        }
    }

    public function getRoles()
    {
        $this->actualizarDatos();
        return $this->roles;
    }

    public function editar()
    {
        $this->editando = true; 
        $rol = Role::find($this->rol_seleccionado);
        $this->name = strtoupper($rol->name);
        $this->permisos_seleccionados = $rol->permissions->pluck('id')->toArray();
        $this->dispatch('seleccionar-permisos', $this->permisos_seleccionados);
    }

    public function clear()
    {
        $this->editando = false;
        $this->name = '';
        $this->rol_seleccionado = null;
        $this->permisos_seleccionados = [];
        $this->vista_nombre = '';
        $this->vista_descripcion = '';
        $this->resetErrorBag();
        $this->dispatch('limpiar-formulario', [$this->permisos_seleccionados, $this->name, $this->rol_seleccionado]);
    }
    
    public function guardarRol()
    {
        $this->validate();        
        DB::beginTransaction();
        if ($this->editando) {
            try {
                $rol = Role::find($this->rol_seleccionado);
                $rol->name = $this->name;
                $rol->save();
                $permisos = Permission::whereIn('id', $this->permisos_seleccionados)->get();
                $rol->syncPermissions($permisos);
                DB::commit();
                $this->actualizarDatos(); 
                $this->dispatch('success', 'Rol editado correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo editar el rol, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        } else {
            try {
                $rol = Role::create(['name' => $this->name]);
                $permisos = Permission::whereIn('id', $this->permisos_seleccionados)->get();
                $rol->givePermissionTo($permisos);
                $this->actualizarDatos(); 
                $this->dispatch('success', 'Rol creado correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo crear el rol, verifique los datos e intenete nuevamente. ' + $e->getMessage());
            }
        }
    }
}
