<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Dominios permitidos (ajusta esto)
        $allowedOrigins = [
            'https://frontend-rho-liard-56.vercel.app',
            'http://localhost:3000'
        ];

        $origin = $request->header('Origin');

        // Si la petición es OPTIONS, devuelve una respuesta vacía con los headers
        if ($request->isMethod('OPTIONS')) {
            return response('', 204)
                ->header('Access-Control-Allow-Origin', $origin)
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                ->header('Access-Control-Allow-Credentials', 'true');
        }

        // Para otras peticiones, añade los headers CORS
        $response = $next($request);

        if (in_array($origin, $allowedOrigins)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }
}



/*

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    
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

*/