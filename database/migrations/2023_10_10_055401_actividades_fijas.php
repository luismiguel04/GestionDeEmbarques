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
        Schema::create('actividades_fijas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('Nombre');
            $table->integer('Fecha_estimada');
            $table->unsignedBigInteger('servicios_id');
            $table->foreign('servicios_id')->references('id')->on('servicios')->onDelete("cascade");
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
