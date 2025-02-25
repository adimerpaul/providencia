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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('medicamento')->nullable();
            $table->string('forma_farmaceutica')->nullable();
            $table->string('concentracion')->nullable();
            $table->string('imagen')->nullable();
            $table->decimal('precio', 8, 2)->nullable();
            $table->decimal('costo', 8, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('activo')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
