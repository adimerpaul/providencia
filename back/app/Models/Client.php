<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model{
    use SoftDeletes;
    protected $fillable = ['nombreRazonSocial', 'codigoTipoDocumentoIdentidad', 'numeroDocumento', 'complemento', 'email', 'telefono', 'clienteProveedor'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
