<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    
   public function index()
    {
        
        try {
            $sinPag = Producto::all(); // Obtener todos los productos
            $productos = Producto::withoutTrashed()->orderBy('id', 'desc')->paginate(5); // Productos paginados
            
            return response()->json([
                'productos' => $productos,
                'sinPag' => $sinPag
            ], 200); // Enviar ambos datos en un objeto JSON
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error al obtener los productos.',
                'error' => $e->getMessage(),
            ], 500); // Respuesta de error
        }
    }
      
    /*
    public function create()
    {

    }
    */
    public function store(Request $request)
    { 
        try {
            $validated = $request->validate([
                'fecha' => 'required',
                'cliente' => 'required',
                'producto' => 'required',
                'debe' => 'required',
                'abono' => 'required',
                'costoC' => 'required',
                'costoP' => 'required',
            ]);
    
            $producto = Producto::create($validated);
    
            // Devolver el producto actualizado con un mensaje de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Producto creado exitosamente!',
                'data' => $producto,
            ], 200);
        } catch (\Exception $e) {
            // Manejar errores inesperados
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al intentar crear el producto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function show(Producto $producto)//string $id
    {
            try {
                return $producto;
                #dd($producto);
            } catch (\Exception $e) {
                // Manejar errores inesperados
                return response()->json([
                    'message' => 'Ocurrió un error al actualizar el producto.',
                    'error' => $e->getMessage(),
                ], 500);
            }

    }
        /*  
    public function edit(Producto $producto)//string $id
    {

    }
      */
    public function update(Request $request, Producto $producto)
    {
        try {
            // Validar los datos recibidos
            $solicitud = $request->validate([
                'fecha' => 'required',
                'cliente' => 'required',
                'producto' => 'required',
                'debe' => 'required',
                'abono' => 'required',
                'costoC' => 'required',
                'costoP' => 'required',
            ]);

            // Actualizar el producto en la base de datos
            $producto->update($solicitud);

            // Devolver el producto actualizado con un mensaje de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Producto actualizado exitosamente!',
                'data' => $producto,
            ], 200);

        } catch (\Exception $e) {
            // Manejar errores inesperados
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar el producto.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    public function destroy($id)
    {
        $producto = Producto::withTrashed()->find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado.'
            ], 404);
        }

        if ($producto->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'El producto ya ha sido eliminado.'
            ], 400);
        }

        $producto->delete();

        // Mensaje de éxito tras la eliminación lógica
        return response()->json([
            'success' => true,
            'message' => '¡Producto eliminado exitosamente!'
        ]);
    }
    public function forceDelete($id) // Recibe solo el ID del producto
    {
        // Buscar el producto (incluyendo eliminados)
        $producto = Producto::withTrashed()->find($id);

        // Validar si el producto existe
        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado.'
            ], 404);
        }

        // Eliminar permanentemente el producto
        $producto->forceDelete();

        // Mensaje de éxito tras la eliminación permanente
        return response()->json([
            'success' => true,
            'message' => '¡Producto eliminado permanentemente!'
        ])->header('Access-Control-Allow-Origin', '*');
    }
    public function restore($id)
    {
        $producto = Producto::withTrashed()->find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado.'
            ], 404);
        }

        $producto->restore();

        // Mensaje de éxito tras la restauración
        return response()->json([
            'success' => true,
            'message' => '¡Producto restaurado exitosamente!'
        ]);
    }

    public function indexDeleted()
    {
        // Obtener solo los registros eliminados (con deleted_at no nulo)
        $productos = Producto::onlyTrashed()->paginate(100);
        return response()->json($productos);
    }

}

