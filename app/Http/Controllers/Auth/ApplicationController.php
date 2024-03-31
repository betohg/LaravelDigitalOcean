<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Muestra la vista de verificación de código por aplicacion.
     *
     * @return \Illuminate\View\View
     */

    public function create(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $codigoAleatorio = Str::random(16); // Genera una cadena aleatoria de longitud 16

            // Asigna el código aleatorio a la columna applicationcode
            $user->applicationcode = $codigoAleatorio;

            // Guarda el modelo actualizado
            $user->save();

            // Pasa el código aleatorio a la vista
            return view('auth.application', ['codigoAleatorio' => $codigoAleatorio, 'email' => $request->email]);
        } else {
            return redirect()->route('login.index');
        }
    }

    /**
     * Verifica el código de verificación ingresado por el usuario 
     * y realiza las acciones correspondientes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {

            $user = User::where('email', $request->input('email'))->first();

            if ($user->appstatus == 1) {
                // Si coincide, limpiar el código de verificación en la base de datos
                $user->appstatus = 0;
                $user->applicationcode = null;
                $user->save();

                Auth::login($user);

                return redirect()->route('home')->with('success', 'Confirmado por aplicacion');
            } else {
                return redirect()->route('app.verification', ['email' => $user->email])->with('error', 'Usuario no validado por aplicación.');
            }
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error desconocido: ' . $e->getMessage());
            return back()->withErrors(['message' => 'Se produjo un error inesperado. Por favor, inténtalo de nuevo.']);
        }
    }
}
