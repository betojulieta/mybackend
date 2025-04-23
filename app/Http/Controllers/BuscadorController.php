<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
     public function buscador(Request $request)
     {
         // Validar el campo `query` para evitar solicitudes vacías
         $request->validate([
             'query' => 'required|string|max:255',
         ]);
     
         // Buscar productos en la base de datos por coincidencia con el campo `cliente`
         $productos = Producto::where('cliente', 'LIKE', '%' . $request->input('query') . '%')->get();
     
         // Retornar los resultados como JSON
         return response()->json([
             'success' => true,
             'message' => 'Resultados encontrados',
             'data' => $productos,
         ]);
     }
     public function buscador_(Request $request)
     {
   
      $productos = Producto::where('cliente', 'Like', '%' . $request["buscar"] . '%')->get();
         return view('buscador.mostrar', compact('productos'));/**/
     }
  
}
