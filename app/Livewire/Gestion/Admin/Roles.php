<?php

namespace App\Livewire\Gestion\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $roles;
    public $name;
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
    public function render()
    {
        $this->roles = Role::all()->sortBy('name');
        $this->permisos = Permission::all()->sortBy('name');
        return view('livewire.gestion.admin.roles');
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
        $this->resetErrorBag();
        $this->dispatch('limpiar-formulario', [$this->permisos_seleccionados, $this->name, $this->rol_seleccionado]);
    }

    // Getters Setters Custom
    public function getAttribute($propertyName)
    {
        return $this->$propertyName;
    }

    public function setAttribute($propertyName, $propertyValue)
    {
        $this->$propertyName = $propertyValue;
        $this->validateOnly($propertyName);
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
                $this->dispatch('success', 'Rol editado correctamente');
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo editar el rol, verifique los datos e intenete nuevamente');
            }
        } else {
            try {
                $rol = Role::create(['name' => $this->name]);
                $permisos = Permission::whereIn('id', $this->permisos_seleccionados)->get();
                $rol->givePermissionTo($permisos);
                $this->dispatch('success', 'Rol creado correctamente');
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                $this->dispatch('error', 'No se pudo crear el rol, verifique los datos e intenete nuevamente');
            }
        }
    }
}
