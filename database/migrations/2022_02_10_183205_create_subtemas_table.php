<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idTema');
            $table->string('nombre');
            $table->tinyInteger('pagina');   

            $table->foreign('idTema')
            ->references('id')
            ->on('temas')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null')  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtemas');
    }
};
