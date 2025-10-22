<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id', true);
            $table->enum('tipo_documento', [
                'Cédula de Ciudadania',
                'Cédula de Extranjería',
                'Tarjeta de Identidad',
                'Pasaporte',
                'NIT'
            ]);
            $table->string('numero_documento', 30)->unique();
            $table->string('correo', 160)->unique();
            $table->string('password');
            $table->enum('rol', ['Administrador', 'Cliente', 'Gerente']);
            $table->string('nombre', 50);
            $table->string('apellido', 50);
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
