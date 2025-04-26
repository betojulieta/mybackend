<?php

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registra el middleware CORS GLOBALMENTE (para todas las rutas)
        $middleware->append(CorsMiddleware::class);  // Usa append() en lugar de prepend()

        // Opcional: Si necesitas excluir algunas rutas
        $middleware->validateCsrfTokens(except: [
            'api/*', // Desactiva CSRF para rutas API
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configura respuestas JSON para errores
        $exceptions->shouldRenderJsonWhen(function ($request) {
            return $request->is('api/*'); // Devuelve JSON en errores de API
        });
    })
    ->create();


/*

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CorsMiddleware; // Importamos el middleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->prepend(CorsMiddleware::class); // Registramos el middleware
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    */