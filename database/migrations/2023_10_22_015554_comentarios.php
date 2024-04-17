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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('Id_Actividad');
            $table->unsignedBigInteger('Id_User');
            $table->string('Comentario');
            $table->string('Documento_path')->nullable();
            $table->foreign('Id_User')->references('id')->on('users')->onDelete("cascade");
            $table->foreign('Id_Actividad')->references('id')->on('actividadembarques')->onDelete("cascade");
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
