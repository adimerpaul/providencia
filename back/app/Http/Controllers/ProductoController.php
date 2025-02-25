<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller{
    function index(Request $request){
        $paginate = 30;
        $filter = $request->input('filter');
        $page = $request->input('page');

        $productos = Producto::where('medicamento', 'like', "%$filter%")
            ->orWhere('forma_farmaceutica', 'like', "%$filter%")
            ->orWhere('concentracion', 'like', "%$filter%")
            ->orderBy('medicamento')
            ->paginate($paginate);
        return response()->json($productos);
    }
    function store(Request $request){
        return Producto::create($request->all());
    }
    function update(Request $request, Producto $producto){
        $producto->update($request->all());
        return $producto;
    }
    function destroy(Producto $producto){
        $producto->delete();
        return response()->json(['success' => true]);
    }
}
