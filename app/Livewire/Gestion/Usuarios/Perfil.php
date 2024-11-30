<?php

namespace App\Livewire\Gestion\Usuarios;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Perfil extends Component
{
    public $id_persona;
    public $email_user;
    public $email_nuevo;
    public $email_confirmation;
    public $password;
    public $password_confirmation;
    public function rules()
    {
        return [
            'email_nuevo' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            'email_confirmation' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|same:email_nuevo',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ];
    }
    protected $messages = [
        'email_nuevo.required' => 'El campo email es requerido',
        'email_nuevo.email' => 'El campo email debe ser un email válido',
        'email_nuevo.unique' => 'El email ya está en uso',
        'email_nuevo.regex' => 'El email no es válido',
        'email_confirmation.required' => 'El campo confirmación de email es requerido',
        'email_confirmation.email' => 'El campo confirmación de email debe ser un email válido',
        'email_confirmation.unique' => 'El email ya está en uso',
        'email_confirmation.regex' => 'El email no es válido',
        'email_confirmation.same' => 'Los emails no coinciden',
        'password.required' => 'El campo contraseña es requerido',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        'password_confirmation.required' => 'El campo confirmación de contraseña es requerido',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function mount()
    {
        $this->id_persona = User::find(Auth::user()->id)->persona->id;
        $this->email_user = Auth::user()->email;
    }

    public function render()
    {
        return view('livewire.gestion.usuarios.perfil');
    }

    public function updateEmail()
    {
        $this->validate([
            'email_nuevo' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/',
            'email_confirmation' => 'required|email|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/|same:email_nuevo',
        ],[
            'email_nuevo.required' => 'El campo email es requerido',
            'email_nuevo.email' => 'El campo email debe ser un email válido',
            'email_nuevo.unique' => 'El email ya está en uso',
            'email_nuevo.regex' => 'El email no es válido',
            'email_confirmation.required' => 'El campo confirmación de email es requerido',
            'email_confirmation.email' => 'El campo confirmación de email debe ser un email válido',
            'email_confirmation.unique' => 'El email ya está en uso',
            'email_confirmation.regex' => 'El email no es válido',
            'email_confirmation.same' => 'Los emails no coinciden',
        ]);
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $user->email = $this->email_nuevo;
            $user->save();
            $this->email_nuevo = '';
            $this->email_confirmation = '';
            $this->email_user = $user->email;
            DB::commit();
            $this->dispatch('success', 'Email actualizado correctamente');
            $this->dispatch('actualizar_mail');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
        ],[
            'password.required' => 'El campo contraseña es requerido',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password_confirmation.required' => 'El campo confirmación de contraseña es requerido',
            'password_confirmation.min' => 'La confirmación de la contraseña debe tener al menos 8 caracteres',
            'password_confirmation.same' => 'Las contraseñas no coinciden',
        ]);
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($this->password);
            $user->save();
            $this->password = '';
            $this->password_confirmation = '';
            DB::commit();
            $this->dispatch('success', 'Contraseña actualizada correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', 'Ha ocurrido un error: ' . $e->getMessage());
        }
    }
}
