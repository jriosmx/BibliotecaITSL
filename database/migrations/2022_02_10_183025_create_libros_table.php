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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('ISBN');
            $table->string('titulo');
            $table->date('fechaDeLanzamiento');
            $table->unsignedBigInteger('idAutor');
            $table->unsignedBigInteger('idCategoria');
            $table->unsignedBigInteger('idEditorial');
            $table->string('idioma');
            $table->integer('pagina');
            $table->text('descripcion');
            $table->binary('portada');      // campo blob

            $table->foreign('idAutor')
            ->references('id')
            ->on('autores')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null')

            $table->foreign('idCategoria')
            ->references('id')
            ->on('categorias')
            ->onUpdate('cascade')
            ->onDelete('cascade'); // onDelete('set null')

            $table->foreign('idEditorial')
            ->references('id')
            ->on('editoriales')
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
        Schema::dropIfExists('libros');
    }
};
