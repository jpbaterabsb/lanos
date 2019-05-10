<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->boolean('status');
            $table->string('descricao');
            $table->integer('quantidade')->nullable();
            $table->decimal('valor');
            $table->bigInteger('categoria_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('produtos', function($table) {
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
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
