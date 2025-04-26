<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Configura los headers CORS
        $headers = [
            'Access-Control-Allow-Origin'      => 'https://frontend-rho-liard-56.vercel.app', // Reemplaza con tu dominio de Vercel
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With',
            'Access-Control-Allow-Credentials' => 'true', // Opcional: si usas cookies o autenticación
        ];

        // Si es una petición OPTIONS, retorna la respuesta con los headers
        if ($request->isMethod('OPTIONS')) {
            return response()->json('OK', 200, $headers);
        }

        // Para otras peticiones, adjunta los headers a la respuesta
        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}