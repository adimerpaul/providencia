<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->text('nombreRazonSocial')->nullable();
            $table->string('codigoTipoDocumentoIdentidad')->default('1')->nullable();
            $table->string('numeroDocumento')->nullable();
            $table->string('complemento')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('clienteProveedor')->default('Cliente');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
