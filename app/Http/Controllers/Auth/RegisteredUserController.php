<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule; // Asegúrate de que este 'use' esté presente
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Maneja una solicitud de registro entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. REGLA DE VALIDACIÓN CORREGIDA
        // Ahora permite todos los roles que tienes en tu formulario.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'rol' => ['required', 'string', Rule::in(['remitente', 'operador', 'transportista', 'admin'])],
        ]);

        // Se crea el usuario con el rol validado
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        // Se dispara el evento de registro
        event(new Registered($user));

        // Se inicia sesión con el nuevo usuario
        Auth::login($user);

        // 2. REDIRECCIÓN SIMPLIFICADA
        // Redirigimos al dashboard genérico. El DashboardController se encargará
        // de enviar al usuario al panel correcto según su rol.
        return redirect()->route('dashboard');
    }
}