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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idLibro');
            $table->string('numCont');
            $table->unsignedBigInteger('idMast');
            $table->unsignedBigInteger('idSubTema');
            $table->date('fechaConsulta');

            $table->foreign('idLibro')
            ->references('id')
            ->on('libros')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null') 

            $table->foreign('idSubTema')
            ->references('id')
            ->on('subtemas')
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
        Schema::dropIfExists('consultas');
    }
};
