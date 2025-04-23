<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

  public function index()
{
    try {
        $proveedores = Supplier::withoutTrashed()->orderBy('id', 'desc')->paginate(5); // Paginado
        $sinPag = Supplier::all(); // Todos los proveedores sin paginar

        return response()->json([
            'proveedores' => $proveedores, // Datos paginados
            'sinPag' => $sinPag,           // Todos los datos
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Ocurrió un error al obtener los proveedores.',
            'error' => $e->getMessage(),
        ], 500);
    }
}
   
    /*
    public function create()
    {

    }
        */
    public function store(Request $request)//
    { 


        
        try {
            $validated = $request->validate([
                'fecha' => 'required',
                'proveedorCarne' => 'required',
                'costoC' => 'required',
                'proveedorQueso' => 'required',
                'costoQ' => 'required',
            ]);
    
            $producto = Supplier::create($validated);
    
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

 
        $validated=$request->validate([
            'fecha' => 'required',
            'proveedorCarne' => 'required',
            'costoC' => 'required',
            'proveedorQueso' => 'required',
            'costoQ' => 'required',
        ]);
       $producto= Supplier::create($validated);
      return to_route('suppliers.index')->with('status','registro creado con exito!!!');  
        return to_route('suppliers.index');

    }


    public function show(Supplier $supplier)//string $id$producto
    {

        try {
            return $supplier;// $producto
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
    public function edit(Supplier $producto)//string $id
    {

    }
   */
    public function update(Request $request,Supplier $supplier)
    {
        try {
            // Validar los datos recibidos
            $solicitud = $request->validate([
                'fecha' => 'required',
                'proveedorCarne' => 'required',
                'costoC' => 'required',
                'proveedorQueso' => 'required',
                'costoQ' => 'required',
            ]);

            // Actualizar el producto en la base de datos
            $supplier->update($solicitud);//$producto

            // Devolver el producto actualizado con un mensaje de éxito
            return response()->json([
                'success' => true,
                'message' => '¡Producto actualizado exitosamente!',
                'data' => $supplier,
            ], 200);

        } catch (\Exception $e) {
            // Manejar errores inesperados
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al actualizar el producto.',
                'error' => $e->getMessage(),
            ], 500);
        }

        $solicitud= $request->validate([
            'fecha' => 'required',
           'proveedorCarne' => 'required',
           'costoC' => 'required',
           'proveedorQueso' => 'required',
            'costoQ' => 'required',
        ]);

        $producto->update($solicitud );
  
            return to_route('suppliers.index')->with('status','registro actualizado con exito!!!'); 
            return to_route('suppliers.index');
    }



    public function destroy($id)
    {
        $producto = Supplier::withTrashed()->find($id);

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
        $producto = Supplier::withTrashed()->find($id);

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
        $producto = Supplier::withTrashed()->find($id);

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
        $productos = Supplier::onlyTrashed()->paginate(100);
        return response()->json($productos);
    }

}
