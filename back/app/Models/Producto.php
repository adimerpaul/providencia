<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model{
    use SoftDeletes;
    protected $fillable = ['medicamento', 'forma_farmaceutica', 'concentracion', 'imagen', 'precio', 'costo', 'stock', 'activo', 'categoria_id'];

    function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
