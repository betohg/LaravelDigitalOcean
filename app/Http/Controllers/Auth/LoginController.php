<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Muestra la vista del formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        return view('auth.login');
    }


    /**
     * Autentica al usuario a partir de las credenciales proporcionada
     * s y gestiona la redirección según el tipo de usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'g-recaptcha-response.required' => 'Por favor, completa el campo reCAPTCHA.',
                'g-recaptcha-response.captcha' => 'El campo reCAPTCHA no es válido. Por favor, inténtalo de nuevo.',
            ]);

            // Verifica las credenciales con los registros en la base de datos
            $user = User::where('email', $request->email)->first(); // Busca el usuario por su correo electrónico

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw new \Exception('El correo electrónico o la contraseña son incorrectos. Por favor, inténtalo de nuevo.');
            }

            if ($user->role_id == 1 || $user->role_id == 2) {
                // Redirige al usuario a la página de verificación de teléfono
                return redirect()->route('auth.phone', ['email' => $request->email]);
            } else {
                // Autentica al usuario y redirige a la página principal
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Inicio de sesión exitoso');
            }
            
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error de autenticación: ' . $e->getMessage());
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    /**
     * Cierra la sesión del usuario autenticado.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {

        auth()->logout();

        return redirect()->to('/');
    }


    public function destroyT(Request $request)
    {

        $request->user()->forceFill([

            'api_token' => null,

        ])->save();

        return response()->json(['messageClose' => 'Usuario Deslogueado']);
    }


    public function confirmCode(Request $request)
    {
        $secondcode = $request->validate([
            'applicationcode' => ['required'],
        ]);
        // $secondcode = '788556'; // Código a verificar

        $user = User::where('applicationcode', $secondcode)->first();

        if ($user) {
            $user->forceFill([
                'appstatus' => 1,
            ])->save();
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Código incorrecto'
            ]);
        }
    }



    public function logintwo(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json([
                'nosuccess' => true,
                'message' => 'Credenciales Incorrectas'
            ]);
        }

        if ($user->role_id !== 1) {
            return response()->json([
                'nosuccess' => true,
                'message' => 'Error: Usuario no autorizado'
            ]);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $user->forceFill([
                'api_token' => $token,
            ])->save();

            return response()->json([
                'token' => $token,
                'success' => true,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'nosuccess' => true,
                'message' => 'Credenciales Incorrectas'
            ]);
        }
    }
}
