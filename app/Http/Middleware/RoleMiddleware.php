<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role  El rol requerido para acceder a la ruta.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // 1. Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('login');
        }

        // --- SOLUCIÓN APLICADA AQUÍ ---

        // 2. Obtiene el rol del usuario desde la columna 'rol' (en español).
        //    Si el valor es null (porque el usuario es antiguo o hubo un error), lo trata como una cadena vacía.
        $userRole = $request->user()->rol ?? '';

        // 3. Compara los roles de forma segura:
        //    - Convierte ambos a minúsculas (ignora mayúsculas/minúsculas).
        //    - Elimina espacios en blanco al principio y al final.
        if (strtolower(trim($userRole)) !== strtolower(trim($role))) {
            // Si los roles no coinciden, deniega el acceso.
            abort(403, 'Acceso no autorizado.');
        }
        
        // 4. Si la comparación es exitosa, permite que la petición continúe.
        return $next($request);
    }
}