
<?php 
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
