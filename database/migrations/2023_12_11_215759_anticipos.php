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
        Schema::create('anticipos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('Id_Embarque');
            $table->double('cantidad', 16, 2);
            $table->date('Fecha_Anticipo');
            $table->foreign('Id_Embarque')->references('id')->on('embarques')->onDelete("cascade");
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
