<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nome');
            $table->unsignedBigInteger('tipo_animal_id');
            $table->string('tipo_fase');
            $table->unsignedBigInteger('marca_id');
            $table->string('embalagem');
            $table->float('preco');
            $table->integer('estoque');
            $table->unsignedBigInteger('categoria_id');
            $table->boolean('ativo')->default(true);
            $table->boolean('promocao')->default(false);
            $table->boolean('granel')->default(false);
            $table->foreign('tipo_animal_id')->references('id')->on('tipo_animals');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('produtos');
    }
}
