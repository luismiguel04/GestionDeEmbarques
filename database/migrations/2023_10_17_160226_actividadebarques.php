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
        Schema::create('actividadembarques', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('Id_Embarque');
            $table->unsignedBigInteger('Id_Actividad');
            $table->unsignedBigInteger('Id_User');
            $table->enum('A_Status', ["En Proceso", "Completada", "Cancelada"]);
            $table->foreign('Id_Embarque')->references('id')->on('embarques')->onDelete("cascade");
            $table->foreign('Id_User')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('Id_Actividad')->references('id')->on('actividades_fijas')->onDelete("cascade");
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
