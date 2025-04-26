<?php

use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SuppliersController;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;





// Asegúrate de que todas las rutas API usen el middleware CORS
Route::middleware(['cors'])->group(function () {



#################productos#####################################
Route::get('/productos/deleted', [ProductosController::class, 'indexDeleted']);

Route::delete('/productos/{producto}/forceDelete', [ProductosController::class, 'forceDelete'])->name('productos.forceDelete');

Route::apiResource('/productos', ProductosController::class);

Route::patch('/productos/{producto}/restore', [ProductosController::class, 'restore'])->name('productos.restore');

//Route::patch('/productos/{producto}/restore', [ProductosController::class, 'restore'])->name('productos.restore');

################### proveedores ######################################

Route::get('/suppliers/deleted', [SuppliersController::class, 'indexDeleted']);

Route::delete('/suppliers/{producto}/forceDelete', [SuppliersController::class, 'forceDelete'])->name('productoss.forceDelete');

Route::apiResource('/suppliers', SuppliersController::class);

Route::patch('/suppliers/{producto}/restore', [SuppliersController::class, 'restore'])->name('productoss.restore');

//Route::patch('/suppliers/{producto}/restore', [SuppliersController::class, 'restore'])->name('productos.restore');


################### buscadores ################################
Route::post("/buscador",[BuscadorController::class,"buscador"] )->name('buscador');



################### rutas de prueba ################################
/*
Route::get('/test', function () {
    return response()->json([
        'message' => 'Ruta API activa'], 200);
});
*/

Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API funcionando'
    ]);
});


});
