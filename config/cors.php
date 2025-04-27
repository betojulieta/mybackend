
<?php 
/*
return [
    'paths' => ['api/*'], // Permite todas las rutas API
    'allowed_methods' => ['*'], // Permite todos los métodos (GET, POST, DELETE, etc.)
    'allowed_origins' => ['*'], // Permite solicitudes desde cualquier dominio
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permite todos los encabezados
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
*/
/*
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://frontend-rho-liard-56.vercel.app'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];

*/

return [
    'paths' => ['api/*'], 
    'allowed_methods' => ['*'], 
    'allowed_origins' => ['https://frontend-rho-liard-56.vercel.app'], 
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permitir todos los headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Permite cookies si es necesario
];

