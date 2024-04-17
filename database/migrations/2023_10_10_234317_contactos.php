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
        Schema::create('contactos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('Nombre');
            $table->string('Puesto')->nullable();
            $table->string('Correo')->unique();
            $table->string('Telefono')->nullable();
            $table->unsignedBigInteger('Empresa');
            $table->enum('status', ['activo', 'inactivo']);
            $table->foreign('Empresa')->references('id')->on('clientes')->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
