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
        Schema::create('embarques', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('Referencia');
            $table->unsignedBigInteger('Empresa');
            $table->unsignedBigInteger('Encargado');
            $table->date('ETA');
            $table->double('cantidad', 16, 2);
            $table->enum('Status', ["En Proceso", "Completada", "Cancelada"]);
            $table->foreign('Encargado')->references('id')->on('users')->onDelete("cascade");
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
