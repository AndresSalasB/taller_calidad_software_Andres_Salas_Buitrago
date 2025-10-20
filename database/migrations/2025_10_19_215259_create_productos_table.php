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
            $table->integer('id', true)->unique('id_unique');
            $table->string('marca', 60);
            $table->string('modelo', 60);
            $table->string('descripcion', 400)->nullable();
            $table->decimal('precio', 12);
            $table->integer('stock')->default(0);
            $table->string('imagen', 300)->nullable();
            $table->integer('usuario_id')->nullable();
            $table->integer('tipo_producto_id')->nullable();

            $table->timestamps();

            $table->primary(['id']);
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
