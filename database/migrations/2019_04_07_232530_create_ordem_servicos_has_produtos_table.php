<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdemServicosHasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_servicos_has_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ordem_servicos_id')->unsigned();
            $table->bigInteger('produtos_id')->unsigned();
            $table->decimal('valor_venda')->nullable();
            $table->timestamp('data')->nullable();
        });

        Schema::table('ordem_servicos_has_produtos', function($table) {
            $table->foreign('ordem_servicos_id')->references('id')->on('ordem_servicos')->onDelete('cascade');
            $table->foreign('produtos_id')->references('id')->on('produtos')->onDelete('cascade');
        });

        // DB::unprepared('ALTER TABLE `ordem_servicos_has_produtos` DROP PRIMARY KEY, ADD PRIMARY KEY (  `id`)');


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('ordem_servicos_has_produtos');
    }
}
