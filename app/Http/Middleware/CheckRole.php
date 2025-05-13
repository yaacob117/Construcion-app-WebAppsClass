<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('login');
        }

        // Si el usuario es administrador, permitir todo
        if ($request->user()->role && $request->user()->role->name === 'Administrator') {
            return $next($request);
        }

        // Verificar si el usuario tiene alguno de los roles permitidos
        if ($request->user()->role) {
            foreach ($roles as $role) {
                if ($request->user()->role->name === $role) {
                    return $next($request);
                }
            }
        }

        // Si no tiene los roles necesarios, redirigir con mensaje
        return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción. Se requiere uno de estos roles: ' . implode(', ', $roles));
    }
} 