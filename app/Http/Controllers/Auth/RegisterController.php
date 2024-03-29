<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{

    /**
     * Muestra la vista del formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('auth.register');
    }

    /**
     * Almacena un nuevo usuario después de validar 
     * la información del formulario de registro.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        try {
            $this->validate(request(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[0-9])(?=.*[^a-zA-Z0-9])/',],
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'g-recaptcha-response.required' => 'Por favor, completa el campo reCAPTCHA.',
                'g-recaptcha-response.captcha' => 'El campo reCAPTCHA no es válido. Por favor, inténtalo de nuevo.',
                'password.regex' => 'La contraseña debe tener al menos 8 caracteres e incluir al menos un número y un carácter especial.',
            ]);
    
            $noUsers = User::count() === 0;
            $rol = Role::where('rol', 'Administrador')->value('id');
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'role_id' => $noUsers ? Role::where('rol', 'Administrador')->value('id') : Role::where('rol', 'Invitado')->value('id'),
            ]);
    
            Log::info('Usuario Registrado '.$user->email);
            Log::info('Usuario Registrado '.$user->type);

            return redirect()->route('login.index');
            
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage());
            Log::error('Intento Rol de Registro: ' . $rol);
            return back()->withErrors(['message' => 'Error al registrar el usuario. Por favor, inténtalo de nuevo.']);
        }
    }
}
