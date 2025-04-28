<?php

use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Asegúrate de importar Request

####################### SOLUCIÓN CORS OPTIONS #######################
Route::options('{any}', function (Request $request) {
    return response()->json([], 200);
})->where('any', '.*');
########################################################################

################# productos #####################################
Route::get('/productos/deleted', [ProductosController::class, 'indexDeleted']);

Route::delete('/productos/{producto}/forceDelete', [ProductosController::class, 'forceDelete'])->name('productos.forceDelete');

Route::apiResource('/productos', ProductosController::class);

Route::patch('/productos/{producto}/restore', [ProductosController::class, 'restore'])->name('productos.restore');

################### proveedores ######################################
Route::get('/suppliers/deleted', [SuppliersController::class, 'indexDeleted']);

Route::delete('/suppliers/{producto}/forceDelete', [SuppliersController::class, 'forceDelete'])->name('productoss.forceDelete');

Route::apiResource('/suppliers', SuppliersController::class);

Route::patch('/suppliers/{producto}/restore', [SuppliersController::class, 'restore'])->name('productoss.restore');

################### buscadores ################################
Route::post("/buscador", [BuscadorController::class, "buscador"])->name('buscador');

################### rutas de prueba ################################
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API funcionando'
    ]);
});
