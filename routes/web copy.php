<?php

use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\SuppliersController;

###########laravel12######################
use Illuminate\Support\Facades\Route;
#Route::get('/', function () {return view('welcome');});
#➜ cd base1
#➜ npm install && npm run build
#➜ composer run dev
######################################################

 //Route::get('/', function () { return view('welcome'); });
 Route::get('/',HomeController::class)->name('home');

Route::get('/productos', [ProductosController::class,'index'])->name('productos.index');  // 1 
Route::get('/productos/create', [ProductosController::class, 'create' ])->name('productos.create');// 2
Route::post('/productos', [ProductosController::class,'store'])->name('productos.store');// 4

Route::get('/productos/{producto}', [ProductosController::class,'show'])->name('productos.show');// 3 
Route::get('/productos/{producto}/edit', [ProductosController::class,'edit'])->name('productos.edit');// 5 
Route::put('/productos/{producto}',[ProductosController::class,"update"])->name('productos.update');// 6

################################################################  forceDelete
Route::delete('/productos/{producto}/forceDelete', [ProductosController::class, 'forceDelete'])->name('productos.forceDelete');
Route::patch('/productos/{producto}/restore', [ProductosController::class, 'restore'])->name('productos.restore');

################################################################

Route::post("/buscador",[BuscadorController::class,"buscador"] )->name('buscador');



   Route::get('/suppliers', [SuppliersController::class,'index'])->name('suppliers.index');  // 1 
   Route::get('/suppliers/create', [SuppliersController::class, 'create' ])->name('suppliers.create');// 2
   Route::post('/suppliers', [SuppliersController::class,'store'])->name('suppliers.store');// 4
   Route::get('/suppliers/{producto}', [SuppliersController::class,'show'])->name('suppliers.show');// 3 
   Route::get('/suppliers/{producto}/edit', [SuppliersController::class,'edit'])->name('suppliers.edit');// 5 
   Route::put('/suppliers/{producto}',[SuppliersController::class,"update"])->name('suppliers.update');// 6

   ################################################################
   Route::delete('/suppliers/{producto}/forceDelete', [SuppliersController::class, 'forceDelete'])->name('suppliers.forceDelete');
   Route::patch('/suppliers/{producto}/restore', [SuppliersController::class, 'restore'])->name('suppliers.restore');
   
   ################################################################