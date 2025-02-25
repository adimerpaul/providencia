<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller{
    function index(Request $request){
        $paginate = 50;
        $filter = $request->input('filter');

        $productos = Producto::where('medicamento', 'like', "%$filter%")
            ->orWhere('forma_farmaceutica', 'like', "%$filter%")
            ->orWhere('concentracion', 'like', "%$filter%")
            ->paginate($paginate);
        return response()->json($productos);
    }
}
