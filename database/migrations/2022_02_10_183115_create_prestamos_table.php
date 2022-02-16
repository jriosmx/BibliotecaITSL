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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->string('NumCont');
            $table->unsignedBigInteger('idMast');
            $table->unsignedBigInteger('idLibro');
            $table->unsignedBigInteger('idTipoPrestamo');
            $table->unsignedBigInteger('idUser');
            $table->date('fechaPrestamo');
            $table->time('horaPrestamo');
            $table->date('fechaEntrega');
            $table->time('horaEntrega');
            $table->text('observaciones');           

            $table->foreign('idLibro')
            ->references('id')
            ->on('libros')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null')        

            $table->foreign('idTipoPrestamo')
            ->references('id')
            ->on('tiposprestamos')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null')

            $table->foreign('idUser')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('prestamos');
    }
};
