<?php

namespace App\Livewire\user\profile;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePasswordShow extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
        'password_confirmation' => 'required',
    ];

    public function returnInventory()
    {
        $this->redirect('/dashboard');
    }

    public function returnChangePassword()
    {
        $this->redirect('/change/password');
    }

    public function updatePassword()
    {
        // Validar los campos del formulario
        $this->validate();

        // Obtener usuario autenticado
        $user = auth()->user();

        // Corroborar que la contraseña ingresada coincida con la del usuario
        if (Hash::check($this->current_password, $user->password)) {
            $user->password = bcrypt($this->password);
            $user->temporary_password = false;
            $user->save();

            toastr()->success('La contraseña fue actualizada con éxito', 'Contraseña actualizada!');
            $this->returnInventory();
        } else {
            toastr()->error('La contraseña no pudo ser actualizada', 'No se actualizo la contraseña');
            $this->returnChangePassword();
        }

        // dd('password incorrecto');7
    }

    public function render()
    {
        return view('livewire.user.profile.change-password-show');
    }
}
